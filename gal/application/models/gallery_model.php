<?php

class Gallery_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_galleries_from($offset = 0, $limit = 5) {
        $this->db->select('gal.gal_id, name AS gal_name, gal_desc, date_created AS gal_created, pic_name, nick');
        $this->db->from('galleries AS gal');
        $this->db->join('(SELECT gal_id, pic_name FROM pictures	GROUP BY gal_id	ORDER BY pic_name asc) AS pic', 'gal.gal_id = pic.gal_id', 'LEFT');
        $this->db->join('(SELECT nick, user_id FROM users GROUP BY user_id) AS users', 'users.user_id = gal.user_id', 'LEFT');
        $this->db->group_by('gal_id');
        $this->db->where('is_published', '1');
        $this->db->order_by('gal_created desc');
        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result_array();
        $data = $this->set_pic_urls($data);
        return $data;
    }

    public function get_one($id = FALSE) {
        if ($id) {
            $this->db->select('name AS gal_name, galleries.date_created, gal_id, gal_desc, users.nick, users.user_id, is_published');
            $this->db->from('galleries');
            $this->db->join('users', 'galleries.user_id = users.user_id');
            $this->db->where('gal_id', $id);
            $this->db->limit(1);
            return $this->db->get()->result_array();
        }
    }

    public function view_one($id = FALSE) {
        if (!$id === FALSE) {
//            $this->db->select('name AS gal_name, galleries.date_created, gal_id, gal_desc, users.nick, users.user_id, is_published');
//            $this->db->from('galleries');
//            $this->db->join('users', 'galleries.user_id = users.user_id');
//            $this->db->where('gal_id', $id);
//            $this->db->limit(1);
            $response['info'] = $this->get_one($id);
            if (!$this->check_access($response)) {
                $response['info'] = null;
            } else {
                if (!$response['info'] === FALSE) {
                    $this->db->select('pic_name, description AS pic_desc');
                    $this->db->from('pictures');
                    $this->db->where('gal_id', $id);
                    $this->db->order_by('pic_name asc');
                    $response['img'] = $this->db->get()->result_array();
                    $response['img'] = $this->set_pic_urls($response['img'], $id);
                    return($response);
                }
            }
        }
    }

    private function check_access($response) {
        if (!$response['info'] === FALSE && $response['info'][0]['is_published']) {
            return TRUE;
        } else {
            if (!$response['info'] === FALSE && $response['info'][0]['user_id'] === $this->session->userdata('user_id')) {
                return TRUE;
            } else {
                if (strtolower($this->session->userdata('member_class_preview')) === 'admin') {
                    return TRUE;
                }
            }
        }
        return FALSE;
    }

    private function set_pic_urls($data = FALSE, $gal_id = FALSE) {
        if ($gal_id === FALSE) {
            foreach ($data as $data_index => $data_item) {
                if (!$data_item['pic_name'] === FALSE) {
                    $data[$data_index]['pic_url'] = base_url(
                            'img/gal/'
                            . $data_item['gal_id'] . '/' .
                            $data_item['pic_name']
                    );
                }
            }
        } else {
            foreach ($data as $data_index => $data_item) {
                if (!$data_item['pic_name'] === FALSE) {
                    $data[$data_index]['pic_url'] = base_url(
                            'img/gal/'
                            . $gal_id . '/' .
                            $data_item['pic_name']
                    );
                }
            }
        }
        return $data;
    }

    public function get_user_galleries($nick = FALSE, $staff = FALSE, $offset = 0, $limit = 2) {
        if (!$nick) {
            return FALSE;
        }
        $this->db->select('name, gal_id, galleries.date_created AS gal_created, is_published');
        $this->db->from('galleries');
        $this->db->join('users', 'users.user_id = galleries.user_id');
        $this->db->where('users.nick', $nick);
        if ($staff === FALSE) {
            $this->db->where('is_published', '1');
        }
        $this->db->limit($limit, $offset);
        $this->db->order_by('galleries.date_created desc');
        $data = $this->db->get()->result_array();
        return $data;
    }

    public function add_gallery($data, $publish) {
        $data['user_id'] = "";
        $subquery = "(" .
                "SELECT user_id " .
                "FROM users " .
                "WHERE nick='" . $this->session->userdata('nickname') . "' " .
                "LIMIT 1" .
                ")";
        $query = "INSERT INTO galleries (user_id, name, date_created, gal_desc, is_published) " .
                "VALUES (" .
                $subquery . ", '" .
                $data['name'] . "', " .
                "(SELECT NOW()), '" .
                $data['gal_desc'] . "', " .
                $publish .
                ")";
        $this->db->query($query);
    }

    public function publish_gallery($gal_id) {
        $update = Array('is_published' => 1);
        $this->db->where('gal_id', $gal_id);
        $this->db->update('galleries', $update);
    }

    public function unpublish_gallery($gal_id) {
        $update = Array('is_published' => 0);
        $this->db->where('gal_id', $gal_id);
        $this->db->update('galleries', $update);
    }

}

?>

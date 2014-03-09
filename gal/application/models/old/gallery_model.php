<?php /*

class Gallery_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->helper('directory');
    }

    private function get_thumb_urls($response = FALSE) {
        if (!$response === FALSE) {
            foreach ($response as $key => $value) {
                $response[$key]['images'] = directory_map('./img/gal/t/' . $value['gal_id']);
            }
            return $response;
        }
    }

    public function get_galleries_from($offset = 0, $limit = 5) {
        $this->db->select('name, date_created, gal_id');
        $this->db->from('galleries');
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('date_created', 'desc');
        $response = $this->db->get()->result_array();
        // get image names
//        foreach ($response as $key => $value) {
//            $response[$key]['images'] = directory_map('./img/gal/t/' . $value['gal_id']);
//        }
        $response = $this->get_thumb_urls($response);
        return $response;
    }

    public function view_one($id = FALSE) {
        if (!$id === FALSE) {
            $this->db->select('name, date_created, gal_id');
            $this->db->from('galleries');
            $this->db->where('gal_id', $id);
            $this->db->limit(1);
            $response = $this->db->get()->result_array();
            return($this->get_thumb_urls($response));
        }
    }

}

?>

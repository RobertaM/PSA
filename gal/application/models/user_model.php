<?php

class User_model extends CI_Model {

    public function get_users($nick = FALSE) {
        $this->db->select('nick');
        $this->db->from('users');
        if (!$nick === FALSE) {
            $this->db->where('nick', $nick);
            $this->db->limit(1);
        }
        $response = $this->db->get()->result_array();
        return $response;
    }

    public function check_password($data = FALSE) {
        if (!$data === FALSE) {
            $this->db->select('nick, pass');
            $this->db->from('users');
            $this->db->limit(1);
            $this->db->where('nick', $data['nickname']);
            $response = $this->db->get()->result_array();
            if (!$response === FALSE &&
                    $data['password'] === $response[0]['pass']) {
                return TRUE;
            }
            return FALSE;
        }
    }

    public function set_logged_in($data) {
        $this->db->select('user_id, member_class');
        $this->db->from('users');
        $this->db->where('nick', $data['nickname']);
        $response = $this->db->get()->result_array();
        $this->session->set_userdata(Array(
            'user_logged_in' => TRUE,
            'nickname' => $data['nickname'],
            'user_id' => $response[0]['user_id'],
            'member_class' => $response[0]['member_class'],
            'member_class_preview' => $response[0]['member_class']
        ));
    }

    public function set_logged_out() {
        $this->session->set_userdata(Array(
            'user_logged_in' => '',
            'nickname' => '',
            'user_id' => '',
            'member_class' => '',
            'member_class_preview' => ''
        ));
    }

    public function is_logged_in() {
        if ($this->session->userdata('user_logged_in')) {
            return TRUE;
        }
        return FALSE;
    }

    public function is_gallery_owner($gal_id = FALSE) {
        // user must be logged in
        if ($gal_id) {
            $this->db->select('user_id');
            $this->db->from('galleries');
            $this->db->limit(1);
            $this->db->where('gal_id', $gal_id);
            $response = $this->db->get()->result_array();
            if (!$response[0] === FALSE && $response[0]['user_id'] === $this->session->userdata('user_id')) {
                return TRUE;
            }
        }
        return FALSE;
    }

}

?>

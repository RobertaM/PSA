<?php

class Restaurant_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function set_restaurant() {
        $restaurant = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'adress' => $this->input->post('adress')
        );
        return $this->db->insert('PLACES', $restaurant);
    }

    public function get_restaurant() {

        $this->db->select();
        $this->db->from("PLACES");
        $restaurant = $this->db->get()->result_array();

        return $restaurant;
    }

    public function delete_restaurant($id) {
        $this->db->where('place_id', $id);
        $this->db->delete('PLACES');
    }

    public function get_one_restaurant($id) {

        $this->db->select('place_id, name, description, adress');
        $this->db->from("PLACES");
        $this->db->where('place_id', $id);

        $restaurant = $this->db->get()->result_array();
        return $restaurant;
    }

    public function update_restaurant($id) {
        $places = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'adress' => $this->input->post('adress')
        );

        $this->db->where('place_id', $id);
        $this->db->update('PLACES', $places);
    }

    /**
     * Get restaurants associated with specific worker's id
     * 
     * @param type $worker_id User id with worker status. Used for retrieving 
     * restaurants info
     */
    public function get_worker_restaurants($worker_id = NULL) {

        $worker_class = "worker";

        $this->db->select("PLACES.*");
        $this->db->from("USER");

        // Select workers with needed id if it exists
        if (isset($worker_id)) {
            $this->db->where("USER.user_id", $worker_id);
        }

        $this->db->where("USER.role", $worker_class);

        $this->db->join("PLACES", "USER.place_id = PLACES.place_id", "right");
        $this->db->limit(1);

        $arr = $this->db->get()->result_array();

        return $arr;
    }

}

?>
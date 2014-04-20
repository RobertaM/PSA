<?php
  class Restaurant_model extends CI_Model{

    public function __construct(){
        $this->load->database();
    }

    public function set_restaurant(){
    	$restaurant = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'adress' => $this->input->post('adress')
    	);
        return $this->db->insert('PLACES', $restaurant);
    }

    public function get_restaurant(){

        $this->db->select();
        $this->db->from("PLACES");
        $restaurant = $this->db->get()->result_array();

        return $restaurant;
    }

    public function delete_restaurant($id){        
        $this->db->where('place_id', $id);
        $this->db->delete('PLACES');
    }
  }
?>
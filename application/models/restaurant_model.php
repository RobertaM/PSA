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

  }
?>
<?php

class Product_model extends CI_Model {

    /**
     * @return place list.
     */
    public function get_products() {

        // Select all data
        $this->db->select();
        $this->db->from("PRODUCT");
        $response = $this->db->get()->result_array();

        return $response;
    }

    /**
     * Save selected places for temporary storage
     */
    public function temporarily_save_selected_products($products) {

        // Save data to session
        $this->session->set_userdata(Array(
            "selected_products" => $products
        ));
    }

    /**
     * Gets user selected places from session cookie
     */
    public function get_selected_products() {
         
        return $this->session->userdata("selected_products");
    }

}

?>

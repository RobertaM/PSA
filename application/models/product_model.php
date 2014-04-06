<?php

class Product_model extends CI_Model {

    /**
     * @return place list.
     */
    public function get_products() {

        // Get selected place from Place_model
        $this->load->model("Place_model");
        $place = $this->Place_model->get_selected_place();

        // Goodbye if no place returned
        if (!isset($place["id"]))
            return FALSE;

        $place_id = $place["id"];

        // Select all data
        $this->db->select("items.*, PLACES.place_id, categories.*,ITEM_OPTIONS.*");
        $this->db->from("PLACES");
        $this->db->join("PLACE_ITEMS", "PLACE_ITEMS.place_id = PLACES.place_id", "left");
        $this->db->join("items", "items.item_id = PLACE_ITEMS.item_id", "left");
        $this->db->join("categories", "categories.cat_id = items.cat_id", "left");
        $this->db->join("ITEM_OPTIONS", "ITEM_OPTIONS.item_id = items.item_id", "left");
        $this->db->order_by('items.item_type asc, ITEM_OPTIONS.item_id asc');
        $this->db->where("PLACES.place_id = " . $place_id);
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

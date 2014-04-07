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
        $this->db->select("ITEMS.*, PLACES.place_id, CATEGORIES.*,ITEM_OPTIONS.*,ITEM_PIZZA_BASE.*");
        $this->db->from("PLACES");
        $this->db->join("PLACE_ITEMS", "PLACE_ITEMS.place_id = PLACES.place_id", "left");
        $this->db->join("ITEMS", "ITEMS.item_id = PLACE_ITEMS.item_id", "left");
        $this->db->join("CATEGORIES", "CATEGORIES.cat_id = ITEMS.cat_id", "left");
        $this->db->join("ITEM_OPTIONS", "ITEM_OPTIONS.item_id = ITEMS.item_id", "left");
        $this->db->join("ITEM_PIZZA_BASE", "ITEM_PIZZA_BASE.option_id = ITEM_OPTIONS.option_id", "left");
        $this->db->order_by('ITEMS.item_type asc, ITEM_OPTIONS.item_id asc,ITEM_OPTIONS.option_name asc');
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

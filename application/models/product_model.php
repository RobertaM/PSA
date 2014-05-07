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
        $this->db->select("ITEMS.*, PLACES.place_id, CATEGORIES.*,ITEM_OPTIONS.*");
        $this->db->from("PLACES");
        $this->db->join("PLACE_ITEMS", "PLACE_ITEMS.place_id = PLACES.place_id", "left");
        $this->db->join("ITEMS", "ITEMS.item_id = PLACE_ITEMS.item_id", "left");
        $this->db->join("CATEGORIES", "CATEGORIES.cat_id = ITEMS.cat_id", "left");
        $this->db->join("ITEM_OPTIONS", "ITEM_OPTIONS.item_id = ITEMS.item_id", "left");
        $this->db->order_by('ITEM_OPTIONS.item_id asc,ITEM_OPTIONS.option_name asc');
        $this->db->where("PLACES.place_id = " . $place_id);
        $response = $this->db->get()->result_array();

        return $response;
    }
    public function get_categories(){
        
        $this->db->select('CATEGORIES.cat_id,CATEGORIES.cat_name');
        $this->db->from('CATEGORIES');
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

    public function set_product() {

        $item = array(
            'item_name' => $this->input->post('item_name'),
            'image' => $this->input->post('item_image'),
            'cat_id' => $this->input->post('cat')
                );
         $this->db->insert("ITEMS", $item);

    }

}

?>

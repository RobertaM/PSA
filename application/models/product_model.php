<?php

class Product_model extends CI_Model {

    /**
     * @return place list.
     */
    public function get_products($place_id = NULL) {

        // Get selected place from Place_model
        $this->load->model("Place_model");
        $place = $this->Place_model->get_selected_place();

        // Goodbye if no place returned
        if (!isset($place_id)) {
            if (!isset($place["id"]))
                return FALSE;
            else {
                $place_id = $place["id"];
            }
        }

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

    public function get_categories() {

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

        if ($this->input->post('new_category') == NULL) {

            $item = array(
                'item_name' => $this->input->post('item_name'),
                'image' => $this->input->post('item_image'),
                'cat_id' => $this->input->post('cat')
            );
            $this->db->insert("ITEMS", $item);
        }

        if ($this->input->post('new_category') != NULL) {

            $new_cat = array(
                'cat_name' => $this->input->post('new_category'));
            $this->db->insert("CATEGORIES", $new_cat);
            $new_id = $this->db->insert_id();

            $item = array(
                'item_name' => $this->input->post('item_name'),
                'image' => $this->input->post('item_image'),
                'cat_id' => $new_id
            );
            $this->db->insert("ITEMS", $item);
        }
        $id = $this->db->insert_id();

        $place_id = $this->session->userdata("user_data[place_id]");

        $place_item = array(
            'item_id' => $id,
            'place_id' => $place_id,
            'is_available' => ("1")
        );
        $this->db->insert("PLACE_ITEMS", $place_item);

        $item_option1 = array(
            'item_id' => $id,
            'option_name' => $this->input->post('option_name1'),
            'price' => $this->input->post('price1')
        );
        $this->db->insert("ITEM_OPTIONS", $item_option1);

        if ($this->input->post('option_name2') != NULL) {

            $item_option2 = array(
                'item_id' => $id,
                'option_name' => $this->input->post('option_name2'),
                'price' => $this->input->post('price2')
            );
            $this->db->insert("ITEM_OPTIONS", $item_option2);
        }

        if ($this->input->post('option_name3') != NULL) {
            $item_option3 = array(
                'item_id' => $id,
                'option_name' => $this->input->post('option_name3'),
                'price' => $this->input->post('price3')
            );
            $this->db->insert("ITEM_OPTIONS", $item_option3);
        }
    }

}

?>

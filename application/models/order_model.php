<?php

class Order_model extends CI_Model {

    /**
     * @return place list.
     */
    public function get_orders() {

        // Get selected place from Place_model
        $this->load->model("Order_model");

        $this->db->select("ORDERS.*,ITEM_OPTIONS.*,ITEMS.*,USER.*");
        $this->db->from("ORDERS");
        $this->db->join("ITEM_OPTIONS", "ITEM_OPTIONS.option_id = ORDERS.option_id", "left");
        $this->db->join("ITEMS", "ITEMS.item_id = ORDERS.product_id", "left");
        $this->db->join("USER", "USER.user_id = ORDERS.user_id", "left");
        //$this->db->join("ORDERS", "ORDERS.worker_id = USER.user_id", "left");
        $this->db->order_by('ORDERS.status asc, ORDERS.date asc');
        $response = $this->db->get()->result_array();

        return $response;
    }

    /**
     * Save selected places for temporary storage
     */
//    public function temporarily_save_selected_products($products) {
//
//        // Save data to session
//        $this->session->set_userdata(Array(
//            "selected_products" => $products
//        ));
//    }

    /**
     * Gets user selected places from session cookie
     */
//    public function get_selected_products() {
//
//        return $this->session->userdata("selected_products");
//    }

}

?>

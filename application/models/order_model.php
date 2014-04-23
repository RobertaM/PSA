<?php

class Order_model extends CI_Model {

    /**
     * @return place list.
     */
    public function get_orders() {

        // Get selected place from Place_model
        $this->load->model("Order_model");
        $this->db->SELECT("*")->FROM("ORDERS,ORDERED_ITEMS");        
        $this->db->join("USER AS WRK","WRK.user_id=ORDERS.worker_id","left");
        $this->db->join("USER AS USR","USR.user_id=ORDERS.user_id","left");
        $this->db->join("ITEMS","ITEMS.item_id=ORDERED_ITEMS.item_id","left");
        $this->db->where("`ORDERS`.`order_id`=`ORDERED_ITEMS`.`order_id`");
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

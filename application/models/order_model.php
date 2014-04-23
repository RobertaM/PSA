<?php

class Order_model extends CI_Model {

    /**
     * @return place list.
     */
    public function get_orders() {

// 
//        $this->db->SELECT("*")->FROM("ORDERS,ORDERED_ITEMS");    
//        $this->db->join("USER AS WRK","WRK.user_id=ORDERS.worker_id","natural");
//        $this->db->join("USER AS USR","USR.user_id=ORDERS.user_id","natural");
//        $this->db->join("ITEMS","ITEMS.item_id=ORDERED_ITEMS.item_id","left");
//        $this->db->where("`ORDERS`.`order_id`=`ORDERED_ITEMS`.`order_id`");
//        
//        $this->db->select("ORDERS.*,ORDERED_ITEMS.*,ITEMS.*,CONCAT(`name`,' ',`surname`) AS `USRN`, CONCAT(`name`,' ',`surname`) AS `WORKR`",FALSE);
//        $this->db->from("USER,ORDERS,ORDERED_ITEMS,ITEMS");
//        $this->db->SELECT("*")->FROM("ORDERS,ORDERED_ITEMS,ITEMS");    
//        $this->db->join("USER AS WRK","WRK.user_id=ORDERS.worker_id","natural");
//        $this->db->join("USER AS USR","USR.user_id=ORDERS.user_id","natural");
//        $this->db->join("ITEMS AS ITEM","ITEM.item_id=ORDERED_ITEMS.item_id","left");
//        $this->db->where("`ORDERS`.`order_id`=`ORDERED_ITEMS`.`order_id`");
        $sql="
            SELECT  CONCAT(`WRK`.`name`,' ', `WRK`.`surname`,' ',`WRK`.`phone_number`) AS `WORKER`,CONCAT(`USR`.`name`,' ', `USR`.`surname`,' ',`USR`.`phone_number`) AS `USER`,`ORDERS`.*,`ORDERED_ITEMS`.`quantity`,`ITEMS`.`item_name`,`ITEM_OPTIONS`.`option_name`,`ITEM_OPTIONS`.`price`
        FROM (`ORDERS`,`ORDERED_ITEMS`)
        LEFT JOIN `USER` AS `WRK` ON `WRK`.`user_id`=`ORDERS`.`worker_id` 
        LEFT JOIN `USER` AS `USR` ON `USR`.`user_id`=`ORDERS`.`user_id` 
        LEFT JOIN `ITEMS` ON `ITEMS`.`item_id`=`ORDERED_ITEMS`.`item_id` 
        LEFT JOIN `ITEM_OPTIONS` ON `ITEM_OPTIONS`.`option_id`=`ORDERED_ITEMS`.`option_id` 
        WHERE `ORDERS`.`order_id`=`ORDERED_ITEMS`.`order_id`
        
        ";
        $query = $this->db->query($sql);
//        $this->db->SELECT("ORDERED_ITEMS.*, CONCAT('WRK.name',' ','WRK.surname') AS `WORKR`")->FROM("ORDERS,ORDERED_ITEMS");
//        $this->db->join("USER AS WRK", "WRK.user_id=ORDERS.worker_id", "natural");
//        $this->db->join("USER AS USR", "USR.user_id=ORDERS.user_id", "natural");
//        $this->db->join("ITEMS", "ITEMS.item_id=ORDERED_ITEMS.item_id", "left");
//        $this->db->where("`ORDERS`.`order_id`=`ORDERED_ITEMS`.`order_id`");
        
        $response = $query->result_array();
        
//         foreach ($query->result_array() as $response)
//            {
//               return $response;
//               
//            }


//        $response = $this->db->query->result_array();

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

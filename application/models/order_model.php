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
        $sql = "
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
     * @return place list.
     */
    public function get_specific_orders($place_id = NULL) {
        $sql = "SELECT 
    CONCAT(`WRK`.`name`,' ', `WRK`.`surname`,' ',`WRK`.`phone_number`) AS `WORKER`,
    CONCAT(`USR`.`name`,' ', `USR`.`surname`,' ',`USR`.`phone_number`) AS `USER`,
    `ORDERS`.*,`ORDERED_ITEMS`.`quantity`,
    `ITEMS`.`item_name`,
    `ITEM_OPTIONS`.`option_name`,
    `ITEM_OPTIONS`.`price`
FROM (`ORDERS`,`ORDERED_ITEMS`)
LEFT JOIN `USER` AS `WRK` ON `WRK`.`user_id`=`ORDERS`.`worker_id` 
LEFT JOIN `USER` AS `USR` ON `USR`.`user_id`=`ORDERS`.`user_id` 
LEFT JOIN `ITEMS` ON `ITEMS`.`item_id`=`ORDERED_ITEMS`.`item_id` 
LEFT JOIN `ITEM_OPTIONS` ON `ITEM_OPTIONS`.`option_id`=`ORDERED_ITEMS`.`option_id` 
WHERE `ORDERS`.`order_id`=`ORDERED_ITEMS`.`order_id`";

        // Add one more case if needed
        if (isset($place_id)) {
            $sql .= " AND `ORDERS`.`place_id` = " . $place_id;
        }

        // Order by order id
        $sql .= "\nORDER BY `ORDERS`.`order_id`;";

        $query = $this->db->query($sql);
        $response = $query->result_array();

        return $response;
    }

    public function edit_orders() {
        $sql = "
        SELECT 
            CONCAT(`WRK`.`name`,' ', `WRK`.`surname`,' ',`WRK`.`phone_number`) AS `WORKER`,
            CONCAT(`USR`.`name`,' ', `USR`.`surname`,' ',`USR`.`phone_number`) AS `USER`,
            `ORDERS`.*,`ORDERED_ITEMS`.`quantity`,
            `ITEMS`.`item_name`,
            `ITEM_OPTIONS`.`option_name`,
            `ITEM_OPTIONS`.`price`
        FROM (`ORDERS`,`ORDERED_ITEMS`)
        LEFT JOIN `USER` AS `WRK` ON `WRK`.`user_id`=`ORDERS`.`worker_id` 
        LEFT JOIN `USER` AS `USR` ON `USR`.`user_id`=`ORDERS`.`user_id` 
        LEFT JOIN `ITEMS` ON `ITEMS`.`item_id`=`ORDERED_ITEMS`.`item_id` 
        LEFT JOIN `ITEM_OPTIONS` ON `ITEM_OPTIONS`.`option_id`=`ORDERED_ITEMS`.`option_id` 
        WHERE `ORDERS`.`order_id`=`ORDERED_ITEMS`.`order_id`";


        $query = $this->db->query($sql);
        $response = $query->result_array();

        return $response;
    }

    /**
     * Array containing available and selected order states of desired order
     * @param string $current_state String containing current state
     */
    public function get_available_order_states($current_state = null) {
        // If current user is manager, then add all states
        $this->load->model("User_model");
        if ($this->User_model->is_manager()) {
            return $this->get_all_order_states();
        }

        // Check if string
        if (!is_string($current_state)) {
            return array();
        }

        // Decide what states to return
        $add_all_next = false;
        $states = array();
        foreach ($this->get_all_order_states() as $state) {
            $state["selected"] = false;
            if ($state["name"] === $current_state) {
                $add_all_next = true;
                $state["selected"] = true;
            }
            if ($add_all_next) {
                array_push($states, $state);
            }
        }
        return $states;
    }

    /**
     * Gets all possible order states (non DB)
     */
    private function get_all_order_states() {
        return array(
            array(
                "name" => "pending",
                "display_name" => "Pending"
            ),
            array(
                "name" => "accepted",
                "display_name" => "Accepted"
            ),
            array(
                "name" => "completed",
                "display_name" => "Completed"
            )
        );
    }

    /**
     * 
     * @param int $order_id
     * @return order status string from DB or null if not found
     */
    public function get_order_state($order_id) {
        if (!isset($order_id))
            return null;

        $result = $this->db->select("order_status")
                        ->from("ORDERS")
                        ->limit(1)
                        ->where("order_id = " . $order_id)
                        ->get()->result_array();

        if (count($result) < 1) {
            return null;
        } else {
            return $result[0]["order_status"];
        }
    }

    /**
     * Sets new order status. Returns status of an attempt as boolean.
     * 
     * @param type $orderId Order to update status to
     * @param type $status status to set
     * @return boolean success or failure
     */
    public function try_set_order_state($orderId, $status) {
        // Check input
        if (!is_string($status) || !is_numeric($orderId)) {
            echo "A";
            return false;
        }

        // Get current state of an order
        $current_state = $this->get_order_state($orderId);

        // Get states that are permitted to change into by current user
        $available_states = $this->get_available_order_states($current_state);

        // Check if given input matches with available choices
        $given_state_matched = false;
        foreach ($available_states as $state) {
            if ($status === $state["name"]) {
                $given_state_matched = true;
            }
        }

        // Privileges or string do not match to change the state of the offer
        if (!$given_state_matched) {
            return false;
        }

        // Check if order state is already the same
        if ($state == $current_state) {
            return false;
        }

        // Save to db
        $this->DB_set_order_status($orderId, $status);

        // Return final result
        return true;
    }

    /**
     * Upload new order state to database.
     * 
     * @param type $orderId Order id to change.
     * @param type $status Status to apply.
     */
    private function DB_set_order_status($orderId, $status) {
        $this->db->where("order_id =", $orderId);
        $this->db->update("ORDERS", array(
            "order_status" => $status
        ));
    }

}

<?php

/**
 * Interaction with cart
 * @author Martynas Maciulevičius
 */
class Cart_model extends CI_Model {

    /**
     * @return Array containing cart items
     */
    public function get_cart_items() {
        return $this->session->userdata("cart");
    }

    public function save_cart_items($item_array) {
        $this->session->set_userdata("cart", $item_array);
    }

    /**
     * @return Boolean True if cart has items in it.
     */
    public function cart_exists() {
        return ($this->session->userdata("cart") != null);
    }

    public function load_cart() {
        $this->load->view("cart/cart");
    }

    /**
     * Generates a new order and inserts into database
     */
    public function submit_cart() {
        // Load place model, It has selected place id
        // User model has current user id
        $this->load->model("Place_model");

        // Iteration variables
        $place = $this->Place_model->get_selected_place()["id"];
        $qty = "quantity";

        // Get cart items from specified place
        $cart = $this->get_cart_items()[$place];
        if (!isset($cart)) {
            return;
        }

        // Construct new order items
        $items = array();
        foreach ($cart as $item_id => $item) {
            // Not array?
            if (!is_array($item)) {
                continue;
            }
            foreach ($item as $option_id => $option) {
                // Not array?
                if (!is_array($option)) {
                    continue;
                }
                /**
                  echo "place: " . $place . "\n";
                  echo "item: " . $item["name"] . "\n";
                  echo "option name: " . $option["name"] . "\n";
                  echo "item id: " . $item_id . "\n";
                  echo "option id: " . $option_id . "\n";
                  echo "quantity: " . $option[$qty] . "\n";
                  echo "-----------------------\n";
                  /* */
                array_push($items, array(
                    "item_id" => $item_id,
                    "option_id" => $option_id,
                    "quantity" => $option[$qty]
                ));
            }
        }

        // Destroy cart


        $this->put_new_order($place, $items);
    }

    /**
     * Saves new order into the database
     * 
     * @param int $place_id Order place
     * @param array of arrays $items Items to be added to ORDERED_ITEMS table.
     */
    private function put_new_order($place_id, $items) {

        $this->load->model("User_model");

        // Add new order
        $this->db->insert("ORDERS", array(
            "place_id" => $place_id,
            "user_id" => $this->User_model->get_id(),
            "date_received" => date("Y-m-d H:i:s")
//            , "order_status" => 0
        ));

        // Construct batch query
        $query = "INSERT INTO `ORDERED_ITEMS` "
                . "(`order_id`, `item_id`, `option_id`, `quantity`) VALUES ";

        $first = true;
        foreach ($items as $item) {
            if (!$first) {
                $query .= ", \n";
            }
            $query .= "(LAST_INSERT_ID(), " .
                    $item["item_id"] . ", " .
                    $item["option_id"] . ", " .
                    $item["quantity"] . ")";
            $first = false;
        }
        $query .= ";";

        // Destroy cart items
        $this->destroy_cart();

        // Add all data from item array
        $this->db->query($query);
    }

    /**
     * Removes everything from cart
     */
    public function destroy_cart() {
        $this->save_cart_items(null);
    }

}

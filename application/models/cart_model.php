<?php

/**
 * Interaction with cart
 * @author Martynas Maciulevičius
 */
class Cart_model extends CI_Model {
    /**
     * Add one item to cart
     */
//    public function add_one_item($place_id = null, $item_id = null, $item_option = null, $place_name = null, $item_name = null, $item_option_name = null) {
//
//        // Exit if any of these do not exist (Can't insert anything)
//        if (!isset($place_id) || !isset($item_id) || !isset($item_option)) {
//            return;
//        }
//
//        // Replace blank spaces
//        if (!isset($place_name)) {
//            $place_name = "Not set";
//        }
//        if (!isset($item_name)) {
//            $item_name = "Not set";
//        }
//        if (!isset($item_option_name)) {
//            $item_option_name = "Not set";
//        }
//
//        // Get saved data if it exists
//        $cart_items = $this->session->userdata("cart_items");
//
//        // Initialise if array is not present
//        if (!isset($cart_items)) {
//            $cart_items = array();
//        }
//
//        // Check if only one place is set and set if not
//        if (!isset(key($cart_items))) {
//            echo "key:" . key($cart_items);
//        }
//
//        // Add to array
////        $cart_items[$place_id]
//        // Add to session storage
//    }

    /**
     * @return Array containing cart items
     */
    public function get_cart_items() {

        return $this->session->userdata("cart_items");
    }

    public function save_cart_items($item_array) {
        $this->session->set_userdata("cart_items", $item_array);
    }

}

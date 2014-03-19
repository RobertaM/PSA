<?php
/**
 * Interaction with cart
 * @author Martynas Maciulevičius
 */
class Cart_model extends CI_Model {

    /**
     * Add items to cart.
     * Array or a single item.
     * Data structure is defined in add_one_item() function
     */
    public function add_many_items($data) {

        // Array?
        if(!is_array($data))
            throw new Exception("Array can not be added");

        // Get items from cart
        $cart_items = get_cart_items();

        // Check data consistency and add to cart array
        foreach ($data as $item) {
            $item_ok = isset($item["item_id"]);
            $item_ok = isset($item["quantity"]) && $item_ok;
            $item_ok = isset($item["item_name"]) && $item_ok;

            if($item_ok)
                array_push(&$cart_items, $item);
            else
                throw new Exception("Array item can not be added");
        }
    }

    /**
     * Add one item to cart
     * @param integer $item_id
     * @param integer $qantity
     */
    public function add_one_item($item_id, $qantity, $item_name) {
        add_many_items(
            Array(
                "item_id" => $item_id,
                "quantity" => $quantity,
                "item_name" => $item_name
            )
        );
    }

    /**
     * @return Array containing cart items
     */
    public function get_cart_items() {

        $session_cart = $this->session->userdata("cart_items");

        // If session has no cart then return new array
        if(!isset($session_cart))
            $session_cart = Array();

        return $session_cart;
    }
}
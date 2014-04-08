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
        return isset($this->session->userdata("cart"));
    }
    
    public function load_cart(){
         $this->load->view("cart/cart");
    }

}

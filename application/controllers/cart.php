<?php

class Cart extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Load cart model
        $this->load->model(Array('Cart_model', 'Place_model'));
    }

    /**
     * Sorry, too long and i am lazy to refactor. Martin. :/
     */
    public function add($item_id = null, $item_option = null, $item_name = "Not set", $item_option_name = "Not set") {

        // Get place name
        $place = $this->Place_model->get_selected_place();

        // Return if no place and item is specified
        if (!(isset($item_id) && isset($place["id"]))) {
            $this->send_json_result(
                    'Error: You son of a ...'
            ); 
            return;
        }

        // Get cart items
        $cart = $this->Cart_model->get_cart_items();
        $place_id = $place["id"];

        // Cart is empty?. initialise an array.
        if (!isset($cart)) {
            $cart = array();
        }

        // Check if cart has selected place element
        if (!isset($cart[$place_id])) {
            $cart[$place_id] = array();
        }

        // Remove all items except selected place if more exists
        if (count(array_keys($cart)) > 1) {
            $temp = $cart[$place_id];
            $cart = array($place_id => $temp);
        }

        // Item id array is set?
        if (!isset($cart[$place_id][$item_id])) {
            $cart[$place_id][$item_id] = array();
        }

        // Item option set?
        if (!isset($cart[$place_id][$item_id][$item_option])) {
            $cart[$place_id][$item_id][$item_option] = array();
        }

        // Item quantity
        $qty = "quantity";
        if (isset($cart[$place_id][$item_id][$item_option][$qty])) {
            $qty_number = $cart[$place_id][$item_id][$item_option][$qty];
            if ($qty_number < 0) {
                $cart[$place_id][$item_id][$item_option][$qty] = 0;
            }
        } else {
            $cart[$place_id][$item_id][$item_option][$qty] = 0;
        }

        // Increase quantity
        ++$cart[$place_id][$item_id][$item_option][$qty];

        // Set names
        $name = "name";
        $cart[$place_id][$name] = $place[$name];
        $cart[$place_id][$item_id][$name] = $item_name;
        $cart[$place_id][$item_id][$item_option][$name] = $item_option_name;

        // Save to session data
        $this->Cart_model->save_cart_items($cart);

        // Return json result
        $this->send_json_result("Success. Item inserted sucessfully", true);
    
    }

    /**
     * Submits cart from session
     */
    public function submit() {
        $this->Cart_model->submit_cart();
        $this->send_json_result("Submitted!", true);
    }

    /**
     * Displays message and success status
     * 
     * @param type $$message Message to encode
     */
    private function send_json_result($message, $success = false) {
        $this->output->set_content_type('application/json')->
                set_output(json_encode(array(
                    "success" => $success,
                    "message" => $message
        )));
        
    }

    /**
     * Permanently clears cart content.
     */
    public function clear() {
        $this->Cart_model->destroy_cart();
        $this->send_json_result("Success. Cart cleared,", true);
    }

    /**
     * Remove item from cart
     * 
     * @param type $item_id Item to remove
     * @param type $item_option option to remove
     */
    public function remove($item_id, $item_option) {

        if (!$this->User_model->is_logged_in()) {
            $this->send_json_result('Error: You son of a ...');
            return;
        }

        // Get place id, cart
        $place_id = $this->Place_model->get_selected_place()["id"];

        // Get cart
        $cart = $this->Cart_model->load_cart();

        // Check if cart index exists
        if (isset($cart[$place_id][$item_id][$item_option])) {

            // TODO write remove logic
        }
        echo "not implemented yet";
    }

}

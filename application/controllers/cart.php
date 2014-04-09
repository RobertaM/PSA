<?php

class Cart extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Load cart model
        $this->load->model(Array('Cart_model', 'Place_model'));
    }

    public function add($item_id = null, $item_option = null, $item_name = "Not set", $item_option_name = "Not set") {

        // Get place name
        $place = $this->Place_model->get_selected_place();

        // Return if no place and item is specified
        if (!(isset($item_id) && isset($place["id"]))) {
            $this->output->set_content_type('application/json')->
                    set_output(json_encode(array(
                        'success' => false,
                        'message' => 'Error: You son of a ...'
            )));
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

        $this->output->set_content_type('application/json')->set_output(
                json_encode(
                        array(
                            'success' => true,
                            'message' => "Success. Item inserted sucessfully"
                        )
                )
        );
    }

    public function submit_all_items() {
        
    }

}

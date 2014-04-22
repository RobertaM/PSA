<?php

class Orders extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model(Array('Order_model'));
    }

    public function index() {
        // Redirect
        redirect(base_url("orders/select"), 'refresh');
    }

    /**
     * Select products from list and add them to cart.
     */
    public function select() {

        // Get data from database
        $products = $this->Order_model->get_orders();

        // Check if products are not returned
        if ($products === FALSE) {
            $message = "No Orders awailable.";

            $this->load->view("static/header", Array("title" => $message));
            $this->load->view("static/show_message", Array("message" => $message));
            $this->load->view("static/footer");
            return;
        }

                    // Load headers and form itself
            $this->load->view("static/header", Array(
                "title" => "Orders"));

            $this->load->view("orders/list_orders", Array(
                'products' => $products));
            $this->load->view("static/footer");

//
//            // Redirect
//            redirect(base_url("products/select/"), 'refresh');
        }
    }

?>

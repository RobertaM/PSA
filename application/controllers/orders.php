<?php

class Orders extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model(Array('Order_model'));
    }

    public function index() {
        // Redirect
        redirect(base_url("orders/listing"), 'refresh');
    }

    /**
     * Select products from list and add them to cart.
     */
    public function listing() {

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
    
    public function get_specific_orders() {

        // Get data from database
        $products = $this->Order_model->get_specific_orders(1);

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
    
     public function edit_orders() {

        // Get data from database
        $products = $this->Order_model->edit_orders();

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


    public function accept() {
        if (!$this->User_model->is_worker()) {
            show_404();
        }

        $this->load->model(array("Restaurant_model", "Order_model"));
        $restaurant = $this->Restaurant_model->get_worker_restaurants(
                $this->User_model->get_id());

        // Restaurant exists?
        if (!isset($restaurant[0])) {
            $message = "You had not been assigned to any restaurant.";

            $this->load->view('static/header', array("title" => $message));
            $this->load->view('static/show_message', array(
                "message" => $message,
                "detailed_message" => "Contact your manager."
            ));
            $this->load->view('static/footer');
            return;
        }

        $restaurant = $restaurant[0];
        // TODO LATER $this->User_model->set_worker_restaurant($restaurants);
        // Get orders
        $orders = $this->Order_model->get_specific_orders($restaurant["place_id"]);

        echo "<pre>";
        var_dump($restaurant);
        echo "<br/>";
        echo "<br/>";
        var_dump($orders);
        echo "</pre>";
    }

}

?>

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
        // Authorisation
        if (!$this->User_model->is_worker()) {
            show_404();
        }

        // Load models and data
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
        } else {
            $restaurant = $restaurant[0];
        }

        // Save data to session for later usage TODO: is it needed?
        $this->User_model->set_worker_restaurant($restaurant);

        // Get orders
        $orders = $this->Order_model->get_specific_orders($restaurant["place_id"]);

        // Load interface
        $title = "Accept orders";
        $this->load->view("static/header", array(
            "title" => $title,
            "scripts" => array("workerScripts.js")
        ));
        $this->load->view("orders/orders_accept", array(
            "orders" => $orders,
            "restaurant" => $restaurant
        ));
        $this->load->view("static/footer");
    }

    /**
     * 
     * @param int $orderId Order to change
     * @param string $status Status to change into.
     */
    public function status($orderId = null, $status = null) {
        // Authorisation. Not worker or manager?
        if (!($this->User_model->is_worker() || $this->User_model->is_manager())) {
            show_404();
        }

        // Load helper for output
        $this->load->helper("json_helper");

        // Try to change offer status
        $success = $this->Order_model->try_set_order_state($orderId, $status);
        if ($success) {
            send_json_message("Success!", TRUE);
        } else {
            send_json_message("Error: Something went wrong!");
        }

//        $this->Order_model->get_order_status()
//        
//        send_json_result("end");
    }

}

?>

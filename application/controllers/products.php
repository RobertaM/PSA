<?php
class Products extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(Array('Product_model'));
    }

    public function index() {
        // Redirect
        redirect(base_url("products/select"), 'refresh');
    }
    /**
     * Select products from list and add them to cart.
     */
    public function select() {

        // Get data from database
        $products = $this->Product_model->get_products();

        // Check if products are not returned
        if($products === FALSE) {
            $message = "Please select another place.";

            $this->load->view("static/header", Array("title" => $message));
            $this->load->view("static/show_message", Array("message" => $message));
            $this->load->view("static/footer");
            return;
        }

        // Load form library
        $this->load->library("form_validation");
        $this->form_validation->set_rules("none"); // Don't apply any rules

        // Actual form checking
        if($this->form_validation->run() == FALSE) {

            // Load headers and form itself
            $this->load->view("static/header");
            $this->load->view("products/list_all_products",
                Array('products' => $products)
            );
            $this->load->view("static/footer");

        } else {

            // Load all the submitted data into session variable
            $this->Product_model->temporarily_save_selected_products(
                $this->input->post(null, TRUE)
            );

            // Redirect
            redirect(base_url("products/select/"), 'refresh');
        }
    }

}

?>

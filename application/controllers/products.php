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

    public function select() {

        // Get data from database
        $products = $this->Product_model->get_products();

        // Load form library
        $this->load->library("form_validation");
        $this->form_validation->set_rules("none"); // Don't apply any rules

        // Actual form checking
        if($this->form_validation->run() == FALSE) {

            // Set checkbox states
            $product_states = $this->Product_model->get_selected_products();
            foreach ($products as $key => $product)
                $products[$key]["checked"] =
                isset($product_states[$product['product_id']]);


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
            redirect(base_url("product/view"), 'refresh');
        }
    }

}

?>

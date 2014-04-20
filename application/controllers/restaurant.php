<?php
class Restaurant extends CI_Controller {
  
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Restaurant_model');
    }   

    public function index(){
    	$this->load->helper('url');
        redirect(base_url('restaurant/addRestaurant'));
    }

    public function addRestaurant(){
    	$this->load->helper('form');
    	//$this->load->library('form_validation');

    	$this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('adress', 'Address', 'required');
   
        if($this->form_validation->run() === FALSE){
        	$this->load->view('static/header');
            $this->load->view('restaurant/add_restaurant');
            $this->load->view('static/footer');
        }  else {
        	$this->Restaurant_model->set_restaurant();
        }
    }

    public function deleteRestaurant($place_id=''){
        //echo $place_id;
        $this->Restaurant_model->delete_restaurant($place_id);
    }

    public function manageRestaurants(){
        $restaurant['restaurant'] = $this->Restaurant_model->get_restaurant();

        $this->load->view('static/header');
        $this->load->view('restaurant/delete_restaurant', $restaurant);
        $this->load->view('static/footer');
    }
}

?>

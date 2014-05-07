<?php

class Restaurant extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Restaurant_model');
    }

    public function index() {
        $this->load->helper('url');
        redirect(base_url('restaurant/addRestaurant'));
    }

    public function addRestaurant() {
        $this->load->helper('form');
        $id = $this->uri->segment(3);
        if ($id === FALSE) {
            $restaurant['restaurant'] = null;
        } else {
            $restaurant['restaurant'] = $this->Restaurant_model->get_one_restaurant($id);
        }
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('adress', 'Address', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('static/header');
            if ($id === FALSE) {
                $this->load->view('restaurant/add_restaurant');
            } else {
                $this->load->view('restaurant/edit_restaurant', $restaurant);
            }
            $this->load->view('static/footer');
        } else {
            if ($id === FALSE) {
                $this->Restaurant_model->set_restaurant();
                echo '<script>alert("You Have Successfully add new restaurant!");</script>';
                redirect('http://localhost/PSA/site/restaurant/addRestaurant');
            } else {
                $this->Restaurant_model->update_restaurant($id);
                echo '<script>alert("You Have Successfully edit restaurant!");</script>';
                redirect('http://localhost/PSA/site/restaurant/manageRestaurants');
            }
        }
    }

    public function deleteRestaurant($place_id = '') {
        $this->Restaurant_model->delete_restaurant($place_id);
        echo '<script>alert("You Have Successfully deleted restaurant");</script>';
        redirect('http://localhost/PSA/site/restaurant/manageRestaurants');
    }

    public function manageRestaurants() {
        $restaurant['restaurant'] = $this->Restaurant_model->get_restaurant();

        $this->load->view('static/header');
        $this->load->view('restaurant/delete_restaurant', $restaurant);
        $this->load->view('static/footer');
    }

}

?>

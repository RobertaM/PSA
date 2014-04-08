<?php

/**
 * User controller gives basic login/log-out/view functionality for all users.
 * @author Martynas Maciulevičius
 *
 */
class Places extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Place_model');
    }

    public function index() {
        // Redirect
        redirect(base_url("places/select"), 'refresh');
    }

    /**
     * Method to select a place. Provides user with a set of radio buttons to
     * select a place.
     */
    public function select() {

        // Get data from database
        $places = $this->Place_model->get_places();

        // Load form library
        $this->load->library("form_validation");

        // TODO: implement: print error message
        $this->form_validation->set_rules('place-radio', 'place', 'required');

        // Actual form checking
        if ($this->form_validation->run() == FALSE) {

            // Set checkbox states
            $selected_place_id = $this->Place_model->get_selected_place();
            foreach ($places as $key => $place) {
                // Set to true if place id equals session place id
                $places[$key]["checked"] = isset($selected_place_id) && ($place["place_id"] === $selected_place_id);
            };

            // Load headers and form itself        
            
            $this->load->view("static/header", Array(
                "title" => "Select a place"));
            
            $this->load->view("places/list_all", Array('places' => $places)
            );

            $this->load->view("static/footer");
        } else {

            // Get selected radio button index from session if it exists
            $post_array = $this->input->post(null, TRUE);
            $selected_button = $post_array["place-radio"];

            // Load all the submitted data into session variable
            $this->Place_model->temporarily_save_selected_place(
                    array(
                        "id" => $selected_button,
                        "name" => $places[$selected_button]["name"]
                    )
            );

            // Redirect
            redirect(base_url("products/select"), 'refresh');
        }

//        echo "<pre>";
//        var_dump();
//        echo "<pre>";
    }

}

?>

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

    public function select() {

        // Get data from database
        $places = $this->Place_model->get_places();

        // Load form library
        $this->load->library("form_validation");

        // TODO: implement: print error message
        $this->form_validation->set_rules('place-radio', 'place', 'required');

        // Actual form checking
        if($this->form_validation->run() == FALSE) {

            // Set checkbox states
            $place_states = $this->Place_model->get_selected_places();
            foreach ($places as $key => $place)
                $places[$key]["checked"] =
                isset($place_states[$place['place_id']]);


            // Load headers and form itself
            $this->load->view("static/header");
            $this->load->view("places/list_all",
                Array('places' => $places)
            );
            $this->load->view("static/footer");

        } else {

            $post_array = $this->input->post(null, TRUE);
            $selected_button = $post_array["place-radio"];
            echo $selected_button;

            // Load all the submitted data into session variable
            $this->Place_model->temporarily_save_selected_place(
                $selected_button
            );

            // Redirect
            redirect(base_url("product/view"), 'refresh');
        }
    }

}

?>

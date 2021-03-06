<?php
class Register extends CI_Controller {

    public function index() {
        $this->load->helper('url');
        $this->load->view('user/reg/r');
    }

    /**
     * User login method.
     * User may login or be redirected to his homepage or error message.
     */
  /*  public function login() {

        // User is already logged in?
        if (!$this->session->userdata('user_logged_in_status') === FALSE) {
            // Redirect
            $this->load->helper('url');
            redirect(base_url('user/view/' . $this->session->userdata('nickname')));
            return;
        }

        // User is not logged in

        // Load form validation
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters(
            '<div class="input-error-message left">', '</div>'
        );

        // Set validation rules
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        // Validate submitted data
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('static/header', Array('title' => 'Log in'));
            $this->load->view('user/login/form');
        } else {
            // Pperform password check
            if ($response = $this->User_model->check_password($this->input->post(null, TRUE))) {
                $this->User_model->set_logged_in($response['userdata']);
                $this->load->helper('url');
                redirect(base_url('user/view/' . $this->session->userdata('username')));
            } else {
                $this->load->view('static/header', Array('title' => 'Log in'));
                $this->load->view('user/login/bad_data');
            }
        }
        $this->load->view('static/footer');

    }

    /**
     * This method logs the user out.
     */
   /* public function logout(){

        // Remove user data from session
        $this->User_model->set_logged_out();

        // Redirect user to login screen
        $this->load->helper('url');
        redirect(base_url('user/login'));
    }

    /**
     * View self or specific user.
     * TODO: get more data about user later.
     *
     * @param String $username user to view
     */
    /*public function view($username = NULL) {

        // Check for user eligibility
        if(!$this->User_model->is_logged_in()){
            show_404(NULL, FALSE);
            return;
        }

        // View self or another user
        if(!isset($username)){
            $username = $this->session->userdata('user_data');
            $username = $username['username'];
        }

        $this->load->view('static/header', Array('title' => 'User ' . $username));

        $this->load->view('user/view/view_one', Array(
            'user' => Array(
                'nickname' => $username
            )
        ));
        $this->load->view('static/footer');
    }

    /**
     * Register method placeholder
     * TODO: implement
     */
    /*public function register(){
        $this->load->view('reg/register');
    } 
*/
}

?>
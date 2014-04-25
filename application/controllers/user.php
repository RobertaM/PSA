<?php

/**
 * User controller gives basic login/log-out/view functionality for all users.
 * @author Martynas Maciulevičius
 *
 */
class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index() {
        $this->load->helper('url');
        redirect(base_url('user/login/' . $this->session->userdata('nickname')));
    }

    /**
     * User login method.
     * User may login or be redirected to his homepage or error message.
     */
    public function login() {

        // User is already logged in?
        if (!$this->session->userdata('user_logged_in_status') === FALSE) {
            // Redirect
            //             $this->load->helper('url');
            redirect(base_url('user/view/' . $this->session->userdata('nickname')));
            $this->redirect_after_login();
            return;
        }

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
            // Perform password check
            $response = $this->User_model->check_password($this->input->post(null, TRUE));
            if ($response['status'] === TRUE) {
                $this->User_model->set_logged_in($response['userdata']);
                $this->redirect_after_login();
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
    public function logout() {

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
    public function view($username = NULL) {

        // Check for user eligibility
        if (!$this->User_model->is_logged_in()) {
            show_404(NULL, FALSE);
            return;
        }

        // View self or another user
        if (!isset($username)) {
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

    public function view_profile($username = NULL) {

        // Check for user eligibility
        if (!$this->User_model->is_logged_in()) {
            show_404(NULL, FALSE);
            return;
        }

        // View self or another user
        if (!isset($username)) {
            $username = $this->session->userdata('user_data');
            $username = $username['username'];
            $name = $this->session->userdata('user_data');
            $name = $name['name'];
            $surname = $this->session->userdata('user_data');
            $surname = $surname['surname'];
            $phone_number = $this->session->userdata('user_data');
            $phone_number = $phone_number['phone_number'];
        }

        $this->load->view('static/header', Array('title' => 'User ' . $username));

        $this->load->view('user/view/view_profile', Array(
            'user' => Array(
                'nickname' => $username,
                'name' => $name,
                'surname' => $surname,
                'phone_number' => $phone_number
            )
        ));
        $this->load->view('static/footer');
    }

    /**
     * Register 
     */
    public function register($rol = '') {


        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('surname', 'surname', 'required');
        $this->form_validation->set_rules('phone_number', 'phone_number', 'required');
        $this->form_validation->set_rules('passconf', 'passconf', 'required');


        $this->form_validation->set_rules('username', 'username', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[4]|max_length[32]');
        $this->form_validation->set_rules('passconf', 'passconf', 'trim|required|matches[password]');
        $this->form_validation->set_rules('phone_number', 'phone_number', 'trim|required|min_length[9]');

        $role = array("id" => $this->uri->segment(3));
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('static/header');
            $this->load->view('user/register/register_form', $role);
            $this->load->view('static/footer');
        } else {
            $role = $this->uri->segment(3);
            $this->User_model->set_user($role);
        }
    }

    public function edit_user($id = '') {

        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('surname', 'surname', 'required');
        $this->form_validation->set_rules('phone_number', 'phone_number', 'required');
        $this->form_validation->set_rules('passconf', 'passconf', 'required');


        $this->form_validation->set_rules('username', 'username', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[4]|max_length[32]');
        $this->form_validation->set_rules('passconf', 'passconf', 'trim|required|matches[password]');
        $this->form_validation->set_rules('phone_number', 'phone_number', 'trim|required|min_length[9]');

        $id = $this->uri->segment(3);
        $user = $this->User_model->get_one_user($id);
        $user['id'] = $id;
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('static/header');
            $this->load->view('user/register/edit_form', array(
                "user" => $user,
                "id" => $id
            ));
            $this->load->view('static/footer');
        } else {
            // $id = $this->uri->segment(3);
            $this->User_model->update_user($id);
        }
    }

    public function manage_users() {
        $users['users'] = $this->User_model->get_users();

        $this->load->view('static/header');
        $this->load->view('user/view/manage_users', $users);
        $this->load->view('static/footer');
    }

    public function delete_user($user_id = '') {
        $this->User_model->delete_user($user_id);
    }

    private function redirect_after_login() {

        $this->load->helper('url');

        $url;

        switch ($this->User_model->get_user_status()) {

            case "manager":
            case "worker":
                $url = 'orders/accept/';
                break;

            case "user":
                $url = 'user/view/' . $this->session->userdata('username');
                break;

            default :
                $url = 'user/login/';
                break;
        }
        redirect(base_url($url));
    }

}

?>

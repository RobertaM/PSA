<?php

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(Array('User_model', 'Gallery_model'));
    }

    public function index() {
        $this->load->view('static/header', Array('title' => 'Latest users'));
        $response['users'] = $this->User_model->get_users();
        $this->load->view('users/view_many', $response);
        $this->load->view('static/footer');
    }

    public function view($nick = FALSE) {
        if (!$nick === FALSE) {
            $nick = str_replace('%20', ' ', $nick);
            $response['user'] = $this->User_model->get_users($nick);
            if (!$response['user'] === FALSE) {
                if ($this->session->userdata('user_logged_in')) {
                    if (strtolower($this->session->userdata('nickname')) === strtolower($nick) || $this->view_as_admin()) {
                        // admin and owner access
                        $response['galleries'] = $this->Gallery_model->get_user_galleries($nick, true);
                    } else {
                        $response['galleries'] = $this->Gallery_model->get_user_galleries($nick);
                    }
                } else {
                    $response['galleries'] = $this->Gallery_model->get_user_galleries($nick);
                }
                $this->load->view('static/header', Array('title' => 'User ' . ucfirst($nick)));
                $this->load->view('users/view/one', $response);
                $this->load->view('static/footer');
            } else {
                $this->load->view('static/header', Array('title' => 'User not found'));
                $this->load->view('users/view/one_404');
                $this->load->view('static/footer');
            }
        } else {
            $this->index();
        }
    }

    public function login() {
        if (!$this->session->userdata('user_logged_in') === FALSE) {
            $this->load->helper('url');
            redirect(base_url('users/view/' . $this->session->userdata('nickname')));
        } else {
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters(
                    '<div class="input-error-message left">', '</div>'
            );
            $this->form_validation->set_rules('nickname', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('static/header', Array('title' => 'Log in'));
                $this->load->view('users/login/form');
            } else {
                if ($this->User_model->check_password($_POST)) {
                    $this->User_model->set_logged_in($_POST);
                    $this->load->helper('url');
                    redirect(base_url('users/view/' . $this->session->userdata('nickname')));
                } else {
                    $this->load->view('static/header', Array('title' => 'Log in'));
                    $this->load->view('users/login/bad_data');
                }
            }
            $this->load->view('static/footer');
        }
    }

    public function register() {
        echo 'register';
    }

    public function logout() {
        if ($this->session->userdata('user_logged_in')) {
//            $this->session->set_userdata(Array('user_logged_in' => '', 'nickname' => ''));
            $this->User_model->set_logged_out();
            $this->load->view('static/header', Array('title' => 'Log out'));
            $this->load->view('users/logout/success');
        } else {
            $this->load->view('static/header', Array('title' => 'Dude..'));
            $this->load->view('users/no_rights');
        }
        $this->load->view('static/footer');
    }

    private function view_as_admin() {
        if (strtolower($this->session->userdata('member_class_preview')) === 'admin') {
            return TRUE;
        }
        return FALSE;
    }

}

?>

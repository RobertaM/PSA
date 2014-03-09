<?php

class Galleries extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Gallery_model');
    }

    public function index() {
        $this->from();
    }

    public function view($id = FALSE) {
        if (!$id === FALSE) {
            $response['gallery'] = $this->Gallery_model->view_one($id);
            if (!$response['gallery']['info'] == FALSE) {
                $title_ok = Array('title' => $response['gallery']['info'][0]['gal_name']);
                $this->load->view('static/header', $title_ok);
                $this->load->view('galleries/view/view_one', $response);
            } else {
                $title_404 = Array('title' => 'Not found');
                $this->load->view('static/header', $title_404);
                $this->load->view('galleries/view/view_one_404');
            }
            $this->load->view('static/footer');
        } else {
            $this->index();
        }
    }

    public function from($offset = 0, $ajax = FALSE) {
        $response['galleries'] = $this->Gallery_model->get_galleries_from($offset);
        $response['offset'] = $offset;
        if (!$response['galleries'] == FALSE) {
            if ($ajax === 'ajax') {
                $this->load->view('galleries/preview_many', $response);
                return;
            } else {
                $title_ok = Array('title' => 'Latest galleries');
                $this->load->view('static/header', $title_ok);
                $this->load->view('galleries/preview_many', $response);
            }
        } else {
            if ($ajax === 'ajax') {
                $this->load->view('galleries/preview_many_ajax_404');
                return;
            } else {
                $title_404 = Array('title' => 'Not found');
                $this->load->view('static/header', $title_404);
                $this->load->view('galleries/preview_many_404');
            }
        }
        $this->load->view('static/footer');
    }

    public function create() {
        if ($this->session->userdata('user_logged_in')) {
            $this->load->helper(Array('form', 'url'));
            $this->load->library('form_validation');

            $this->form_validation->set_rules('gall-title', 'Gallery title', 'required');

            $this->form_validation->set_error_delimiters(
                    '<div class="input-error-message left">', '</div>'
            );

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('static/header', Array('title' => 'Create a new gallery'));
                $this->load->view('galleries/create/main_form');
            } else {
                $pub = 0;
                if (isset($_POST['publish']) && $_POST['publish'] === 'true') {
                    $pub = 1;
                };
            $this->Gallery_model->add_gallery(Array('name' => $_POST['gall-title'], 'gal_desc' => $_POST['text']), $pub);
            $this->load->view('static/header', Array('title' => 'Create a new gallery'));
            $this->load->view('galleries/create/main_form');
            }
        } else {
            $this->load->view('static/header', Array('title' => 'Dude..'));
            $this->load->view('users/no_rights');
        }
        $this->load->view('static/footer');
    }

    public function edit($gal_id = FALSE) {
        if (!$gal_id === FALSE) {
            $this->load->model('User_model');
            $user = $this->User_model;
            if ($user->is_logged_in() && $user->is_gallery_owner($gal_id)) {
                $this->load->model('Gallery_model');
                $gal = $this->Gallery_model;
                $this->load->helper('form');

                $this->load->view('static/header', Array('title' => 'Edit'));
                $response['data'] = $gal->get_one($gal_id);
                $this->load->view('galleries/edit/main_form', $response);

//                $this->load->library('form_validation');
//                
//                if($this->form_validation->run() == FALSE){
//                    
//                }

                $this->load->view('static/footer');
                return;
            }
        }
        $status = "You have no access to this page.";
        $this->load->view('static/header', Array('title' => $status));
        $this->load->view('galleries/publish/status', Array('status' => $status));
        $this->load->view('static/footer');
    }

    public function publish($gal_id = FALSE, $unpublish = FALSE) {
        if (!$gal_id === FALSE) {
            if ($this->session->userdata('user_logged_in')) {
                $this->db->select('user_id, is_published');
                $this->db->where('gal_id', $gal_id);
                $this->db->limit(1);
                $this->db->from('galleries');
                $response = $this->db->get()->result_array();
                if (!$response === FALSE) {
                    if ($this->session->userdata('user_id') === $response[0]['user_id'] || strtolower($this->session->userdata('member_class_preview')) === 'admin') {
                        if ($response[0]['is_published']) {
                            if ($unpublish === TRUE) {
                                $this->Gallery_model->unpublish_gallery($gal_id);
                                $status = "Success";
                            } else {
                                $status = "This gallery is already published";
                            }
                        } else {
                            if ($this->session->userdata('user_id') === $response[0]['user_id']) {
                                if ($unpublish === TRUE) {
                                    $status = "This gallery is already unpublished";
                                } else {
                                    $this->Gallery_model->publish_gallery($gal_id);
                                    $status = "Success";
                                }
                            } else {
                                $status = "Only owner action";
                            }
                        }
                        $this->load->view('static/header', Array('title' => $status));
                        $this->load->view('galleries/publish/status', Array('status' => $status));
                        $this->load->view('static/footer');
                        return;
                    }
                }
            }
        }
        show_404();
    }

    public function unpublish($gal_id = FALSE) {
        $this->publish($gal_id, TRUE);
    }

}

?>

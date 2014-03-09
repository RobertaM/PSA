<?php /*

class Galleries extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Gallery_model');
    }

    public function index() {
        $this->preview();
    }

    public function view($id = FALSE) {
        $this->load->view('static/header');
        if (!$id === FALSE) {
            $response['galleries'] = $this->Gallery_model->view_one($id);
            if (!$response['galleries'] == FALSE) {
                $this->load->view('galleries/view_one', $response);
            } else {
                $this->load->view('galleries/view_one_404');
            }
        } else {
            $this->load->view('galleries/view_one_404');
        }
        $this->load->view('static/footer');
    }

    public function old_preview($offset = 0) {
        $this->load->view('static/header');
        $response['galleries'] = $this->Gallery_model->get_galleries_from($offset);

        if (!$response['galleries'] == FALSE) {
            $this->load->view('galleries/preview_many', $response);
        } else {
            $this->load->view('galleries/preview_many_404');
        }
        $this->load->view('static/footer');
    }

    public function preview($offset = 0) {
        $this->load->view('static/header');

        $this->load->view('static/footer');
    }

}

?>

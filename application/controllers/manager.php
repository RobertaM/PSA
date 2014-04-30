<?php

class Manager extends CI_Controller {

    public function index() {
        if (!$this->User_model->is_manager()) {
            show_404();
        }
        redirect(base_url("manager/panel"));
    }

    public function panel() {
        if (!$this->User_model->is_manager()) {
            show_404();
        }

        $title = "Manager's panel";

        $this->load->view("static/header", array(
            "title" => $title
        ));
        $this->load->view("manager/manager_panel");
        $this->load->view("static/footer");
    }

}

<?php

class app extends CI_Controller {

    public function process() {
        $response["data"] = $this->process_data(
                $this->decode('php://input')
        );
        if ($response == NULL) {
            $response["successful"] = FALSE;
            unset($response["data"]);
        } else {
            $response["successful"] = TRUE;
        }
        echo $this->encode($response);
    }

    function process_data($data = NULL) {
        if (!isset($data) || !isset($data["action"])) {
            return null;
        }
        switch ($data["action"]) {
            case "get_products":
                if (!isset($data["shop_id"])) {
                    return null;
                }
                return $this->get_products($data["shop_id"]);
            case "get_restaurants":
                return $this->get_resaturants();
        }
        return null;
    }

    private function decode($json) {
        return json_decode(
                urldecode(
                        file_get_contents(
                                $json
                )), true
        );
    }

    private function encode($json) {
        return json_encode(
                $json
        );
    }

    private function get_products($shopId = NULL) {
        $this->load->model("Product_model");
        return $this->Product_model->get_product_descriptions($shopId);
    }

    private function get_resaturants() {
        $this->load->model("Restaurant_model");
        return $this->Restaurant_model->get_restaurant();
    }

}

//{"username":"nitmar","password":"a"}

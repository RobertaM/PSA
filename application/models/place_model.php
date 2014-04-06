<?php

/**
 * Place information retrieval and storage model.
 * @author Martynas Maciulevičius
 *
 */
class Place_model extends CI_Model {

    /**
     * @return place list.
     */
    public function get_places() {

        // Select all data
        $this->db->select();
        $this->db->from("PLACES");
        $response = $this->db->get()->result_array();

        return $response;
    }

    /**
     * Save selected places for temporary storage
     */
    public function temporarily_save_selected_place($place_data = array()) {

        if (!isset($place_data["name"])) {
            $place_data["name"] = "Not set";
        }
        if (!isset($place_data["id"])) {
            $place_data["id"] = null;
        }

        // Save data to session
        $this->session->set_userdata("place", Array(
            "id" => $place_data["id"],
            "name" => $place_data["name"]
        ));
    }

    /**
     * Gets user selected places from session cookie
     */
    public function get_selected_place() {

        return $this->session->userdata("place");
    }

}

?>

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
    public function temporarily_save_selected_place($place_id) {

        // Save data to session
        $this->session->set_userdata(Array(
            "selected_place" => $place_id
        ));
    }

    /**
     * Gets user selected places from session cookie
     */
    public function get_selected_place() {

        return $this->session->userdata("selected_place")[0];
    }

}

?>

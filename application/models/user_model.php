<?php

/**
 * User information retrieval and storage model.
 * One may use this model to view user's eligibility, set and retrieve his data.
 * @author Martynas Maciulevičius
 *
 */
class User_model extends CI_Model {

    /**
     * Executes a query and checks if user password is correct.
     * @param Array $data must contain username and password.
     * @return Array of boolean 'status' and user data from database.
     */
    public function __construct() {
        $this->load->database();
    }

    public function set_user($role) {
        $user = array(
            'name' => $this->input->post('name'),
            'surname' => $this->input->post('surname'),
            'username' => $this->input->post('username'),
            'role' => $role,
            'password' => $this->input->post('password'),
            'phone_number' => $this->input->post('phone_number')
        );
        return $this->db->insert('USER', $user);
    }

    public function check_password($data = FALSE) {

        if (isset($data)) {

// Select all user data
            $this->db->select();
            $this->db->from('USER');
            $this->db->limit(1);
            $this->db->where('username', $data['username']);
            $response = $this->db->get()->result_array();

// Check password
            if (!$response === FALSE &&
                    $data['password'] === $response[0]['password']) {

// Remove password field before returning
                unset($response[0]['password']);

// Return all remaining data, success
                return Array('status' => TRUE, 'userdata' => $response[0]);
            }
// User password is wrong
            return Array('status' => FALSE);
        }
    }

    /**
     * Set user logged in status to TRUE and all other data from given array.
     * @param unknown_type $data.
     */
    public function set_logged_in($data) {

// Save seperate preview role
        $data['role_for_preview'] = $data['role'];

// Save data to session
        $this->session->set_userdata(Array(
            'user_logged_in_status' => TRUE,
            'user_data' => $data
        ));
    }

    /**
     * Remove user's credentials from session and reset login status to FALSE.
     */
    public function set_logged_out() {
        $this->session->set_userdata(Array('user_logged_in_status' => FALSE));
        $this->session->unset_userdata(Array('user_data'));

// TODO TEMP:
        $this->session->sess_destroy();
    }

    /**
     * @return boolean User's login status.
     */
    public function is_logged_in() {
        if ($this->session->userdata('user_logged_in_status') === TRUE) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * @return boolean TRUE if user is a manager.
     */
    public function is_manager() {
        return $this->get_user_status() === "manager";
    }

    /**
     * @return boolean TRUE if user is a worker.
     */
    public function is_worker() {
        return $this->get_user_status() === "worker";
    }

    /**
     * @return boolean TRUE if user is a user.
     */
    public function is_user() {
        return $this->get_user_status() === "user";
    }

    /**
     * @return type Logged in user id or null if not logged in
     */
    public function get_id() {
        if ($this->is_logged_in()) {
            return $this->get_user_data()["user_id"];
        } else {
            return null;
        }
    }

    public function get_users() {
        $this->db->select();
        $this->db->from("USER");
        $users = $this->db->get()->result_array();

        return $users;
    }

    public function update_user($id) {
        $user = array(
            'name' => $this->input->post('name'),
            'surname' => $this->input->post('surname'),
            'phone_number' => $this->input->post('phone_number'),
            'password' => $this->input->post('password'),
            'username' => $this->input->post('username')
        );

        $this->db->where('user_id', $id);
        $this->db->update('USER', $user);
    }

    public function get_one_user($id) {

        $this->db->select('user_id, name, surname, phone_number, password, username');
        $this->db->from("USER");
        $this->db->where('user_id', $id);

        $user = $this->db->get()->result_array();
        return $user;
    }

    public function delete_user($id) {
        $this->db->where('user_id', $id);
        $this->db->delete('USER');
    }

    /**
     * Gets user's status
     */
    public function get_user_status() {
        if ($this->session->userdata('user_logged_in_status') === TRUE) {
            return $this->get_user_data()['role'];
        }

        return null;
    }

    public function get_user_data() {
        return $this->session->userdata('user_data');
    }

    /**
     * Saves restaurant to session
     */
    public function set_worker_restaurant($restaurant_data) {
        $this->session->set_userdata(Array(
            'assigned_restaurant_data' => $restaurant_data
        ));
    }

    /** @return String containing user name */
    public function get_username() {
        if ($this->is_logged_in()) {
            return $this->session->userdata('user_data')['username'];
        } else {
            return NULL;
        }
    }

    /** Returns all user classes */
    public function get_user_classes() {
        return array(
            array(
                "display_name" => "User",
                "system_name" => "user"
            ),
            array(
                "display_name" => "Worker",
                "system_name" => "worker"
            ),
            array(
                "display_name" => "Manager",
                "system_name" => "manager"
            )
        );
    }

    /** Returns all users. */
    public function get_all_users($role_filter = null) {
        $this->db->select("*")->from("USER");

        if (isset($role_filter)) {
            $this->db->where("role = ", $role_filter);
        }

        return $this->db->get()->result_array();
    }

    /** Save user class to database. Update. */
    public function set_user_class($user_id = null, $class = null) {
        if (!isset($user_id) || !isset($class)) {
            return;
        }

        // Yes, this query is not safe.
        $this->db->where("user_id =" . $user_id)
                ->update("USER", array(
                    "role" => $class
        ));
    }

    /** Save worker's place to database. Update. */
    public function set_user_place($worker_id = null, $place_id = null) {
        if (!isset($worker_id) || !isset($place_id)) {
            return;
        }

        // Yes, this query is not safe 2.
        $this->db->where("user_id =" . $worker_id)
                ->where("role = \"worker\"")
                ->update("USER", array(
                    "place_id" => $place_id
        ));
    }

}

?>

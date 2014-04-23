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

    public function __construct(){
        $this->load->database();
    }

    public function set_user($role){
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
        if ($this->session->userdata('user_logged_in_status') === TRUE){
            return TRUE;
        }
        return FALSE;
    }

    /**
     * @return boolean TRUE if user is a manager.
     */
    public function is_manager(){

        $user_data = $this->session->userdata('user_data');

        if ($this->session->userdata('user_logged_in_status') === TRUE &&
            $user_data['role'] === "manager"){
            return TRUE;
        }
        return FALSE;
    }

    public function get_users(){
        $this->db->select();
        $this->db->from("USER");
        $users = $this->db->get()->result_array();

        return $users;
    }

    public function update_user($id){
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

    public function get_one_user($id){

        $this->db->select('user_id, name, surname, phone_number, password, username');
        $this->db->from("USER");
        $this->db->where('user_id', $id);

        $user = $this->db->get()->result_array();
        return $user;
    }

    public function delete_user($id){        
        $this->db->where('user_id', $id);
        $this->db->delete('USER');
    }


}

?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function register_user($user_data)
    {
        // Hash the password
        $user_data['password'] = password_hash($user_data['password'], PASSWORD_DEFAULT);

        // Insert user data into the database
        return $this->db->insert('user', $user_data);
    }

    public function authenticate_user($username, $password)
    {
        // Retrieve the user by username
        $this->db->where('username', $username);
        $query = $this->db->get('user');

        if ($query->num_rows() > 0) {
            $user = $query->row();

            // Verify the password
            if (password_verify($password, $user->password)) {
                // Password is correct
                return $user;
            }
        }

        // User not found or password did not match
        return false;
    }
}

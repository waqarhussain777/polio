<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $public_methods = array('login', 'register');
        if ($this->session->userdata('logged_in') && in_array($this->router->fetch_method(), $public_methods) ) {
            redirect('');
        }
    }

    public function login()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('user/login');
        } else {
            // Form submitted and passed validation
            $this->load->model('user_model');
            $user = $this->user_model->authenticate_user($this->input->post('username'), $this->input->post('password'));
            if ($user) {
                // Set user data in session
                $this->session->set_userdata('logged_in', true);
                $this->session->set_userdata('username', $user->username);
                $this->session->set_userdata('userID', $user->userID);
                $this->session->set_userdata('role', $user->role);
                ($user->role=="admin")?redirect('regions'):redirect('vaccination_record');
                
            } else {
                // Set an error message and reload the login view
                $this->session->set_flashdata('error', 'Invalid username or password.');
                redirect('user/login');
            }
        }
    }



    public function register()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        // Set validation rules
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('user/register');
        } else {
            $this->load->model('user_model');
            $result = $this->user_model->register_user($this->input->post());
            if ($result) {
                // Redirect to login page or show success message
                redirect('user/login');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role');
        $this->session->set_flashdata('user_logged_out', 'You have been logged out.');
        // Redirect to login page
        redirect('user/login');
    }


}

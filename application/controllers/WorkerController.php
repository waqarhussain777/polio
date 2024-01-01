<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WorkerController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('user/login');
        }
        $this->load->model('Worker_model');
        $this->load->model('Main_model');
    }

    public function add_vaccine()
    {
        $data['provinces'] = $this->Main_model->get_all_provinces();
        $this->load->view('polio_worker/add_vaccination_record', $data);
    }

    public function add_vaccination_record() {
        $this->form_validation->set_rules('householdmember', 'Household Member', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            // Form not submitted or validations failed
            $this->add_vaccine();
        } else {
            $householdMemberId = $this->input->post("householdmember");
            $userID = $this->session->userdata('userID');
    
            // Check if the worker has already added a record for this household member
            if ($this->Worker_model->is_vaccination_record_exists($householdMemberId, $userID)) {
                $this->session->set_flashdata('error', 'You have already added a vaccination record for this household member.');
                redirect('add_vaccination_record');
            } else {
                $date = date('Y-m-d');
                $result = $this->Worker_model->add_vaccination_record($householdMemberId, $date, $userID);
                if ($result) {
                    // Set a success message and redirect to the page
                    $this->session->set_flashdata('success', 'Vaccination record added successfully.');
                    redirect('add_vaccination_record');
                } else {
                    // Set an error message and reload the page
                    $this->session->set_flashdata('error', 'Error adding vaccination record.');
                    redirect('add_vaccination_record');
                }
            }
        }
    }

    public function vaccination_record() {
        $this->load->model('Worker_model');
    
        $userID = $this->session->userdata('userID');
        $data['records'] = $this->Worker_model->get_vaccination_records_by_user($userID);
    
        $this->load->view('admin/vaccination_records', $data);
    }
    
}
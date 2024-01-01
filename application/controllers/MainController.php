<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('user/login');
        }
        if($this->session->userdata('role')!="admin"){
            redirect('vaccination_record');
        }
        $this->load->model('Main_model');
    }

    public function regions()
    {
        $data['data'] = $this->Main_model->get_records();
        $this->load->view('admin/main_view', $data);
    }

    public function assign() 
    {
        $data['polio_workers'] = $this->Main_model->get_all_workers();
        $data['provinces'] = $this->Main_model->get_all_provinces();
        $this->load->view('admin/assign_polio_worker', $data);
    }

    public function assign_worker() {
        $this->form_validation->set_rules('polioWorker', 'Polio Worker', 'required');
        $this->form_validation->set_rules('unioncouncil', 'Union Council', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            redirect('assign');
        } else {
            $polioWorker = $this->input->post('polioWorker');
            $unionCouncil = $this->input->post('unioncouncil');
    
            // Check if this union council is already assigned to the polio worker
            if ($this->Main_model->is_union_council_already_assigned($polioWorker, $unionCouncil)) {
                // Set an error message and reload the assign worker page
                $this->session->set_flashdata('error', 'This Union Council is already assigned to the selected polio worker.');
                redirect('assign');
            } else {
                // Proceed with assignment
                $result = $this->Main_model->assign_worker($polioWorker, $unionCouncil);
                if ($result) {
                    // Set a success message and redirect to assign worker page
                    $this->session->set_flashdata('success', 'Polio worker assigned successfully.');
                    redirect('assign');
                } else {
                    // Set an error message and reload the assign worker page
                    $this->session->set_flashdata('error', 'Error assigning polio worker.');
                    redirect('assign');
                }
            }
        }
    }

    public function view_workers()
    {
        $data['workers'] = $this->Main_model->get_polio_workers();
        $this->load->view('admin/polio_workers', $data);
    }

    public function view_vaccination_records() {
        $data['records'] = $this->Main_model->get_all_vaccination_records();
        $this->load->view('admin/vaccination_records', $data);
    }
    
}
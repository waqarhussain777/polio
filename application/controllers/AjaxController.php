<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AjaxController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('user/login');
        }
        $this->load->model('Main_model');
        $this->load->model('Worker_model');
    }

    public function getDivisions()
    {
        $result['divisions'] = $this->Main_model->getDivisions($this->input->get('province_id'));
        echo json_encode($result);
    }

    public function getDistricts() {
        $result['districts'] = $this->Main_model->get_districts_by_division($this->input->get('division_id'));
        echo json_encode($result);
    }

    public function getTehsils() {
        $result['tehsils'] = $this->Main_model->get_tehsils_by_district($this->input->get('district_id'));
        echo json_encode($result);
    }

    public function getUnionCouncils() {
        $result['unionCouncils'] = $this->Main_model->get_union_councils_by_tehsil($this->input->get('tehsil_id'));
        echo json_encode($result);
    }

    public function getHouseholds() {
        $this->load->helper('polio_helper');
        $unionCouncilId = $this->input->get('union_council_id');
        $currentWorkerId = $this->session->userdata('userID');
        $households = $this->Worker_model->get_households_by_union_council($this->input->get('union_council_id'));
        // Add a check for each household
        foreach ($households as $household) {
        // Check if the household has already been serviced by another worker
            $household->alreadyServed = is_household_selected($household->individualhouseholdID, $currentWorkerId);
        }
        echo json_encode(['households' => $households]);
    }

    public function getHouseholdMembers() {
        $result['householdMembers'] = $this->Worker_model->get_household_members_by_household($this->input->get('household_id'));
        echo json_encode($result);
    }
}
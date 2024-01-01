<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UnitController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('user/login');
        }
        if($this->session->userdata('role')!="admin"){
            redirect('vaccination_record');
        }
        $this->load->model('Main_model');
        $this->load->model('Unit_model');
    }
// division crud
    public function add_division($divisionID=NULL)
    {
        if ($divisionID) {
            $data['division'] = $this->Unit_model->get_record_by_id('division','divisionID',$divisionID);
            $data['is_edit'] = TRUE;
        } else {
            $data['division'] = NULL;
            $data['is_edit'] = FALSE;
        }
        $data['provinces'] = $this->Main_model->get_all_provinces();
        $this->load->view('unit/division', $data);
    }

    public function add_division_record() {
        $this->form_validation->set_rules('province', 'Province', 'required');
        $this->form_validation->set_rules('divisionName', 'Division Name', 'required');
    
        $divisionID = $this->input->post('divisionID');
    
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect($divisionID ? 'add_division/' . $divisionID : 'add_division');
        } else {
            $provinceID = $this->input->post('province');
            $divisionName = $this->input->post('divisionName');
            $data = array(
                'fkprovinceID' => $provinceID,
                'divisionName' => $divisionName
            );

            if ($divisionID) {
                // Update operation
                if ($this->Unit_model->update_record("division", "divisionID", $divisionID, $data)) {
                    $this->session->set_flashdata('success', 'Division updated successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Failed to update division.');
                }
            } else {
                // Add operation
                if ($this->Unit_model->add_record('division', $data)) {
                    $this->session->set_flashdata('success', 'Division added successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Failed to add division.');
                }
            }
    
            redirect('division_listing');
        }
    }

    public function delete_division($divisionID) {
        if ($this->Unit_model->delete_record('division','divisionID',$divisionID)) {
            $this->session->set_flashdata('success', 'Division deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete division.');
        }

        redirect('division_listing');
    }

    public function division_listing(){
        $data['divisions'] = $this->Main_model->get_all_divisions_with_provinces();

        $this->load->view('unit/division_listing', $data);
    }

    // district crud
    public function add_district($districtID = NULL) {
        if ($districtID) {
            $data['district'] = $this->Unit_model->get_record_by_id('district','districtID',$districtID);
            $data['is_edit'] = TRUE;
        } else {
            $data['district'] = NULL;
            $data['is_edit'] = FALSE;
        }
        $data['divisions'] = $this->Main_model->get_all_divisions();
        $this->load->view('unit/district', $data);
    }

    public function add_district_record() {
        $this->form_validation->set_rules('division', 'Division', 'required');
        $this->form_validation->set_rules('districtName', 'District Name', 'required');
    
        $districtID = $this->input->post('districtID');
    
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect($districtID ? 'add_district/' . $districtID : 'add_district');
        } else {
            $divisionID = $this->input->post('division');
            $districtName = $this->input->post('districtName');
            $data = array(
                'fkdivisionID' => $divisionID,
                'districtName' => $districtName
            );
    
            if ($districtID) {
                if ($this->Unit_model->update_record("district", "districtID", $districtID, $data)) {
                    $this->session->set_flashdata('success', 'District updated successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Failed to update district.');
                }
            } else {
                if ($this->Unit_model->add_record('district', $data)) {
                    $this->session->set_flashdata('success', 'District added successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Failed to add district.');
                }
            }
    
            redirect('district_listing');
        }
    }

    public function delete_district($districtID) {
        if ($this->Unit_model->delete_record('district','districtID',$districtID)) {
            $this->session->set_flashdata('success', 'District deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete district.');
        }
    
        redirect('district_listing');
    }

    public function district_listing() {
        $data['districts'] = $this->Main_model->get_all_districts_with_divisions();
    
        $this->load->view('unit/district_listing', $data);
    }
    
    // tehsil crud
    public function add_tehsil($tehsilID = NULL) {
        if ($tehsilID) {
            $data['tehsil'] = $this->Unit_model->get_record_by_id('tehsil', 'tehsilID', $tehsilID);
            $data['is_edit'] = TRUE;
        } else {
            $data['tehsil'] = NULL;
            $data['is_edit'] = FALSE;
        }
        $data['districts'] = $this->Main_model->get_all_districts();
        $this->load->view('unit/tehsil', $data);
    }

    public function add_tehsil_record() {
        $this->form_validation->set_rules('district', 'District', 'required');
        $this->form_validation->set_rules('tehsilName', 'Tehsil Name', 'required');
    
        $tehsilID = $this->input->post('tehsilID');
    
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect($tehsilID ? 'add_tehsil/' . $tehsilID : 'add_tehsil');
        } else {
            $districtID = $this->input->post('district');
            $tehsilName = $this->input->post('tehsilName');
            $data = array(
                'fkdistrictID' => $districtID,
                'tehsilName' => $tehsilName
            );
    
            if ($tehsilID) {
                if ($this->Unit_model->update_record("tehsil", "tehsilID", $tehsilID, $data)) {
                    $this->session->set_flashdata('success', 'Tehsil updated successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Failed to update tehsil.');
                }
            } else {
                if ($this->Unit_model->add_record('tehsil', $data)) {
                    $this->session->set_flashdata('success', 'Tehsil added successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Failed to add tehsil.');
                }
            }
    
            redirect('tehsil_listing');
        }
    }

    public function delete_tehsil($tehsilID) {
        if ($this->Unit_model->delete_record('tehsil', 'tehsilID', $tehsilID)) {
            $this->session->set_flashdata('success', 'Tehsil deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete tehsil.');
        }
    
        redirect('tehsil_listing');
    }

    public function tehsil_listing() {
        $data['tehsils'] = $this->Main_model->get_all_tehsils_with_districts();
    
        $this->load->view('unit/tehsil_listing', $data);
    }

    // unioncouncil crud
    public function add_unioncouncil($unioncouncilID = NULL) {
        if ($unioncouncilID) {
            $data['unioncouncil'] = $this->Unit_model->get_record_by_id('unioncouncil', 'unioncouncilID', $unioncouncilID);
            $data['is_edit'] = TRUE;
        } else {
            $data['unioncouncil'] = NULL;
            $data['is_edit'] = FALSE;
        }
        $data['tehsils'] = $this->Main_model->get_all_tehsils();
        $this->load->view('unit/unioncouncil', $data);
    }
    
    public function add_unioncouncil_record() {
        $this->form_validation->set_rules('tehsil', 'Tehsil', 'required');
        $this->form_validation->set_rules('unioncouncilName', 'Union Council Name', 'required');
    
        $unioncouncilID = $this->input->post('unioncouncilID');
    
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect($unioncouncilID ? 'add_unioncouncil/' . $unioncouncilID : 'add_unioncouncil');
        } else {
            $tehsilID = $this->input->post('tehsil');
            $unioncouncilName = $this->input->post('unioncouncilName');
            $data = array(
                'fktehsilID' => $tehsilID,
                'unioncouncilName' => $unioncouncilName
            );
    
            if ($unioncouncilID) {
                if ($this->Unit_model->update_record("unioncouncil", "unioncouncilID", $unioncouncilID, $data)) {
                    $this->session->set_flashdata('success', 'Union Council updated successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Failed to update Union Council.');
                }
            } else {
                if ($this->Unit_model->add_record('unioncouncil', $data)) {
                    $this->session->set_flashdata('success', 'Union Council added successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Failed to add Union Council.');
                }
            }
    
            redirect('unioncouncil_listing');
        }
    }

    public function delete_unioncouncil($unioncouncilID) {
        if ($this->Unit_model->delete_record('unioncouncil', 'unioncouncilID', $unioncouncilID)) {
            $this->session->set_flashdata('success', 'Union Council deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete Union Council.');
        }
    
        redirect('unioncouncil_listing');
    }
    
    public function unioncouncil_listing() {
        $data['unioncouncils'] = $this->Main_model->get_all_unioncouncils_with_tehsils();
    
        $this->load->view('unit/unioncouncil_listing', $data);
    }
    
    // household crud
    public function add_household($householdID = NULL) {
        if ($householdID) {
            $data['household'] = $this->Unit_model->get_record_by_id('individualhousehold', 'individualhouseholdID', $householdID);
            $data['is_edit'] = TRUE;
        } else {
            $data['household'] = NULL;
            $data['is_edit'] = FALSE;
        }
        $data['unioncouncils'] = $this->Main_model->get_all_unioncouncils();
        $this->load->view('unit/household', $data);
    }

    public function add_household_record() {
        $this->form_validation->set_rules('unioncouncil', 'Union Council', 'required');
        $this->form_validation->set_rules('householdName', 'Household Name', 'required');
    
        $householdID = $this->input->post('householdID');
    
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect($householdID ? 'add_household/' . $householdID : 'add_household');
        } else {
            $unioncouncilID = $this->input->post('unioncouncil');
            $householdName = $this->input->post('householdName');
            $data = array(
                'fkunioncouncilID' => $unioncouncilID,
                'individualhouseholdName' => $householdName
            );
    
            if ($householdID) {
                if ($this->Unit_model->update_record("individualhousehold", "individualhouseholdID", $householdID, $data)) {
                    $this->session->set_flashdata('success', 'Household updated successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Failed to update household.');
                }
            } else {
                if ($this->Unit_model->add_record('individualhousehold', $data)) {
                    $this->session->set_flashdata('success', 'Household added successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Failed to add household.');
                }
            }
    
            redirect('household_listing');
        }
    }

    public function delete_household($householdID) {
        if ($this->Unit_model->delete_record('individualhousehold', 'individualhouseholdID', $householdID)) {
            $this->session->set_flashdata('success', 'Household deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete household.');
        }
    
        redirect('household_listing');
    }
    
    public function household_listing() {
        $data['households'] = $this->Main_model->get_all_households_with_unioncouncils();
    
        $this->load->view('unit/household_listing', $data);
    }
    
    // householdmember crud
    public function add_householdmember($householdmemberID = NULL) {
        if ($householdmemberID) {
            $data['householdmember'] = $this->Unit_model->get_record_by_id('householdmember', 'householdmemberID', $householdmemberID);
            $data['is_edit'] = TRUE;
        } else {
            $data['householdmember'] = NULL;
            $data['is_edit'] = FALSE;
        }
        $data['households'] = $this->Main_model->get_all_households();
        $this->load->view('unit/householdmember', $data);
    }

    public function add_householdmember_record() {
        $this->form_validation->set_rules('household', 'Household', 'required');
        $this->form_validation->set_rules('memberName', 'Member Name', 'required');
        
        $householdmemberID = $this->input->post('householdmemberID');
        
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect($householdmemberID ? 'add_householdmember/' . $householdmemberID : 'add_householdmember');
        } else {
            $householdID = $this->input->post('household');
            $memberName = $this->input->post('memberName');
            $data = array(
                'fkindividualhouseholdID' => $householdID,
                'householdmemberName' => $memberName
            );
        
            if ($householdmemberID) {
                if ($this->Unit_model->update_record("householdmember", "householdmemberID", $householdmemberID, $data)) {
                    $this->session->set_flashdata('success', 'Household member updated successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Failed to update household member.');
                }
            } else {
                if ($this->Unit_model->add_record('householdmember', $data)) {
                    $this->session->set_flashdata('success', 'Household member added successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Failed to add household member.');
                }
            }
    
            redirect('householdmember_listing');
        }
    }

    public function delete_householdmember($householdmemberID) {
        if ($this->Unit_model->delete_record('householdmember', 'householdmemberID', $householdmemberID)) {
            $this->session->set_flashdata('success', 'Household member deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete household member.');
        }
    
        redirect('householdmember_listing');
    }

    public function householdmember_listing() {
        $data['householdmembers'] = $this->Main_model->get_all_householdmembers_with_households();
    
        $this->load->view('unit/household_member_listing', $data);
    }
    
}
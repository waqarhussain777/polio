<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_records() {
        $this->db->select('province.provinceName AS province, division.divisionName AS division, district.districtName AS district, tehsil.tehsilName AS tehsil');
        $this->db->from('province');
        $this->db->join('division', 'division.fkprovinceID = province.provinceID');
        $this->db->join('district', 'district.fkdivisionID = division.divisionID');
        $this->db->join('tehsil', 'tehsil.fkdistrictID = district.districtID');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all_workers() {
        $this->db->select('userID, userName');
        $this->db->from('user');
        $this->db->where('role', 'polioworker');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all_provinces() {
        $this->db->select('provinceID, provinceName');
        $this->db->from('province');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all_divisions() {
        $this->db->select('divisionID, divisionName');
        $this->db->from('division');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_division_by_id($divisionID) {
        $this->db->where('divisionID', $divisionID);
        $query = $this->db->get('division');
        return $query->row();
    }
    
    public function get_all_districts() {
        $this->db->select('districtID, districtName');
        $this->db->from('district');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all_tehsils() {
        $this->db->select('tehsilID, tehsilName');
        $this->db->from('tehsil');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all_unioncouncils() {
        $this->db->select('unioncouncilID, unioncouncilName');
        $this->db->from('unioncouncil');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all_households() {
        $this->db->select('individualhouseholdID, individualhouseholdName');
        $this->db->from('individualhousehold');
        $query = $this->db->get();
        return $query->result();
    }

    public function householdmember() {
        $this->db->select('householdmemberID, householdmemberName');
        $this->db->from('householdmember');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDivisions($provinceID) {
        $this->db->select('divisionID, divisionName');
        $this->db->from('division');
        $this->db->where('fkprovinceID', $provinceID);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_districts_by_division($divisionID) {
        $this->db->select('districtID, districtName');
        $this->db->from('district');
        $this->db->where('fkdivisionID', $divisionID);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_tehsils_by_district($districtID) {
        $this->db->select('tehsilID, tehsilName');
        $this->db->from('tehsil');
        $this->db->where('fkdistrictID', $districtID);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_union_councils_by_tehsil($tehsilID) {
        $userID = $this->session->userdata("userID");
    
        $this->db->select('uc.unioncouncilID, uc.unioncouncilName');
        $this->db->select('(EXISTS(SELECT 1 FROM assignment WHERE fkunioncouncilID = uc.unioncouncilID AND fkuserID = '.$userID.')) as isAssigned');
        $this->db->from('unioncouncil uc');
        $this->db->where('uc.fktehsilID', $tehsilID);
        $query = $this->db->get();
    
        return $query->result();
    }
    

    public function assign_worker($polio_worker_id, $union_council_id) {
        $data = array(
            'fkuserID' => $polio_worker_id,
            'fkunioncouncilID' => $union_council_id
        );
        $this->db->insert('assignment', $data);
        return $this->db->affected_rows() > 0;
    }

    public function check_household_selection($householdId, $currentWorkerId) {
        $this->db->select('1');
        $this->db->from('vaccinationrecord');
        $this->db->join('householdmember', 'vaccinationrecord.fkhouseholdmemberID = householdmember.householdmemberID');
        $this->db->where('householdmember.householdmemberID', $householdId);
        $this->db->where('vaccinationrecord.fkuserID !=', $currentWorkerId);
        $query = $this->db->get();

        return $query->num_rows() > 0;
    }

    public function get_polio_workers()
    {
        $this->db->select('u.userID, u.userName, p.provinceName, dn.divisionName, d.districtName, t.tehsilName, uc.unioncouncilName');
        $this->db->from('user u');
        $this->db->join('assignment a', 'u.userID = a.fkuserID');
        $this->db->join('unioncouncil uc', 'a.fkunioncouncilID = uc.unioncouncilID');
        $this->db->join('tehsil t', 'uc.fktehsilID = t.tehsilID');
        $this->db->join('district d', 't.fkdistrictID = d.districtID');
        $this->db->join('division dn', 'd.fkdivisionID = dn.divisionID');
        $this->db->join('province p', 'dn.fkprovinceID = p.provinceID');
        $query = $this->db->get();

        return $query->result();
    }

    public function is_union_council_already_assigned($polioWorker, $unionCouncil) {
        $this->db->where('fkuserID', $polioWorker);
        $this->db->where('fkunioncouncilID', $unionCouncil);
        $query = $this->db->get('assignment');

        return $query->num_rows() > 0;
    }

    public function get_all_vaccination_records() {
        $this->db->select('vr.*, u.userName, hm.householdmemberName, hh.individualhouseholdName, uc.unioncouncilName, t.tehsilName');
        $this->db->from('vaccinationrecord vr');
        $this->db->join('user u', 'vr.fkuserID = u.userID');
        $this->db->join('householdmember hm', 'vr.fkhouseholdmemberID = hm.householdmemberID');
        $this->db->join('individualhousehold hh', 'hm.fkindividualhouseholdID = hh.individualhouseholdID');
        $this->db->join('unioncouncil uc', 'hh.fkunioncouncilID = uc.unioncouncilID');
        
        $this->db->join('tehsil t', 'uc.fktehsilID = t.tehsilID');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all_divisions_with_provinces() {
        $this->db->select('d.divisionID, d.divisionName, p.provinceName');
        $this->db->from('division d');
        $this->db->join('province p', 'd.fkprovinceID = p.provinceID');
        $query = $this->db->get();

        return $query->result();
    }

    public function get_all_districts_with_divisions() {
        $this->db->select('d.districtID, d.districtName, dv.divisionName');
        $this->db->from('district d');
        $this->db->join('division dv', 'd.fkdivisionID = dv.divisionID');
        $query = $this->db->get();

        return $query->result();
    }

    public function get_all_tehsils_with_districts() {
        $this->db->select('t.tehsilID, t.tehsilName, d.districtName');
        $this->db->from('tehsil t');
        $this->db->join('district d', 't.fkdistrictID = d.districtID');
        $query = $this->db->get();

        return $query->result();
    }

    public function get_all_unioncouncils_with_tehsils() {
        $this->db->select('uc.unioncouncilID, uc.unioncouncilName, t.tehsilName');
        $this->db->from('unioncouncil uc');
        $this->db->join('tehsil t', 'uc.fktehsilID = t.tehsilID');
        $query = $this->db->get();

        return $query->result();
    }

    public function get_all_households_with_unioncouncils() {
        $this->db->select('hh.individualhouseholdID, hh.individualhouseholdName, uc.unioncouncilName');
        $this->db->from('individualhousehold hh');
        $this->db->join('unioncouncil uc', 'hh.fkunioncouncilID = uc.unioncouncilID');
        $query = $this->db->get();

        return $query->result();
    }

    public function get_all_householdmembers_with_households() {
        $this->db->select('hm.householdmemberID, hm.householdmemberName, hh.individualhouseholdName');
        $this->db->from('householdmember hm');
        $this->db->join('individualhousehold hh', 'hm.fkindividualhouseholdID = hh.individualhouseholdID');
        $query = $this->db->get();

        return $query->result();
    }
    
}

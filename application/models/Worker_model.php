<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Worker_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function add_vaccination_record($householdmember_id, $date, $polio_worker_id) {
        $data = array(
            'fkuserID' => $polio_worker_id,
            'fkhouseholdmemberID' => $householdmember_id,
            'vaccinationDate' => $date
        );
        $this->db->insert('vaccinationrecord', $data);
        return $this->db->affected_rows() > 0;
    }

    public function get_households_by_union_council($unioncouncilID) {
        $this->db->select('individualhouseholdID, individualhouseholdName');
        $this->db->from('individualhousehold');
        $this->db->where('fkunioncouncilID', $unioncouncilID);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_household_members_by_household($householdID) {
        $this->db->select('householdmemberID, householdmemberName');
        $this->db->from('householdmember');
        $this->db->where('fkindividualhouseholdID', $householdID);
        $query = $this->db->get();
        return $query->result();
    }

    public function is_vaccination_record_exists($householdMemberId, $polioWorkerId) {
        $this->db->where('fkhouseholdmemberID', $householdMemberId);
        $this->db->where('fkuserID', $polioWorkerId);
        $query = $this->db->get('vaccinationrecord');

        return $query->num_rows() > 0;
    }

    public function get_vaccination_records_by_user($userID) {
        $this->db->select('vr.*, u.userName, hm.householdmemberName, hh.individualhouseholdName, uc.unioncouncilName, t.tehsilName');
        $this->db->from('vaccinationrecord vr');
        $this->db->join('user u', 'vr.fkuserID = u.userID');
        $this->db->join('householdmember hm', 'vr.fkhouseholdmemberID = hm.householdmemberID');
        $this->db->join('individualhousehold hh', 'hm.fkindividualhouseholdID = hh.individualhouseholdID');
        $this->db->join('unioncouncil uc', 'hh.fkunioncouncilID = uc.unioncouncilID');
        $this->db->join('tehsil t', 'uc.fktehsilID = t.tehsilID');
        $this->db->where('fkuserID', $userID);
        $query = $this->db->get();
        return $query->result();
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    // generic add function
    public function add_record($tableName, $data) 
    {
        return $this->db->insert($tableName, $data);
    }

    // generic update function
    public function update_record($tableName, $columnName, $id, $data) {
        $this->db->where($columnName, $id);
        return $this->db->update($tableName, $data);
    }

    // generic delete function
    public function delete_record($tableName, $columnName, $id) {
        $this->db->where($columnName, $id);
        if ($this->db->delete($tableName)) {
            return $this->db->affected_rows() > 0;
        } else {
            return false;
        }
    }

    // generic get record by ID function
    public function get_record_by_id($tableName, $columnName, $id) {
        $this->db->where($columnName, $id);
        $query = $this->db->get($tableName);
        return $query->row();
    }

}
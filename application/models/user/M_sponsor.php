<?php

class M_sponsor extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getPlatinumSponsorData() {
        $this->db->select('*');
        $this->db->from('sponsors');
        $this->db->where('sponsors_type', "platinum");
        $sponsors = $this->db->get();
        if ($sponsors->num_rows() > 0) {
            return $sponsors->result();
        } else {
            return '';
        }
    }

    function getSponsorData() {
        $this->db->select('*');
        $this->db->from('sponsors');
        $this->db->where('sponsors_type IS NULL', null, false);
        $this->db->or_where('sponsors_type',"");
        $sponsors = $this->db->get();
        if ($sponsors->num_rows() > 0) {
            return $sponsors->result();
        } else {
            return '';
        }
    }

    function viewSponsorData($sponsors_id) {
        $this->db->select('*');
        $this->db->from('sponsors');
        $this->db->where("sponsors_id", $sponsors_id);
        $sponsors = $this->db->get();
        if ($sponsors->num_rows() > 0) {
            return $sponsors->row();
        } else {
            return '';
        }
    }

    public function validateLogin($login_data) {
        $result = $this->db->select('*')->get_where('sponsors', $login_data);
        if ($result->num_rows() > 0) {
            return $result->row_array();
        } else {
            return false;
        }
    }

}

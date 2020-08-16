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

    function getPlatinumSponsorDataFilter_search() {
        $post = $this->input->post();
        $this->db->select('*');
        $this->db->from('sponsors');
        $this->db->where('sponsors_type', "platinum");
        if ($post['sponsors_category'] != "") {
            $this->db->where("sponsors_category_id", $post['sponsors_category']);
        }
        if ($post['searchbox'] != "") {
            $this->db->like("company_name", $post['searchbox']);
        }
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
        $this->db->or_where('sponsors_type', "");
        $sponsors = $this->db->get();
        if ($sponsors->num_rows() > 0) {
            return $sponsors->result();
        } else {
            return '';
        }
    }

    function getSponsorDataFilter_search() {
        $post = $this->input->post();
        $this->db->select('*');
        $this->db->from('sponsors');
        $this->db->where('sponsors_type !=', "platinum");
        if ($post['sponsors_category'] != "") {
            $this->db->where("sponsors_category_id", $post['sponsors_category']);
        }
        if ($post['searchbox'] != "") {
            $this->db->like("company_name", $post['searchbox']);
        }
        $sponsors = $this->db->get();
        if ($sponsors->num_rows() > 0) {
            return $sponsors->result();
        } else {
            return '';
        }
    }

    function getSponsorsCategoryData() {
        $this->db->select('*');
        $this->db->from('sponsors_category');
        $sponsors_category = $this->db->get();
        if ($sponsors_category->num_rows() > 0) {
            return $sponsors_category->result();
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
        $query = $this->db->query("
        SELECT s.* 
        FROM sponsors s 
        LEFT JOIN sponsor_extra_admin sea ON s.sponsors_id = sea.sponsor_id
        WHERE ((s.email = '" . $login_data['email'] . "' AND s.password = '" . $login_data['password'] . "') OR
               (sea.email = '" . $login_data['email'] . "' AND sea.password = '" . $login_data['password'] . "'))
        ");
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    function get_booth_tracking($sponsor_id) {
        $this->db->select('*');
        $this->db->from('view_sponsor_history s');
        $this->db->join('customer_master c', 's.cust_id=c.cust_id');
        $this->db->where('s.sponsor_id', $sponsor_id);
        $sessions = $this->db->get();
        if ($sessions->num_rows() > 0) {
            return $sessions->result();
        } else {
            return '';
        }
    }

}

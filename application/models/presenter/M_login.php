<?php

class M_login extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function user_login($username, $password) {
        $this->db->select('*');
        $this->db->from('presenter');
        $this->db->where("(email = '$username' OR username = '$username')");
        $this->db->where("password", $password);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->row_array();
        } else {
            return '';
        }
    }

}

<?php

class M_push_notification extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_poll_vot_section() {
        $this->db->select('*');
        $this->db->from('push_notification_admin');
        $this->db->where(array("status" => 1));
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return '';
        }
    }

}

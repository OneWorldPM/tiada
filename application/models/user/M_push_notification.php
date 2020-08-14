<?php

class M_push_notification extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_push_notification_admin() {
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

    function get_push_notification_sponsor() {
        $post = $this->input->post();
        $this->db->select('*');
        $this->db->from('push_notification_sponsor');
        $this->db->where(array("sponsors_id" => $post['sponsor_id']));
        $this->db->where(array("status" => 1));
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return '';
        }
    }

}

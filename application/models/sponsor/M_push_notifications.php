<?php

class M_push_notifications extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_push_notifications() {
        $this->db->select('*');
        $this->db->from('push_notification_sponsor p');
        $this->db->join('sponsors s','p.sponsors_id=s.sponsors_id');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return '';
        }
    }
    
    function get_sponsor_data() {
        $this->db->select('*');
        $this->db->from('sponsors');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return '';
        }
    }

    function add_push_notifications($post) {
        $data = array(
            'message' => $post['message'],
            'sponsors_id' => $post['sponsors_id'],
            'notification_date' => date("Y-m-d h:i:s")
        );
        $this->db->insert('push_notification_sponsor', $data);
        $pid = $this->db->insert_id();
        if ($pid) {
            return $pid;
        } else {
            return '';
        }
    }

}

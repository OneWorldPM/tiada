<?php

class M_home extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getsessions_data() {
        $this->db->select('*');
        $this->db->from('sessions_my_swag_bag sb');
        $this->db->join('sessions s', 'sb.sessions_id=s.sessions_id');
        $this->db->where('sb.cust_id', $this->session->userdata("cid"));
        $this->db->order_by("s.sessions_date", "asc");
        $this->db->order_by("s.time_slot", "asc");
        $sessions = $this->db->get();
        if ($sessions->num_rows() > 0) {
            $return_array = array();
            foreach ($sessions->result() as $val) {
                $val->presenter = $this->common->get_presenter($val->presenter_id, $val->sessions_id);
                $val->total_sign_up_sessions = $this->common->get_total_sign_up_sessions($val->sessions_id);
                $val->status_sign_up_sessions = $this->common->get_status_sign_up_sessions($val->sessions_id, $this->session->userdata("cid"));
                $val->total_sign_up_sessions_user = $this->common->get_total_sign_up_sessions_user($this->session->userdata("cid"));
                $val->sessions_tracks_data = $this->common->get_sessions_tracks($val->sessions_tracks_id);
                $val->status_my_swag_bag = $this->common->get_my_swag_bag_status($val->sessions_id, $this->session->userdata("cid"));
                $return_array[] = $val;
            }
            return $return_array;
        } else {
            return '';
        }
    }

    

}

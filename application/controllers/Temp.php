<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Temp extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->common->set_timezone();
    }

    public function index() {
//        $this->db->select('*');
//        $this->db->from('sessions');
//        $this->db->where("sessions_id", 2);
//        $sessions = $this->db->get();
//        if ($sessions->num_rows() > 0) {
//            $result_sessions = $sessions->row();
//            $sessions_presenter_data = $this->db->get_where("sessions_add_presenter", array("sessions_id" => $result_sessions->sessions_id));
//            for ($i = 0; $i <= 70; $i++) {
//                $set = array(
//                    'presenter_id' => $result_sessions->presenter_id,
//                    'session_title' => $result_sessions->session_title,
//                    'sessions_description' => $result_sessions->sessions_description,
//                    'sessions_date' => $result_sessions->sessions_date,
//                    'time_slot' => $result_sessions->time_slot,
//                    'end_time' => $result_sessions->end_time,
//                    'embed_html_code' => $result_sessions->embed_html_code,
//                    'embed_html_code_presenter' => $result_sessions->embed_html_code_presenter,
//                    'sessions_type_id' => $result_sessions->sessions_type_id,
//                    'sessions_tracks_id' => $result_sessions->sessions_tracks_id,
//                    'sessions_type_status' => $result_sessions->sessions_type_status,
//                    'sessions_photo' => $result_sessions->sessions_photo,
//                    "reg_date" => $result_sessions->reg_date
//                );
//                $this->db->insert("sessions", $set);
//                $sessions_id = $this->db->insert_id();
//                if ($sessions_presenter_data->num_rows() > 0) {
//                    foreach ($sessions_presenter_data->result() as $value) {
//                        $set_array = array(
//                            'sessions_id' => $sessions_id,
//                            'order_index_no' => $value->order_index_no,
//                            'select_presenter_id' => $value->select_presenter_id,
//                            'presenter_title' => $value->presenter_title,
//                            'presenter_time_slot' => $value->presenter_time_slot,
//                            'presenter_resource_link' => $value->presenter_resource_link,
//                            'upload_published_name' => $value->upload_published_name,
//                            'link_published_name' => $value->link_published_name,
//                            'presenter_resource' => $value->presenter_resource
//                        );
//                        $this->db->insert("sessions_add_presenter", $set_array);
//                    }
//                }
//            }
//        } else {
//            return '';
//        }
    }

}

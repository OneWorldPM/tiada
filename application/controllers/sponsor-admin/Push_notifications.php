<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Push_notifications extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->common->set_timezone();
        $login_type = $this->session->userdata('userType');
        if ($login_type != 'sponsor') {
            redirect('sponsor-admin/login');
        }
        $this->load->model('sponsor/m_push_notifications', 'mpushnotifications');
    }

    public function index() {
        $data['push_notifications'] = $this->mpushnotifications->get_push_notifications();
        $data['sponsor'] = $this->mpushnotifications->get_sponsor_data();
        $this->load->view('sponsor/header');
        $this->load->view('sponsor/push_notifications', $data);
        $this->load->view('sponsor/footer');
    }

    public function add_push_notifications() {
        $post = $this->input->post();
        if (!empty($post)) {
            $res = $this->mpushnotifications->add_push_notifications($post);
            if ($res) {
                header('Location: ' . base_url() . 'sponsor-admin/push_notifications?msg=S');
            } else {
                header('Location: ' . base_url() . 'sponsor-admin/push_notifications?msg=E');
            }
        }
    }

    public function delete_push_notifications($pid) {
        $this->db->delete('push_notification_sponsor', array('push_notification_id' => $pid));
        header('Location: ' . base_url() . 'sponsor-admin/push_notifications?msg=D');
    }

    public function send_notification($pid) {
        $sponsor_id = $this->input->get('sponsor_id');
        $this->db->update('push_notification_sponsor', array('status' => 0), array("sponsors_id" => $sponsor_id));
        $this->db->update('push_notification_sponsor', array('status' => 1), array('push_notification_id' => $pid));
        $result_array = array("status" => "success");
        echo json_encode($result_array);
    }

    public function close_notification($pid) {
        $this->db->update('push_notification_sponsor', array('status' => 0), array('push_notification_id' => $pid));
        $result_array = array("status" => "success");
        echo json_encode($result_array);
    }

}

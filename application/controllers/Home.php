<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->common->set_timezone();
        $login_type = $this->session->userdata('userType');
        if ($login_type != 'user') {
            redirect('login');
        }
        $this->load->model('user/m_home', 'objhome');
        $this->load->model('madmin/m_support_live_chat', 'support_chat');
    }

    public function index() {
        $data = array('liveSupportStatus' => $this->supportChatStatus());
        $this->load->view('header');
        $this->load->view('home', $data);
        $this->load->view('footer');
    }

    public function notes() {
        $data["briefcase_list"] = $this->getNote();
        $data["all_sessions"] = $this->objhome->getsessions_data();
        $data["sponsor_resources"] =  $this->getSponsorResources();
        $this->load->view('header');
        $this->load->view('notes', $data);
        $this->load->view('footer');
    }

    function getNote() {
        $this->db->select('*');
        $this->db->from('sessions_cust_briefcase b');
        $this->db->join('sessions s', 's.sessions_id=b.sessions_id');
        $this->db->where(array("cust_id" => $this->session->userdata("cid"), 'resource_type'=>'note'));
        $sessions_cust_briefcase = $this->db->get();
        if ($sessions_cust_briefcase->num_rows() > 0) {
            return $sessions_cust_briefcase->result();
        } else {
            return '';
        }
    }

    function getSponsorResources() {
        $this->db->select('*');
        $this->db->from('sessions_cust_briefcase b');
        //$this->db->join('sessions s', 's.sessions_id=b.sessions_id');
        $this->db->where(array("cust_id" => $this->session->userdata("cid"), 'resource_type'=>'file'));
        $sessions_cust_briefcase = $this->db->get();
        if ($sessions_cust_briefcase->num_rows() > 0) {
            return $sessions_cust_briefcase->result();
        } else {
            return '';
        }
    }

    function add_user_activity() {
        $post = $this->input->post();
        $int_array = array(
            'user_id' => $post['user_id'],
            'page_name' => $post['page_name'],
            'page_link' => $post['page_link'],
            'activity_date_time' => date("Y-m-d h:i:s")
        );
        $this->db->insert("user_activity", $int_array);
        return TRUE;
    }

    function delete_note($sessions_cust_briefcase_id) {
        $this->db->delete("sessions_cust_briefcase", array("sessions_cust_briefcase_id" => $sessions_cust_briefcase_id));
        header('location:' . base_url() . 'home/notes');
    }

    function getSupportChatStatus()
    {
        $this->db->select('live_support_status');
        $this->db->from('admin');
        $this->db->where(array("username " => 'admin'));
        $status = $this->db->get();
        if ($status->num_rows() > 0) {
            print_r($status->result()[0]->live_support_status);
        } else {
            echo '0';
        }
    }

    function supportChatStatus()
    {
        $this->db->select('live_support_status');
        $this->db->from('admin');
        $this->db->where(array("username " => 'admin'));
        $status = $this->db->get();
        if ($status->num_rows() > 0) {
            return ($status->result()[0]->live_support_status);
        } else {
            return 0;
        }
    }

    function addSponsorResourceBriefcase() {
        $post = $this->input->post();
        $resource_type = 'file';
        $insert_array = array(
            'cust_id' => $this->session->userdata("cid"),
            'sessions_id' => 0,
            'note' => '',
            'resource_type' => $resource_type,
            'session_resource_id' => $post['itemId'],
            'item_name' => $post['itemName'],
            'file_name' => $post['fileName'],
            'reg_briefcase_date' => date("Y-m-d")
        );
        $this->db->insert("sessions_cust_briefcase", $insert_array);
//        $result_data = $this->db->get_where("sessions_cust_briefcase", array("cust_id" => $this->session->userdata("cid"), 'sessions_id' => $post['sessions_id']))->row();
//        if (empty($result_data)) {
//            $this->db->insert("sessions_cust_briefcase", $insert_array);
//        } else {
//            $this->db->update("sessions_cust_briefcase", $insert_array, array("sessions_cust_briefcase_id" => $result_data->sessions_cust_briefcase_id));
//        }
        return;
    }

}

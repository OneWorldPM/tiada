<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sponsor extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->common->set_timezone();
        $login_type = $this->session->userdata('userType');
        if ($login_type != 'user') {
            redirect('login');
        }
        $get_user_token_details = $this->common->get_user_details($this->session->userdata('cid'));
        if($this->session->userdata('token') != $get_user_token_details->token){
           redirect('login');   
        }
        $this->load->model('user/m_sponsor', 'objsponsor');
    }

    public function index() {
        $data["all_sponsor"] = $this->objsponsor->getPlatinumSponsorData();
        $this->load->view('header');
        $this->load->view('platinum_sponsor', $data);
        $this->load->view('footer');
    }

    public function other_sponsor() {
        $data["platinum_sponsors"] = $this->objsponsor->getPlatinumSponsorData();
		$data["gold_sponsors"] = $this->objsponsor->getGoldSponsorData();
        $data["silver_sponsors"] = $this->objsponsor->getSilverSponsorData();
        $data["bronze_sponsors"] = $this->objsponsor->getBronzeSponsorData();
        $data["all_sponsor"] = $this->objsponsor->getSponsorData();
        $data["sponsors_category"] = $this->objsponsor->getSponsorsCategoryData();
        $this->load->view('header');
        $this->load->view('sponsor', $data);
        $this->load->view('footer');
    }

    public function filter_search() {
        header("Cache-Control: no cache");
        $data["platinum_sponsors"] = $this->objsponsor->getPlatinumSponsorDataFilter_search();
		$data["gold_sponsors"] = $this->objsponsor->getGoldSponsorDataFilter_search();
        $data["silver_sponsors"] = $this->objsponsor->getSilverSponsorDataFilter_search();
        $data["bronze_sponsors"] = $this->objsponsor->getBronzeSponsorDataFilter_search();
        $data["all_sponsor"] = $this->objsponsor->getSponsorDataFilter_search();
        $data["sponsors_category"] = $this->objsponsor->getSponsorsCategoryData();
        $this->load->view('header');
        $this->load->view('sponsor', $data);
        $this->load->view('footer');
    }

    public function view($sponsor_id) {
        $data["sponsor"] = $this->objsponsor->viewSponsorData($sponsor_id);
        $this->load->view('header');
        $this->load->view('view_sponsor', $data);
        $this->load->view('footer');
    }

    public function basicSponsor($sponsor_id) {
        $data["sponsor"] = $this->objsponsor->viewSponsorData($sponsor_id);
        $this->load->view('header');
        $this->load->view('view_basic_sponsor', $data);
        $this->load->view('footer');
    }

    public function add_viewsessions_history_open() {
        $post = $this->input->post();

        if (isset($post['action']) && $post['action'] != '') {
            $action = $post['action'];
        } else {
            $action = 'visit';
        }

        if (isset($post['addnl_info']) && $post['addnl_info'] != '') {
            $addnl_info = $post['addnl_info'];
        } else {
            $addnl_info = NULL;
        }

        $this->load->library('user_agent');
        $user_agent = $this->input->ip_address();
        $session_his_arr = array(
            'sponsor_id' => $post['sponsor_id'],
            'cust_id' => $this->session->userdata("cid"),
            'action' => $action,
            'addnl_info' => $addnl_info,
            'operating_system' => $this->agent->platform(),
            'computer_type' => $this->agent->browser(),
            'ip_address' => $this->input->ip_address(),
            'resolution' => $post['resolution'],
            'start_date_time' => date("Y-m-d h:i:s"),
            'status' => 0
        );
        $this->db->insert('view_sponsor_history', $session_his_arr);
        $insert_id = $this->db->insert_id();
        echo json_encode(array("status" => "success", "view_sponsor_history_id" => $insert_id));
    }

    public function update_viewsessions_history_open() {
        $post = $this->input->post();
        $session_his_arr = array(
            'end_date_time' => date("Y-m-d h:i:s")
        );
        $this->db->update('view_sponsor_history', $session_his_arr, array("view_sponsor_history_id" => $post['view_sponsor_history_id']));
        echo json_encode(array("status" => "success"));
    }

    public function cardToFishbowl() {
        $card = array(
            'sponsor_id' => $this->input->post()['sponsor_id'],
            'attendee_id' => $this->input->post()['attendee_id'],
            'datetime' => date('Y-m-d H:i:s')
        );
        $this->db->insert('fishbowl', $card);
        return;
    }

}

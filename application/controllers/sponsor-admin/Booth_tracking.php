<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Booth_tracking extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $login_type = $this->session->userdata('userType');
        if ($login_type != 'sponsor') {
            redirect('sponsor-admin/login');
        }
        $this->load->model('user/m_sponsor', 'objsponsor');
    }

    public function index() {
        $sponsorId = $this->session->userdata()['sponsors_id'];
        $data['booth_tracking'] = $this->objsponsor->get_booth_tracking($sponsorId);
        $this->load->view('sponsor/header');
        $this->load->view('sponsor/booth_tracking', $data);
        $this->load->view('sponsor/footer');
    }

}

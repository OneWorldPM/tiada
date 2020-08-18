<?php

class Fishbowl extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $login_type = $this->session->userdata('userType');
        if ($login_type != 'sponsor') {
            redirect('sponsor-admin/login');
        }
        $this->load->model('user/m_sponsor', 'objsponsor');
    }

    public function index()
    {
        $sponsorId = $this->session->userdata()['sponsors_id'];
        $data = array('cards' => $this->getAllCardsFromFishbowl($sponsorId));

        $this->load->view('sponsor/header');
        $this->load->view('sponsor/fishbowl', $data);
        $this->load->view('sponsor/footer');
    }

    public function getAllCardsFromFishbowl($sponsorId)
    {
        $this->db->select('f.*, cm.*');
        $this->db->from('fishbowl AS f');
        $this->db->join('customer_master AS cm', 'cm.cust_id = f.attendee_id');
        $this->db->where(array('f.sponsor_id'=>$sponsorId));
        $this->db->group_by('f.attendee_id');
        $sessions = $this->db->get();
        if ($sessions->num_rows() > 0) {
            return $sessions->result();
        } else {
            return array();
        }
    }
}

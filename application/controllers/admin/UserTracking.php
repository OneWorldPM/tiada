<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class UserTracking extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->common->set_timezone();
        $login_type = $this->session->userdata('aname');
        if ($login_type != 'admin') {
            redirect('admin/alogin');
        }
        $this->load->model('user/m_sponsor', 'objsponsor');
    }

    public function index()
    {
        $data['booth_tracking'] = $this->get_booth_tracking();
        $this->load->view('admin/header');
        $this->load->view('admin/user_tracking', $data);
        $this->load->view('admin/footer');
    }

    function get_booth_tracking()
    {
        $this->db->select('s.*, c.*, sp.company_name');
        $this->db->from('view_sponsor_history s');
        $this->db->join('customer_master c', 's.cust_id=c.cust_id');
        $this->db->join('sponsors sp', 's.sponsor_id = sp.sponsors_id');
        $sessions = $this->db->get();
        if ($sessions->num_rows() > 0) {
            return $sessions->result();
        } else {
            return '';
        }
    }

}

<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Support_Live_Chat extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->common->set_timezone();
        $login_type = $this->session->userdata('aname');
        if ($login_type != 'admin') {
            redirect('admin/alogin');
        }
        $this->load->model('madmin/m_support_live_chat', 'support_chat');
    }

    public function index() {
        $status = $this->getSupportChatStatus();
        $this->load->view('admin/header');
        $this->load->view('admin/support_live_chat', $status);
        $this->load->view('admin/footer');
    }

    function getSupportChatStatus()
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

    public function chageStatus($status)
    {
        $status = ($status == 'true')?1:0;
        $this->db->set('live_support_status', $status);
        $this->db->where('username', 'admin');
        $this->db->update('admin');

        echo "setting ".$status;
        return;
    }

}

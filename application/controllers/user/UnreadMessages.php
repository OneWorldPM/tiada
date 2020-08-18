<?php

class UnreadMessages  extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $login_type = $this->session->userdata('userType');
        if ($login_type != 'user') {
            redirect('login');
        }
    }

    public function index() {
        $userId = $this->session->userdata("cid");
        $data = array('unreadMessages' => $this->getUnreadMessages($userId));
        $this->load->view('header');
        $this->load->view('user/unread_messages', $data);
        $this->load->view('footer');
    }

    public function getUnreadMessages()
    {
        $userId = $this->session->userdata("cid");
        $this->db->select('soc.*, s.company_name');
        $this->db->from('sponsor_oto_chat soc');
        $this->db->join('sponsors s', 's.sponsors_id = soc.sponsor_id');
        $this->db->where(array('soc.to_id'=>$userId, 'soc.marked_read'=>0));
        $this->db->group_by('soc.sponsor_id');
        $sessions = $this->db->get();
        if ($sessions->num_rows() > 0) {
            echo json_encode($sessions->result());
            return $sessions->result();
        } else {
            echo json_encode(array());
            return array();
        }
    }

    public function markAllAsRead($sponsorId)
    {
        $userId = $this->session->userdata("cid");
        $this->db->set('marked_read', '1');
        $this->db->where(array('to_id'=>$userId, 'sponsor_id'=>$sponsorId));
        $this->db->update('sponsor_oto_chat');
        return;
    }
}

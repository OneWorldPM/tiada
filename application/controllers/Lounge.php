<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lounge extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->common->set_timezone();
        $login_type = $this->session->userdata('userType');
        if ($login_type != 'user') {
            redirect('login');
        }
        $this->load->model('user/m_home', 'objhome');
    }

    public function index()
    {
        $profile_data = $this->common->get_user_details($this->session->userdata('cid'));
        $data = array('profile_data' => $profile_data);

        $this->load->view('header');
        $this->load->view('lounge', $data);
        $this->load->view('footer');
    }
}

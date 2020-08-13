<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Private_sessions extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->common->set_timezone();
        $login_type = $this->session->userdata('userType');
        if ($login_type != 'user') {
            redirect('login');
        }
        $this->load->model('user/m_sessions', 'sessions');
        $this->load->model('user/m_private_sessions', 'psessions');
    }

    public function view($sessions_id)
    {
        $data["sessions"] = $this->sessions->viewSessionsData($sessions_id);
        $data["session_resource"] = $this->sessions->get_session_resource($sessions_id);

        $this->load->view('header');
        $this->load->view('private_sessions_view', $data);
        $this->load->view('footer');
    }

}

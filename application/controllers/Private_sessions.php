<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Private_sessions extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->common->set_timezone();
        $login_type = $this->session->userdata('userType');
        if ($login_type != 'user') {
            redirect('https://www.txiada.org/login.asp?redirectURL=https://yourconference.live/tiadaannualconference/login/authenticate');
        }
        $this->load->model('user/m_private_sessions', 'objpsessions');
    }

    public function view($sessions_id) {
        $this->load->view('header');
        $this->load->view('private_sessions_view');
        $this->load->view('footer');
    }

}

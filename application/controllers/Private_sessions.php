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
        $get_user_token_details = $this->common->get_user_details($this->session->userdata('cid'));
        if($this->session->userdata('token') != $get_user_token_details->token){
           redirect('login');   
        }
        $this->load->model('user/m_sessions', 'sessions');
        $this->load->model('user/m_private_sessions', 'psessions');
    }

    public function view($sessions_id)
    {
        $data["sessions"] = $this->sessions->viewSessionsData($sessions_id);
        $data["session_resource"] = $this->sessions->get_session_resource($sessions_id);

        $startTime = strtotime($data["sessions"]->sessions_date." ".$data["sessions"]->time_slot);
        $endTime = strtotime($data["sessions"]->sessions_date." ".$data["sessions"]->end_time);

        if (isset($_GET['testing'])){
            $this->load->view('header');
            $this->load->view('private_sessions_view', $data);
            $this->load->view('footer');
            //exit;
        }elseif (time() < $startTime)
        {
            $data['error'] = true;
            $data['message'] = "Session hasn't started yet";

            $this->load->view('header');
            $this->load->view('private_session_error', $data);
            $this->load->view('footer');
        }elseif (time() > $endTime)
        {
            $data['error'] = true;
            $data['message'] = "Session ended";

            $this->load->view('header');
            $this->load->view('private_session_error', $data);
            $this->load->view('footer');
        }elseif (time() > $startTime && time() < $endTime)
        {
            $this->load->view('header');
            $this->load->view('private_sessions_view', $data);
            $this->load->view('footer');
        }else{
            $time = time();
            echo $data["sessions"]->time_slot."<br>";
            echo date("H:i:s", time())."<br>";
            echo $data["sessions"]->end_time."<br>";

            echo "if {$time} < {$startTime} OR {$time} > $endTime";
            exit;
            //redirect('sessions');
        }
    }

}

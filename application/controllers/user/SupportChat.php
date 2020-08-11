<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class SupportChat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->common->set_timezone();
        $login_type = $this->session->userdata('userType');
        if ($login_type != 'user')
        {
            redirect('https://www.txiada.org/login.asp?redirectURL=https://yourconference.live/tiadaannualconference/login/authenticate');
        }
        $this->load->model('user/SupportChat_Model', 'chat');
    }

    public function sendMessage()
    {
        echo json_encode($this->chat->sendMessage());
        return;
    }

    public function getAllChats($attendee_id)
    {
        echo json_encode($this->chat->getAllChats($attendee_id));
        return;
    }
}

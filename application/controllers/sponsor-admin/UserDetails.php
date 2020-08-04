<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class UserDetails extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $login_type = $this->session->userdata('userType');
        if ($login_type == '') {
            redirect('/tiadaannualconference');
        }

        $this->load->model('user/M_myprofile', 'user');
    }

    public function nameById($cid)
    {
        $name = $this->user->nameById($cid);
        echo "{$name->first_name} {$name->last_name}";
        return;
    }
}

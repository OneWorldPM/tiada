<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Schedules extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $login_type = $this->session->userdata('userType');
        if ($login_type == '') {
            redirect('/tiadaannualconference');
        }

        $this->load->model('sponsor/Schedules_Model', 'schedules');
    }

    public function addAvailability()
    {
        $response = $this->schedules->addAvailability();
        if ($response == false)
        {
            $jsonResponse = array('status'=>'failed', 'message'=> 'Unable to add! <br> Reason: Selected time overlaps another availability!', 'data'=> '');
        }else{
            $jsonResponse = array('status'=>'success', 'message'=> 'Availability added!', 'data'=> $response);
        }
        echo json_encode($jsonResponse);
        return;
    }

    public function getCurrentAvailabilityList()
    {
        echo json_encode($this->schedules->getCurrentAvailabilityList());
        return;
    }
}

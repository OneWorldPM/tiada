<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class VideoChatApi extends CI_Controller
{
    public function engageSponsor()
    {
        $roomId = $this->input->post('roomId');
        $sponsorId = $this->input->post('sponsorId');

        $this->session->set_userdata($sponsorId.'_videoEngaged', 'true');

        return;
    }

    public function releaseSponsor()
    {
        $roomId = $this->input->post('roomId');
        $sponsorId = $this->input->post('sponsorId');

        $this->session->set_userdata($sponsorId.'_videoEngaged', 'false');

        return;
    }

    public function sponsorVideoEngageStatus()
    {
        $roomId = $this->input->post('roomId');
        $sponsorId = $this->input->post('sponsorId');

        if ($this->session->has_userdata($sponsorId.'_videoEngaged'))
        {
            $status = $this->session->userdata($sponsorId.'_videoEngaged');
            echo $status;
        }else{
            echo 'false';
        }
        return;
    }
}

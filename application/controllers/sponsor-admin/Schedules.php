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

    public function getAllScheduledMeetings($sponsor_id, $contact_person)
    {
        $meetings = json_encode(array());
        $meetingsList = $this->schedules->getAllScheduledMeetings($sponsor_id, $contact_person);
        if ($meetingsList){
            echo json_encode($meetingsList);
            return;
        }
        echo $meetings;
        return;
    }

    public function getAvailableDatesOf()
    {
        $dates = $this->schedules->getAvailableDatesOf();

        if ($dates == false){
            echo json_encode(array());
            return;
        }

        $dateSlots = array();

        foreach ($dates as $dateSlotsData)
        {
            $period = new DatePeriod(
                new DateTime($dateSlotsData['from_date'].' 00:00:01'),
                new DateInterval('P1D'),
                new DateTime($dateSlotsData['to_date'].' 23:59:59')
            );

            foreach ($period as $key => $value) {
                $dateSlots[] = $value->format('Y-m-d');
            }
        }

        $dates = array_unique($dateSlots);
        echo json_encode($dates);
        return;
    }

    public function getTimeSlotByDateOf()
    {
        $sponsor_id = $this->input->post()['sponsor_id'];
        $contact_person = $this->input->post()['contact_person'];
        $date = $this->input->post()['date'];

        $dates = $this->schedules->getTimeSlotByDateOf();

        if ($dates == false){
            echo json_encode(array());
            return;
        }

        $timeSlots = array();
        $meetingDuration  = 30 * 60; //15 minutes

        foreach ($dates as $times)
        {
            $start_time = strtotime(substr($dates[0]['from_time'], strrpos($dates[0]['from_time'], ' ') + 1));
            $end_time = strtotime(substr($dates[0]['to_time'], strrpos($dates[0]['to_time'], ' ') + 1));
            while ($start_time <= $end_time)
            {
                $timeSlots[] = date ("H:i", $start_time);
                $start_time += $meetingDuration;
            }
        }

        $existingBookings = $this->schedules->getExistingBookings($sponsor_id, $contact_person, $date);
        $existingTimeSlots = array();
        if ($existingBookings != false){
            foreach ($existingBookings as $existingTimes)
            {
                $existingStart_time = strtotime($existingTimes['meeting_from']);
                $existingTimeSlots[] = date ("H:i", $existingStart_time);
            }
        }

        array_pop($timeSlots);

        $finalAvailableTimes = array_diff($timeSlots, $existingTimeSlots);

        echo json_encode(array_values($finalAvailableTimes));
        return;
    }

    public function makeBooking()
    {
        $status = $this->schedules->makeBooking();

        if ($status == true){
            echo json_encode(array('status'=>'success', 'message'=>'Your meeting has been scheduled.'));
            return;
        }elseif ($status == false)
        {
            echo json_encode(array('status'=>'error', 'message'=>'Someone else booked that time slot while you were planning!'));
            return;
        }

        echo json_encode(array('status'=>'failed', 'message'=>'Unable to schedule the meeting.'));
        return;

    }
    
}

<?php

class Schedules_Model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function addAvailability()
    {
        $overLapCheck = $this->availabilityOverlapCheck();
        if ($overLapCheck == false){
            return false;
        }

        $sponsorId = $this->input->post()['sponsor_id'];
        $contactPerson = $this->input->post()['contact_person'];
        $availableFrom = $this->input->post()['available_from'];
        $availableTo = $this->input->post()['available_to'];

        $data = array(
            'sponsor_id' => $sponsorId,
            'contact_person ' => $contactPerson,
            'available_from' => $availableFrom,
            'available_to' => $availableTo
        );

        $this->db->insert('sponsor_meeting_availability', $data);

        return $this->getCurrentAvailabilityList();
    }

    function getCurrentAvailabilityList()
    {
        $sponsorId = $this->input->post()['sponsor_id'];
        $contactPerson = $this->input->post()['contact_person'];

        $this->db->select('*');
        $this->db->from('sponsor_meeting_availability');
        $this->db->where('sponsor_id', $sponsorId);
        $this->db->where('contact_person', $contactPerson);
        $this->db->order_by('available_from','asc');
        $query = $this->db->get();
        if($query->num_rows() != 0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }

    function availabilityOverlapCheck()
    {
        $sponsorId = $this->input->post()['sponsor_id'];
        $contactPerson = $this->input->post()['contact_person'];
        $availableFrom = $this->input->post()['available_from'];
        $availableTo = $this->input->post()['available_to'];

        $query = $this->db->query("SELECT * FROM `sponsor_meeting_availability`
                                    WHERE 
                                          sponsor_id = '".$sponsorId."' AND
                                          contact_person = '".$contactPerson."' AND
                                          (('".$availableFrom."' between available_from AND available_to) OR ('".$availableTo."' between available_from AND available_to))
                                    ");
        if($query->num_rows() != 0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    function getAllScheduledMeetings($sponsor_id, $user_name_lower)
    {
        $query = $this->db->query("SELECT REPLACE( smb.meeting_from, ' ', 'T' ) as start,
                                          REPLACE( smb.meeting_to, ' ', 'T' ) as end,
                                          cm.cust_id as attendeeId,
                                          CONCAT(cm.first_name, ' ', cm.last_name) as attendeeName,
                                          CONCAT('Meeting with ', CONCAT(cm.first_name, ' ', cm.last_name)) as title,
                                          CONCAT('event-item-btn') as className
                                    FROM `sponsor_meeting_bookings` as smb
                                    LEFT JOIN `customer_master` as cm ON cm.cust_id = smb.attendee_id
                                    WHERE 
                                          smb.sponsor_id = '".$sponsor_id."' AND
                                          smb.contact_person = '".$user_name_lower."'
                                    ");
        if($query->num_rows() != 0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }

    function getAvailableDatesOf()
    {
        $sponsor_id = $this->input->post()['sponsor_id'];
        $contact_person = $this->input->post()['contact_person'];
        $query = $this->db->query("SELECT 
                                    DATE(`available_from`) from_date, DATE(`available_to`) to_date
                                    FROM `sponsor_meeting_availability` 
                                    WHERE sponsor_id = '".$sponsor_id."' AND contact_person = '".$contact_person."'
                                    ");
        if($query->num_rows() != 0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }

    function getTimeSlotByDateOf()
    {
        $sponsor_id = $this->input->post()['sponsor_id'];
        $contact_person = $this->input->post()['contact_person'];
        $date = $this->input->post()['date'];
        $query = $this->db->query("SELECT 
                                    (`available_from`) from_time, (`available_to`) to_time
                                    FROM `sponsor_meeting_availability` 
                                    WHERE sponsor_id = '".$sponsor_id."' AND contact_person = '".$contact_person."'
                                    AND (DATE(`available_from`) = '".$date."' OR DATE(`available_to`) = '".$date."')
                                    ");
        if($query->num_rows() != 0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }

    function makeBooking()
    {
        $sponsorId = $this->input->post()['sponsor_id'];
        $contactPerson = $this->input->post()['contact_person'];
        $attendeeId = $this->input->post()['attendee_id'];
        $meetFrom = $this->input->post()['meet_from'];
        $meetTo = $this->input->post()['meet_to'];

        $data = array(
            'sponsor_id' => $sponsorId,
            'contact_person ' => $contactPerson,
            'attendee_id ' => $attendeeId,
            'meeting_from' => $meetFrom,
            'meeting_to' => $meetTo
        );

        if ($this->existingBookingCheck() != true)
        {
            $this->db->insert('sponsor_meeting_bookings', $data);
            return true;
        }else{
            return false;
        }
    }

    function existingBookingCheck()
    {
        $sponsorId = $this->input->post()['sponsor_id'];
        $contactPerson = $this->input->post()['contact_person'];
        $meetFrom = $this->input->post()['meet_from'];
        $meetTo = $this->input->post()['meet_to'];

        $data = array(
            'sponsor_id' => $sponsorId,
            'contact_person ' => $contactPerson,
            'meeting_from' => $meetFrom,
            'meeting_to' => $meetTo
        );

        $this->db->select('*');
        $this->db->from('sponsor_meeting_bookings');
        $this->db->where($data);
        $query = $this->db->get();
        if($query->num_rows() != 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function getExistingBookings($sponsor_id, $contact_person, $date){
        $query = $this->db->query("SELECT 
                                    (`meeting_from`) meeting_from
                                    FROM `sponsor_meeting_bookings` 
                                    WHERE sponsor_id = '".$sponsor_id."' AND contact_person = '".$contact_person."'
                                    AND DATE(`meeting_from`) = '".$date."'
                                    ");
        if($query->num_rows() != 0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }

}

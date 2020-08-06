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
}

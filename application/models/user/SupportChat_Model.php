<?php


class SupportChat_Model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function sendMessage()
    {
        $attendee_id = $this->input->post()['attendee_id'];
        $message_from = $this->input->post()['message_from'];
        $message = $this->input->post()['message'];

        $data = array(
            'attendee_id' => $attendee_id,
            'message_from' => $message_from,
            'message' => $message,
            'datetime' => date('Y-m-d H:i:s')
        );

        $this->db->insert('support_chat', $data);

        return $data;
    }

    function getAllChats($attendee_id)
    {
        $this->db->select(
            "
            sc.*, 
            CONCAT(cm.first_name, ' ', cm.last_name) AS attendee_name
            "
        );
        $this->db->from('support_chat sc');
        $this->db->join('customer_master cm', 'cm.cust_id = sc.attendee_id', 'left');
        $this->db->where('sc.attendee_id', $attendee_id);
        $this->db->order_by('sc.datetime','asc');
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
}

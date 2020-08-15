<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Common {

    private $_CI;

    function __construct() {
        $this->_CI = & get_instance();
    }

    function set_timezone() {
        date_default_timezone_set("America/Chicago"); //America/Dawson_Creek or Asia/Kolkata or America/Los_Angeles
    }

    function sendEmail($from, $to, $subject, $message, $name = NULL) {
        $from = "no-reply@yourconference.live";
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'yourconference.live',
            'smtp_port' => 25,
            'smtp_user' => 'no-reply@yourconference.live',
            'smtp_pass' => 'yc_email123#',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE,
            'smtp_crypto' => ''
        );

        $this->_CI->load->library('email', $config);
        $this->_CI->email->set_newline("\r\n");
        $this->_CI->email->from($from, $name);
        $this->_CI->email->to($to);
        $this->_CI->email->subject($subject);
        $this->_CI->email->message($message);
        if ($this->_CI->email->send()) {
            return 1;
        } else {
            return 0;
        }
    }

    function get_user_details($cust_id) {
        $this->_CI->db->where('cust_id', trim($cust_id));
        $customer_master = $this->_CI->db->get('customer_master');
        if ($customer_master->num_rows() > 0) {
            return $customer_master->row();
        } else {
            return "";
        }
    }

    function get_presenter_data($presenter_id) {
        $this->_CI->db->where('presenter_id', trim($presenter_id));
        $presenter = $this->_CI->db->get('presenter');
        if ($presenter->num_rows() > 0) {
            return $presenter->row();
        } else {
            return "";
        }
    }

    function getGroupChatUser($users_id) {
        $where_in = explode(",", $users_id);
        $this->_CI->db->select('cust_id,register_id,first_name,last_name');
        $this->_CI->db->from('customer_master');
        $this->_CI->db->where_in('cust_id', $where_in);
        $this->_CI->db->order_by("cust_id", "desc");
        $result = $this->_CI->db->get();
        return ($result->num_rows() > 0) ? $result->result() : '';
    }

    function getGroupChatPresenter($presenter_id) {
        $where_in = explode(",", $presenter_id);
        $this->_CI->db->select('*');
        $this->_CI->db->from('presenter');
        $this->_CI->db->where_in('presenter_id', $where_in);
        $this->_CI->db->order_by("presenter_id", "desc");
        $result = $this->_CI->db->get();
        return ($result->num_rows() > 0) ? $result->result() : '';
    }

    function get_question_favorite_status($presenter_id, $sessions_cust_question_id) {
        $this->_CI->db->where(array('cust_id' => $presenter_id, 'sessions_cust_question_id' => $sessions_cust_question_id));
        $presenter = $this->_CI->db->get('tbl_favorite_question');
        if ($presenter->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    function get_session_presenter($sessions_id) {
        $this->_CI->db->select('*');
        $this->_CI->db->from('sessions_add_presenter');
        $this->_CI->db->where_in('sessions_id', $sessions_id);
        $this->_CI->db->order_by("order_index_no", "asc");
        $result = $this->_CI->db->get();
        return ($result->num_rows() > 0) ? $result->result() : '';
    }

    function get_presenter($presenter_id, $sessions_id) {
        $where_in = explode(",", $presenter_id);
        $this->_CI->db->select('p.*');
        $this->_CI->db->from('presenter p');
        $this->_CI->db->join('sessions_add_presenter s', 'p.presenter_id = s.select_presenter_id');
        $this->_CI->db->where_in('p.presenter_id', $where_in);
        $this->_CI->db->where('s.sessions_id', $sessions_id);
        $this->_CI->db->order_by("s.order_index_no", "asc");
        $result = $this->_CI->db->get();
        return ($result->num_rows() > 0) ? $result->result() : '';
    }

    function get_presenter_chat_data($presenter_id) {
        $where_in = explode(",", $presenter_id);
        $this->_CI->db->select('p.*');
        $this->_CI->db->from('presenter p');
        $this->_CI->db->where_in('p.presenter_id', $where_in);
        $result = $this->_CI->db->get();
        return ($result->num_rows() > 0) ? $result->result() : '';
    }

    function get_session_resource($session_resource_id) {
        $this->_CI->db->where('session_resource_id', trim($session_resource_id));
        $session_resource = $this->_CI->db->get('session_resource');
        if ($session_resource->num_rows() > 0) {
            return $session_resource->row();
        } else {
            return "";
        }
    }

    function do_upload($htmlFieldName, $path, $filename, $isoverwrite = TRUE) {
        $config['file_name'] = $filename;
        $config['upload_path'] = $path;
        $config['allowed_types'] = '*';
        $config['overwrite'] = $isoverwrite;
        $this->_CI->load->library('upload', $config);
        if (!$this->_CI->upload->do_upload($htmlFieldName)) {
            return array('error' => $this->_CI->upload->display_errors(), 'status' => 0);
        } else {
            return array('status' => 1, 'upload_data' => $this->_CI->upload->data());
        }
    }

    function get_total_sign_up_sessions($sessions_id) {
        $this->_CI->db->where('sessions_id', trim($sessions_id));
        $result = $this->_CI->db->get('sign_up_sessions');
        if ($result->num_rows() > 0) {
            return $result->num_rows();
        } else {
            return 0;
        }
    }

    function get_status_sign_up_sessions($sessions_id, $cust_id) {
        $this->_CI->db->where(array('sessions_id' => trim($sessions_id), 'cust_id' => $cust_id));
        $result = $this->_CI->db->get('sign_up_sessions');
        if ($result->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    function get_total_sign_up_sessions_user($cust_id) {
        $this->_CI->db->where(array('cust_id' => $cust_id));
        $result = $this->_CI->db->get('sign_up_sessions');
        if ($result->num_rows() > 0) {
            return $result->num_rows();
        } else {
            return 0;
        }
    }

    function get_roundtable_setting() {
        $result = $this->_CI->db->get('roundtable_setting');
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return 0;
        }
    }

    function get_session_type($sessions_type_id) {
        $where_in = explode(",", $sessions_type_id);
        $this->_CI->db->select('*');
        $this->_CI->db->from('sessions_type');
        $this->_CI->db->where_in('sessions_type_id', $where_in);
        $result = $this->_CI->db->get();
        return ($result->num_rows() > 0) ? $result->result() : '';
    }

    function get_sessions_tracks($sessions_tracks_id) {
        $where_in = explode(",", $sessions_tracks_id);
        $this->_CI->db->select('*');
        $this->_CI->db->from('sessions_tracks');
        $this->_CI->db->where_in('sessions_tracks_id', $where_in);
        $result = $this->_CI->db->get();
        return ($result->num_rows() > 0) ? $result->result() : '';
    }

    function get_my_swag_bag_status($sessions_id, $cust_id) {
        $this->_CI->db->where(array('sessions_id' => trim($sessions_id), 'cust_id' => $cust_id));
        $result = $this->_CI->db->get('sessions_my_swag_bag');
        if ($result->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    function check_authenticate($cust_id) {
        $this->_CI->db->where('cust_id', trim($cust_id));
        $customer_master = $this->_CI->db->get('customer_master');
        if ($customer_master->num_rows() > 0) {
            $user_details = $customer_master->row();
            if ($user_details->user_id != "") {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://secure.membershipsoftware.org/tiadasecure/api/GetMemberInfo/?securityKey=4A17DC6DF22F45B7AAF5A0554FD447&memberkey=" . $user_details->user_id,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET"
                ));
                $response = curl_exec($curl);
                curl_close($curl);
                $xml_1 = simplexml_load_string($response);
                $json_1 = json_encode($xml_1);
                $member_array = json_decode($json_1, TRUE);
                foreach ($member_array as $key => $value) {
                    if (empty($value)) {
                        unset($member_array[$key]);
                    }
                }
                if (isset($member_array['EventRegistrations'])) {
                    if (!empty($member_array['EventRegistrations']['MemberEvent'])) {
                        foreach ($member_array['EventRegistrations']['MemberEvent'] as $value) {
                            if (is_string($value)) {
                                if ($value == "e204") {
                                    return "access";
                                } else if ($value == "e202") {
                                    return "access";
                                } else if ($value == "e205") {
                                    return "noaccess";
                                } else if ($value == "e203") {
                                    return "noaccess";
                                }
                            } else {
                                if (in_array("e204", $value)) {
                                    return "access";
                                } else if (in_array("e202", $value)) {
                                    return "access";
                                } else if (in_array("e205", $value)) {
                                    return "noaccess";
                                } else if (in_array("e203", $value)) {
                                    return "noaccess";
                                }
                            }
                        }
                    } else {
                        return "access";
                    }
                } else {
                    return "access";
                }
            } else {
                return "access";
            }
        } else {
            return "access";
        }
    }

}

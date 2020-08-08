<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->common->set_timezone();
        $this->load->model('user/m_login', 'objlogin');
    }

    public function index() {
        $this->load->view('main_header');
        $this->load->view('login');
        $this->load->view('footer');
    }

    public function authentication() {
        $username = $this->input->post('email');
        $password = $this->input->post('password');

        if (strlen(trim(preg_replace('/\xb2\xa0/', '', $username))) == 0 || strlen(trim(preg_replace('/\xb2\xa0/', '', $password))) == 0) {
            $this->session->set_flashdata('msg', '<div class="col-md-12 text-red" style="padding: 0 0 10px 0;">Please enter Username or Password</div><br>');
            redirect('login');
        } else {
            $arr = array(
                'email' => $username,
                'password' => base64_encode($password)
            );
            $data = $this->objlogin->user_login($arr);
            if ($data) {
                $session = array(
                    'cid' => $data['cust_id'],
                    'cname' => $data['first_name'],
                    'fullname' => $data['first_name'] . " " . $data['last_name'],
                    'email' => $data['email'],
                    'userType' => 'user'
                );
                $this->session->set_userdata($session);
                redirect('home');
            } else {
                $this->session->set_flashdata('msg', '<div class="col-md-12 text-red" style="padding: 0 0 10px 0;">Username or Password is Wrong.</div><br>');
                redirect('login');
            }
        }
    }

    function register_login($cust_id) {
        $data = $this->objlogin->register_login($cust_id);
        if ($data) {
            $session = array(
                'cid' => $data['cust_id'],
                'cname' => $data['first_name'],
                'fullname' => $data['first_name'] . " " . $data['last_name'],
                'email' => $data['email'],
                'userType' => 'user'
            );
            $this->session->set_userdata($session);
            redirect('home');
        } else {
            redirect('login');
        }
    }

    function logout() {
        $this->session->unset_userdata('cid');
        $this->session->unset_userdata('cname');
        $this->session->unset_userdata('fullname');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('userType');
        header('location:' . base_url() . 'login');
    }

    function authenticate() {
        $authenticationtoken = $this->input->get("AuthenticationToken");
        if ($authenticationtoken != "") {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://secure.membershipsoftware.org/tiadasecure/api/ValidateAuthenticationToken/?securityKey=4A17DC6DF22F45B7AAF5A0554FD447&token=" . $authenticationtoken,
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
            $xml = simplexml_load_string($response);
            $json = json_encode($xml);
            $array = json_decode($json, TRUE);
            foreach ($array as $key => $value) {
                if (empty($value)) {
                    unset($array[$key]);
                }
            }
            if (!empty($array)) {
                if ($array['ValidateAuthenticationTokenResult'] != "") {
                    $user_details = $this->db->get_where("customer_master", array("user_id" => $array['ValidateAuthenticationTokenResult']))->row();

                    if (!empty($user_details)) {
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => "https://secure.membershipsoftware.org/tiadasecure/api/GetBasicMemberInfo/?securityKey=4A17DC6DF22F45B7AAF5A0554FD447&ContactID=" . $array['ValidateAuthenticationTokenResult'],
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
                        if (!empty($member_array)) {
                            $set_update_array = array(
                                "user_id" => $array['ValidateAuthenticationTokenResult'],
                                'first_name' => $member_array['FirstName'],
                                'last_name' => $member_array['LastName'],
                                'email' => $member_array['EmailAddress'],
                                'address' => $member_array['Addresses']['MemberAddress']['AddressLine1'],
                                'address_cont' => $member_array['Addresses']['MemberAddress']['AddressType'],
                                'city' => $member_array['Addresses']['MemberAddress']['City'],
                                'state' => $member_array['Addresses']['MemberAddress']['StateProvince'],
                                'country' => $member_array['Addresses']['MemberAddress']['Country'],
                                'phone' => $member_array['Phones']['MemberPhone'][0]['PhoneNumber'],
                                'website' => isset($member_array['WebsiteURL']) ? $member_array['WebsiteURL'] : '',
                                'customer_type' => $member_array['MemberType'],
                                'customer_type_id' => $member_array['SecurityGroups']['MemberGroup']['GroupKey']
                            );
                            $this->db->update("customer_master", $set_update_array, array("cust_id" => $user_details->cust_id));
                        }
                        $session = array(
                            'cid' => $user_details->cust_id,
                            'cname' => $user_details->first_name,
                            'fullname' => $user_details->first_name . " " . $user_details->last_name,
                            'email' => $user_details->email,
                            'userType' => 'user'
                        );
                        $this->session->set_userdata($session);
                        redirect('home');
                    } else {
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => "https://secure.membershipsoftware.org/tiadasecure/api/GetMemberInfo/?securityKey=4A17DC6DF22F45B7AAF5A0554FD447&memberkey=" . $array['ValidateAuthenticationTokenResult'],
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

                        if (!empty($member_array)) {
                            $or_where = '(email = "' . trim($member_array['EmailAddress']) . '")';
                            $this->db->where($or_where);
                            $customer = $this->db->get('customer_master');
                            if ($customer->num_rows() > 0) {
                                $user_details = $customer->row();
                                $set_update_array = array(
                                    "user_id" => $array['ValidateAuthenticationTokenResult'],
                                    'first_name' => $member_array['FirstName'],
                                    'last_name' => $member_array['LastName'],
                                    'email' => $member_array['EmailAddress'],
                                    'address' => $member_array['Addresses']['MemberAddress']['AddressLine1'],
                                    'address_cont' => $member_array['Addresses']['MemberAddress']['AddressType'],
                                    'city' => $member_array['Addresses']['MemberAddress']['City'],
                                    'state' => $member_array['Addresses']['MemberAddress']['StateProvince'],
                                    'country' => $member_array['Addresses']['MemberAddress']['Country'],
                                    'phone' => $member_array['Phones']['MemberPhone'][0]['PhoneNumber'],
                                    'website' => isset($member_array['WebsiteURL']) ? $member_array['WebsiteURL'] : '',
                                    'customer_type' => $member_array['MemberType'],
                                    'customer_type_id' => $member_array['SecurityGroups']['MemberGroup']['GroupKey']
                                );
                                $this->db->update("customer_master", $set_update_array, array("cust_id" => $user_details->cust_id));

                                $session = array(
                                    'cid' => $user_details->cust_id,
                                    'cname' => $user_details->first_name,
                                    'fullname' => $user_details->first_name . " " . $user_details->last_name,
                                    'email' => $user_details->email,
                                    'userType' => 'user'
                                );
                                $this->session->set_userdata($session);
                                redirect('home');
                            } else {
                                $this->db->order_by("cust_id", "desc");
                                $row_data = $this->db->get("customer_master")->row();
                                if (!empty($row_data)) {
                                    $reg_id = $row_data->cust_id;
                                    $register_id = date("Y") . '-20' . $reg_id;
                                } else {
                                    $register_id = date("Y") . '-200';
                                }
                                $set = array(
                                    "register_id" => $register_id,
                                    "user_id" => $array['ValidateAuthenticationTokenResult'],
                                    'first_name' => $member_array['FirstName'],
                                    'last_name' => $member_array['LastName'],
                                    'email' => $member_array['EmailAddress'],
                                    'password' => base64_encode(1234),
                                    'address' => $member_array['Addresses']['MemberAddress']['AddressLine1'],
                                    'address_cont' => $member_array['Addresses']['MemberAddress']['AddressType'],
                                    'city' => $member_array['Addresses']['MemberAddress']['City'],
                                    'state' => $member_array['Addresses']['MemberAddress']['StateProvince'],
                                    'country' => $member_array['Addresses']['MemberAddress']['Country'],
                                    'phone' => $member_array['Phones']['MemberPhone'][0]['PhoneNumber'],
                                    'website' => isset($member_array['WebsiteURL']) ? $member_array['WebsiteURL'] : '',
                                    'customer_type' => $member_array['MemberType'],
                                    'customer_type_id' => $member_array['SecurityGroups']['MemberGroup']['GroupKey'],
                                    'register_date' => date("Y-m-d h:i")
                                );
                                $this->db->insert("customer_master", $set);
                                $cust_id = $this->db->insert_id();
                                $user_details = $this->db->get_where("customer_master", array("cust_id" => $cust_id))->row();
                                if (!empty($user_details)) {
                                    $session = array(
                                        'cid' => $user_details->cust_id,
                                        'cname' => $user_details->first_name,
                                        'fullname' => $user_details->first_name . " " . $user_details->last_name,
                                        'email' => $user_details->email,
                                        'userType' => 'user'
                                    );
                                    $this->session->set_userdata($session);
                                    redirect('home');
                                }
                            }
                        } else {
                            redirect('https://www.txiada.org/login.asp');
                        }
                    }
                } else {
                    redirect('https://www.txiada.org/login.asp');
                }
            } else {
                redirect('https://www.txiada.org/login.asp');
            }
        } else {
            redirect('https://www.txiada.org/login.asp');
        }
    }

}

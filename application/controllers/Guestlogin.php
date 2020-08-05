<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Guestlogin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->common->set_timezone();
        $this->load->model('user/m_login', 'objlogin');
    }

    public function index() {
        $this->load->view('main_header');
        $this->load->view('guest_login');
        $this->load->view('footer');
    }

    public function authentication() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        if(strlen(trim(preg_replace('/\xb2\xa0/', '', $username))) == 0 || strlen(trim(preg_replace('/\xb2\xa0/', '', $password))) == 0) {
            $this->session->set_flashdata('msg', '<div class="col-md-12 text-red" style="padding: 0 0 10px 0;">Please enter Username or Password</div><br>');
            redirect('guestlogin');
        } else {
            $arr = array(
                'username' => $username,
                'password' => base64_encode($password)
            );
            $data = $this->objlogin->user_login($arr);
            if ($data) {
                if ($data['email'] != "" && $data['first_name'] != "") {
                    $session = array(
                        'cid' => $data['cust_id'],
                        'cname' => $data['first_name'],
                        'email' => $data['email'],
                        'userType' => 'user'
                    );
                    $this->session->set_userdata($session);
                    redirect('home');
                } else {
                    $session = array(
                        'cid' => $data['cust_id'],
                        'cname' => $data['first_name'],
                        'email' => $data['email'],
                        'userType' => 'user'
                    );
                    $this->session->set_userdata($session);
                    redirect('register/user_profile/' . $data['cust_id']);
                }
            } else {
                $this->session->set_flashdata('msg', '<div class="col-md-12 text-red" style="padding: 0 0 10px 0;">Username or Password is Wrong.</div><br>');
                redirect('guestlogin');
            }
        }
    }

}

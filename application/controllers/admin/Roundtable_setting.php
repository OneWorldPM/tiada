<?php

class Roundtable_setting extends CI_Controller {

    function __construct() {
        parent::__construct();
        $login_type = $this->session->userdata('aname');
        if ($login_type != 'admin') {
            redirect('admin/alogin');
        }
        $this->load->model('madmin/m_roundtable_setting', 'mroundtablesetting');
    }

    function index() {
        $data['roundtable_setting'] = $this->mroundtablesetting->get_roundtable_setting();
        $this->load->view('admin/header');
        $this->load->view('admin/roundtable_setting', $data);
        $this->load->view('admin/footer');
    }

    function update_roundtable_setting() {
        $roundtable_setting = $this->input->post('roundtable_setting');
        $result = $this->mroundtablesetting->update_roundtable_setting($roundtable_setting);
        if ($result) {
            header('location:' . site_url() . 'admin/roundtable_setting?msg=U');
        }
    }

}

?>

<?php

class Graphics extends CI_Controller {

    function __construct() {
        parent::__construct();
        $login_type = $this->session->userdata('aname');
        if ($login_type != 'admin') {
            redirect('admin/alogin');
        }
    }

    public function index() {
        $this->load->view('admin/header');
        $this->load->view('admin/graphics');
        $this->load->view('admin/footer');
    }

    public function update_background() {
        
        if ($_FILES['main_background']['name'] != "") {
            $config = array(
                'upload_path' => "./front_assets/images/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE
            );
            $this->load->library('upload', $config);
            $_FILES["main_background"]['name'] = $_FILES['main_background']['name'];
            $_FILES["main_background"]['type'] = $_FILES['main_background']['type'];
            $_FILES["main_background"]['tmp_name'] = $_FILES['main_background']['tmp_name'];
            $_FILES["main_background"]['error'] = $_FILES['main_background']['error'];
            $_FILES["main_background"]['size'] = $_FILES['main_background']['size'];
            $config['file_name'] = 'tiada.jpg';
            $this->upload->initialize($config);
            $this->upload->do_upload("main_background");
        }
        
        if ($_FILES['sub_background']['name'] != "") {
            $config = array(
                'upload_path' => "./front_assets/images/",
                'allowed_types' => "jpg|png|jpeg",
                'overwrite' => TRUE
            );
            $this->load->library('upload', $config);
            $_FILES["sub_background"]['name'] = $_FILES['sub_background']['name'];
            $_FILES["sub_background"]['type'] = $_FILES['sub_background']['type'];
            $_FILES["sub_background"]['tmp_name'] = $_FILES['sub_background']['tmp_name'];
            $_FILES["sub_background"]['error'] = $_FILES['sub_background']['error'];
            $_FILES["sub_background"]['size'] = $_FILES['sub_background']['size'];
            $config['file_name'] = 'bubble_bg_1920.jpg';
            $this->upload->initialize($config);
            $this->upload->do_upload("sub_background");
        }
        redirect('admin/graphics');
    }

}

?>

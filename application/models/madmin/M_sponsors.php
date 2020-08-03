<?php

class M_sponsors extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getSponsorsAll() {
        $this->db->select('*');
        $this->db->from('sponsors');
        $this->db->order_by("sponsors_id", "DESC");
        $sessions = $this->db->get();
        if ($sessions->num_rows() > 0) {
            return $sessions->result();
        } else {
            return '';
        }
    }

    function edit_sponsors($sponsors_id) {
        $this->db->select('*');
        $this->db->from('sponsors');
        $this->db->where("sponsors_id", $sponsors_id);
        $sponsors = $this->db->get();
        if ($sponsors->num_rows() > 0) {
            return $sponsors->row();
        } else {
            return '';
        }
    }

    function createSponsors() {
        $post = $this->input->post();
        if (!empty($post['sponsors_category'])) {
            $sponsors_category_id = implode(",", $post['sponsors_category']);
        } else {
            $sponsors_category_id = "";
        }

        $set = array(
            'email' => trim($post['email']),
            'password' => trim($post['password']),
            'sponsors_category_id' => $sponsors_category_id,
            'website' => trim($post['website']),
            'twitter_id' => trim($post['twitter_id']),
            'facebook_id' => trim($post['facebook_id']),
            'linkedin_id' => trim($post['linkedin_id']),
            'company_name' => trim($post['company_name']),
            'embed_code' => trim($post['embed_code']),
            "create_date" => date("Y-m-d h:i")
        );
        $this->db->insert("sponsors", $set);
        $sponsors_id = $this->db->insert_id();
        if ($sponsors_id > 0) {
            if ($_FILES['sponsors_logo']['name'] != "") {
//                $this->load->library('upload');
//                $this->upload->initialize($this->set_upload_options());
//                $this->upload->do_upload('sponsors_logo');
//                $file_upload_name = $this->upload->data();
                $fileExt = pathinfo($_FILES["sponsors_logo"]["name"], PATHINFO_EXTENSION);
                print_r($_FILES["sponsors_logo"]["tmp_name"]);
                print_r(FCPATH . "uploads/sponsors/sponsor_logo_{$sponsors_id}.{$fileExt}");
                if (move_uploaded_file($_FILES["sponsors_logo"]["tmp_name"], FCPATH . "uploads/sponsors/sponsor_logo_{$sponsors_id}.{$fileExt}")) {
                    $this->db->update('sponsors', array('sponsors_logo' => "sponsor_logo_{$sponsors_id}.{$fileExt}"), array('sponsors_id' => $sponsors_id));
                } else {
                    exit('Unable to upload the logo, change file permission of /uploads directory to allow writing!');
                }
            }

            if ($_FILES['sponsor_cover']['name'] != "") {
//                $this->load->library('upload');
//                $this->upload->initialize($this->set_upload_options());
//                $this->upload->do_upload('sponsors_logo');
//                $file_upload_name = $this->upload->data();
                $fileExt = pathinfo($_FILES["sponsor_cover"]["name"], PATHINFO_EXTENSION);
                print_r($_FILES["sponsor_cover"]["tmp_name"]);
                print_r(FCPATH . "uploads/sponsors/sponsor_cover_{$sponsors_id}.{$fileExt}");
                if (move_uploaded_file($_FILES["sponsor_cover"]["tmp_name"], FCPATH . "uploads/sponsors/sponsor_cover_{$sponsors_id}.{$fileExt}")) {
                    $this->db->update('sponsors', array('sponsor_cover' => "sponsor_cover_{$sponsors_id}.{$fileExt}"), array('sponsors_id' => $sponsors_id));
                } else {
                    exit('Unable to upload the logo, change file permission of /uploads directory to allow writing!');
                }
            }
            return "1";
        } else {
            return "2";
        }
    }

    function set_upload_options() {
        $this->load->helper('string');
        $randname = random_string('numeric', '8');
        $config = array();
        $config['upload_path'] = './uploads/sponsors/';
        $config['allowed_types'] = 'jpg|png';
        $config['overwrite'] = FALSE;
        $config['file_name'] = "sponsors_" . $randname;
        return $config;
    }

    function generateRandomString($length = 8) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    function updateSponsors() {
        $post = $this->input->post();
        if (!empty($post['sponsors_category'])) {
            $sponsors_category_id = implode(",", $post['sponsors_category']);
        } else {
            $sponsors_category_id = "";
        }
        $set = array(
            'sponsors_category_id' => $sponsors_category_id,
            'twitter_id' => trim($post['twitter_id']),
            'company_name' => trim($post['company_name']),
            'embed_code' => trim($post['embed_code'])
        );
        $this->db->update("sponsors", $set, array("sponsors_id" => $post['sponsors_id']));
        $sponsors_id = $post['sponsors_id'];
        if ($sponsors_id > 0) {
            if ($_FILES['sponsors_logo']['name'] != "") {
                $_FILES['sponsors_logo']['name'] = $_FILES['sponsors_logo']['name'];
                $_FILES['sponsors_logo']['type'] = $_FILES['sponsors_logo']['type'];
                $_FILES['sponsors_logo']['tmp_name'] = $_FILES['sponsors_logo']['tmp_name'];
                $_FILES['sponsors_logo']['error'] = $_FILES['sponsors_logo']['error'];
                $_FILES['sponsors_logo']['size'] = $_FILES['sponsors_logo']['size'];
                $this->load->library('upload');
                $this->upload->initialize($this->set_upload_options());
                $this->upload->do_upload('sponsors_logo');
                $file_upload_name = $this->upload->data();
                $this->db->update('sponsors', array('sponsors_logo' => $file_upload_name['file_name']), array('sponsors_id' => $sponsors_id));
            }
            if ($_FILES['sponsor_cover']['name'] != "") {
//                $this->load->library('upload');
//                $this->upload->initialize($this->set_upload_options());
//                $this->upload->do_upload('sponsors_logo');
//                $file_upload_name = $this->upload->data();
                $fileExt = pathinfo($_FILES["sponsor_cover"]["name"], PATHINFO_EXTENSION);
                print_r($_FILES["sponsor_cover"]["tmp_name"]);
                print_r(FCPATH . "uploads/sponsors/sponsor_cover_{$sponsors_id}.{$fileExt}");
                if (move_uploaded_file($_FILES["sponsor_cover"]["tmp_name"], FCPATH . "uploads/sponsors/sponsor_cover_{$sponsors_id}.{$fileExt}")) {
                    $this->db->update('sponsors', array('sponsor_cover' => "sponsor_cover_{$sponsors_id}.{$fileExt}"), array('sponsors_id' => $sponsors_id));
                } else {
                    exit('Unable to upload the logo, change file permission of /uploads directory to allow writing!');
                }
            }
            return "1";
        } else {
            return "2";
        }
    }

    function delete_sponsors($sponsors_id) {
        $this->db->delete("sponsors", array("sponsors_id" => $sponsors_id));
        return TRUE;
    }

    function get_sponsors_category() {
        $this->db->select('*');
        $this->db->from('sponsors_category');
        $sessions = $this->db->get();
        if ($sessions->num_rows() > 0) {
            return $sessions->result();
        } else {
            return '';
        }
    }

    function updateSponsorName()
    {
        $sponsorId = $this->session->userdata('sponsors_id');
        $post = $this->input->post();
        if (isset($post['name'])) {
            $this->db->set('company_name', $post['name']);
            $this->db->where('sponsors_id', $sponsorId);
            $this->db->update('sponsors');
        }

        return;
    }

    function updateSponsorAbout()
    {
        $sponsorId = $this->session->userdata('sponsors_id');
        $post = $this->input->post();
        if (isset($post['about'])) {
            $this->db->set('about', $post['about']);
            $this->db->where('sponsors_id', $sponsorId);
            $this->db->update('sponsors');
        }

        return;
    }

    function updateSponsorWebsite()
    {
        $sponsorId = $this->session->userdata('sponsors_id');
        $post = $this->input->post();
        if (isset($post['website'])) {
            $this->db->set('website', $post['website']);
            $this->db->where('sponsors_id', $sponsorId);
            $this->db->update('sponsors');
        }

        return;
    }

    function updateSponsorTwitter()
    {
        $sponsorId = $this->session->userdata('sponsors_id');
        $post = $this->input->post();
        if (isset($post['twitter'])) {
            $this->db->set('twitter_id', $post['twitter']);
            $this->db->where('sponsors_id', $sponsorId);
            $this->db->update('sponsors');
        }

        return;
    }

    function updateSponsorFacebook()
    {
        $sponsorId = $this->session->userdata('sponsors_id');
        $post = $this->input->post();
        if (isset($post['facebook'])) {
            $this->db->set('facebook_id', $post['facebook']);
            $this->db->where('sponsors_id', $sponsorId);
            $this->db->update('sponsors');
        }

        return;
    }

    function updateSponsorLinkedin()
    {
        $sponsorId = $this->session->userdata('sponsors_id');
        $post = $this->input->post();
        if (isset($post['linkedin'])) {
            $this->db->set('linkedin_id', $post['linkedin']);
            $this->db->where('sponsors_id', $sponsorId);
            $this->db->update('sponsors');
        }

        return;
    }

}

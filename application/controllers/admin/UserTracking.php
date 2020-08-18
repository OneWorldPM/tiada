<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class UserTracking extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->common->set_timezone();
        $login_type = $this->session->userdata('aname');
        if ($login_type != 'admin') {
            redirect('admin/alogin');
        }
        $this->load->model('user/m_sponsor', 'objsponsor');
    }

    public function index()
    {
        $data['booth_tracking'] = $this->get_booth_tracking();
        $this->load->view('admin/header');
        $this->load->view('admin/user_tracking', $data);
        $this->load->view('admin/footer');
    }

    function get_booth_tracking()
    {
        $this->db->select('s.*, c.*, sp.company_name');
        $this->db->from('view_sponsor_history s');
        $this->db->join('customer_master c', 's.cust_id=c.cust_id');
        $this->db->join('sponsors sp', 's.sponsor_id = sp.sponsors_id');
        $sessions = $this->db->get();
        if ($sessions->num_rows() > 0) {
            return $sessions->result();
        } else {
            return '';
        }
    }

    function getPointsList()
    {
        $query = $this->db->query("SELECT DISTINCT vsh.cust_id, vsh.sponsor_id, vsh.start_date_time as datetime, CONCAT(cm.first_name, ' ', cm.last_name) AS name, s.company_name, s.sponsors_type   
                            FROM  `view_sponsor_history` AS vsh
                            JOIN `customer_master` AS cm ON cm.cust_id = vsh.cust_id
                            JOIN `sponsors` AS s ON s.sponsors_id = vsh.sponsor_id
                            WHERE vsh.action = 'visit' AND vsh.start_date_time LIKE '%2020-08-18%'
                            GROUP BY vsh.cust_id, vsh.sponsor_id");
        if ($query->num_rows() > 0) {

            $points_list = array();
            foreach($query->result() as $item){
                if ($item->sponsors_type == 'platinum'){
                    $pointNumber = 500;
                }elseif($item->sponsors_type == 'gold'){
                    $pointNumber = 150;
                }elseif($item->sponsors_type == 'silver'){
                    $pointNumber = 25;
                }elseif($item->sponsors_type == 'bronze'){
                    $pointNumber = 10;
                }else{
                    $pointNumber = 0;
                }

                if (array_key_exists($item->cust_id, $points_list))
                {
                    $point = $points_list[$item->cust_id]['point']+$pointNumber;

                    $points_list[$item->cust_id] = array(
                        'name' => $item->name,
                        'point' => $point
                    );
                }else{
                    $point = $pointNumber;

                    $points_list[$item->cust_id] = array(
                        'name' => $item->name,
                        'point' => $point
                    );
                }
            }
            $pointsSort = array();
            foreach ($points_list as $key => $row)
            {
                $pointsSort[$key] = $row['point'];
            }
            array_multisort($pointsSort, SORT_DESC, $points_list);
            echo"<pre>"; print_r($points_list);echo"</pre>";
        } else {
            return '';
        }
    }

}

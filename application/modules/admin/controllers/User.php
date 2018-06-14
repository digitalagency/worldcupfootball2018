<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User Controller
 * @user Controller
 * @subuser Controller
 * Date created:August 04, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class User extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('general_model');
        $this->load->library('multiupload');
    }

    public function index(){
    }

    public function deleteUser($pid){

        if (!isset($pid))
            redirect(base_url() . 'admin/User');

        if (!is_numeric($pid))
            redirect(base_url() . 'admin/User');

        $this->User_model->delete_user($pid);
        $this->session->set_flashdata('success', 'User Deleted Successfully...');
        $redirect =base_url() . 'admin/User/registration_numbers/'.$this->uri->segment(5).'/'.$this->uri->segment(6); 
        //echo $redirect;
        redirect($redirect, 'refresh');
    }

    public function removeUser($uid){

        if (!isset($uid))
            redirect(base_url() . 'admin/User/registered/all');

        if (!is_numeric($uid))
            redirect(base_url() . 'admin/User/registered/all');

        $this->User_model->remove_user($uid);
        $this->session->set_flashdata('success', 'User Removed Successfully...');
        $redirect = base_url() . 'admin/User/registered/'.$this->uri->segment(5).'/'.$this->uri->segment(6); 
        redirect($redirect, 'refresh');
    }

    public function registered()
    {
        
        
        $config['base_url'] = base_url() . 'admin/User/registered/';
        $config['uri_segment'] = 4;
        $config['per_page'] = 50;

        /* Bootstrap Pagination  */

        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";

        /* End of Bootstrap Pagination */

        $flag="";
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $total_rows = $this->db->count_all('tbl_participants');
        $config['total_rows'] = $total_rows;
        $data['user_info'] = $this->User_model->get_all_registered_user($config['per_page'], $page,$flag);
        $this->pagination->initialize($config);

        $data['title'] = 'Registered Users';
        $data['page_header'] = 'Registered Participants :: Total number - '.$total_rows;
        $data['page_header_icone'] = 'fa-product-user';
        $data['nav'] = 'User';
        $data['page'] = $page;
        $data['panel_title'] = 'Registered Participant List';
        $data['main'] = 'user_registered';

        $this->load->view('home', $data);
    }

    function get_users(){
        if (isset($_GET['term'])){
          $q = strtolower($_GET['term']);
          $this->User_model->get_user($q);
        }
    }
}

/* End of file User.php
 * Location: ./application/modules/admin/controllers/User.php */
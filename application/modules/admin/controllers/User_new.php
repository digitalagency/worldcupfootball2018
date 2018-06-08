<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User Controller
 * @user Controller
 * @subuser Controller
 * Date created:June 01, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class User extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('general_model');
    }

    public function index(){

        $config['base_url'] = base_url() . 'admin/User';
        $config['uri_segment'] = 3;
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

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        
        $config['total_rows'] = $this->db->count_all('tbl_user');
        $data['user_info'] = $this->User_model->get_all_user($config['per_page'], $page);
        

        $this->pagination->initialize($config);

        $data['title'] = '.:: User ::.';
        $data['page_header'] = 'User';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'User';
        $data['panel_title'] = 'User List';
        $data['main'] = 'user_registration_numbers';
        //$data['organisation_type'] =$this->general_model->getAll('dropdown','fid = 6','','id,dropvalue');

        $this->load->view('home', $data);
    }



    public function registration_numbers($region){

        $config['base_url'] = base_url() . 'admin/User/registration_numbers/'.$region;
        //$config['uri_segment'] = 10;
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

        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

        
        $config['total_rows'] = $this->User_model->count_all_users($region);
        $data['user_info'] = $this->User_model->get_all_user($config['per_page'], $page, $region);
        

        $this->pagination->initialize($config);

        $data['title'] = '.:: User ::.';
        $data['page_header'] = 'User';
        $data['page_header_icone'] = 'fa-users';
        $data['nav'] = 'User';
        $data['panel_title'] = 'User List';
        $data['main'] = 'user_registration_numbers';
        //$data['organisation_type'] =$this->general_model->getAll('dropdown','fid = 6','','id,dropvalue');

        $this->load->view('home', $data);
    }

    public function deleteUser($pid){

        if (!isset($pid))
            redirect(base_url() . 'admin/User');

        if (!is_numeric($pid))
            redirect(base_url() . 'admin/User');

        $this->User_model->delete_user($pid);
        $this->session->set_flashdata('success', 'User Deleted Successfully...');
        redirect(base_url() . 'admin/User', 'refresh');
    }

    public function listAll($pid){

        if (!isset($pid))
            redirect(base_url() . 'admin/User');

        if (!is_numeric($pid))
            redirect(base_url() . 'admin/User');

        $data['title'] = '.:: VIEW User ::.';
        $data['page_header'] = 'View User ';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'User';
        $data['panel_title'] = 'View User  ';
        $data['main'] = 'user_show_list';
        $data['user_info'] = $this->User_model->get_all_by_aid($pid);

        $this->load->view('home', $data);
    }

    public function add(){
        $data['title'] = '.:: ADD User ::.';
        $data['page_header'] = 'User ';
        $data['page_header_icone'] = 'fa-gift';
        $data['nav'] = 'User';
        $data['panel_title'] = 'Add User  '; 
        $order_by = 'id ASC';  
        $data['main'] = 'user_add_edit';
        //echo "lang = ".$this->session->lang;
        $this->load->view('home', $data);
    }

    public function addUser(){

        $this->form_validation->set_rules('user_code', 'user_code', 'required');
        //echo $this->session->lang;
        if (FALSE == $this->form_validation->run()) {
            $data['title'] = '.:: ADD User ::.';
            $data['page_header'] = 'User';
            $data['page_header_icone'] = 'fa-product-hunt';
            $data['nav'] = 'User';
            $data['panel_title'] = 'Add User ';
            
            $data['main'] = 'user_add_edit';

            $this->load->view('home', $data);

        } else {

            $pid = $this->User_model->add_user();
            $this->session->set_flashdata('success', 'User added Successfully...');
            redirect(base_url() . 'admin/User', 'refresh');
        }
    }  

    public function edit($id){

        if (!isset($id))
            redirect(base_url() . 'admin/User');

        if (!is_numeric($id))
            redirect(base_url() . 'admin/User');

        $data['title'] = '.:: EDIT User ::.';
        $data['page_header'] = 'User';
        $data['page_header_icone'] = 'fa-gift';
        $data['nav'] = 'User';
        $data['panel_title'] = 'Edit User ';
        $where = array('parent_id'=>'0');  
        $order_by = 'fullname ASC';  
        $data['user_detail'] = $this->general_model->getById('tbl_user','id',$id);
        $data['main'] = 'user_add_edit';

        $this->load->view('home', $data);
    }

    public function editUser($pid){

        if (!isset($pid))
            redirect(base_url() . 'admin/User');

        if (!is_numeric($pid))
            redirect(base_url() . 'admin/User');

        
        $this->form_validation->set_rules('user_code', 'user_code', 'required');

        if (FALSE == $this->form_validation->run()) {
            $data['title'] = '.:: EDIT User ::.';
            $data['page_header'] = 'User';
            $data['page_header_icone'] = 'fa-gift';
            $data['nav'] = 'User';
            $data['panel_title'] = 'Edit User ';
            $data['User_detail'] = $this->general_model->getById('tbl_user','id',$pid);
            $data['main'] = 'User/edit/'.$pid;

            $this->load->view('home', $data);

        } else {

            $this->User_model->update_user($pid);
            $this->session->set_flashdata('success', 'User Updated Successfully...');
            redirect(base_url() . 'admin/User/edit/'.$pid, 'refresh');
        }
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
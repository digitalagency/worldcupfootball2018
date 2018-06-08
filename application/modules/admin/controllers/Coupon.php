<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Coupon Controller
 * @coupon Controller
 * @subcoupon Controller
 * Date created:June 01, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class Coupon extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Coupon_model');
        $this->load->model('User_model');
        $this->load->model('general_model');
    }

    public function index(){

        $config['base_url'] = base_url() . 'admin/Coupon';
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

        
        $config['total_rows'] = $this->db->count_all('tbl_coupon');
        $data['coupon_info'] = $this->Coupon_model->get_all_coupon($config['per_page'], $page);
        

        $this->pagination->initialize($config);

        $data['title'] = '.:: Coupon ::.';
        $data['page_header'] = 'Coupon';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'Coupon';
        $data['panel_title'] = 'Coupon List';
        $data['main'] = 'coupon_listall';
        //$data['organisation_type'] =$this->general_model->getAll('dropdown','fid = 6','','id,dropvalue');

        $this->load->view('home', $data);
    }



    public function taken(){

        $config['base_url'] = base_url() . 'admin/Coupon/taken';
        //$config['uri_segment'] = 3;
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
        //echo "page number = ".$this->uri->segment(4);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $this->db->where('coupon_status', '1');
        $this->db->from('tbl_coupon');
        $query = $this->db->get();
        $total_rows = $query->num_rows();
        $config['total_rows'] = $total_rows; 
        
        $data['coupon_info'] = $this->Coupon_model->get_all_taken_coupon($config['per_page'], $page);
        

        $this->pagination->initialize($config);

        $data['title'] = '.:: Coupon ::.';
        $data['page_header'] = 'Coupon';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'Coupon';
        $data['panel_title'] = 'Coupon List';
        $data['couponpage'] = 'taken';        
        $data['main'] = 'coupon_listall';
        //$data['organisation_type'] =$this->general_model->getAll('dropdown','fid = 6','','id,dropvalue');

        $this->load->view('home', $data);
    }

    public function deleteCoupon($pid){

        if (!isset($pid))
            redirect(base_url() . 'admin/Coupon');

        if (!is_numeric($pid))
            redirect(base_url() . 'admin/Coupon');

        $this->Coupon_model->delete_coupon($pid);
        $this->session->set_flashdata('success', 'Coupon Deleted Successfully...');
        redirect(base_url() . 'admin/Coupon', 'refresh');
    }

    public function listAll($pid){    

        $config['base_url'] = base_url() . 'admin/Coupon';
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

        
        $config['total_rows'] = $this->db->count_all('tbl_coupon');
        $data['coupon_info'] = $this->Coupon_model->get_all_coupon($config['per_page'], $page);
        

        $this->pagination->initialize($config);

        $data['title'] = '.:: Coupon ::.';
        $data['page_header'] = 'Coupon';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'Coupon';
        $data['panel_title'] = 'Coupon List';
        $data['main'] = 'coupon_listall';
        //$data['organisation_type'] =$this->general_model->getAll('dropdown','fid = 6','','id,dropvalue');

        $this->load->view('home', $data);
    }

    public function add(){
        $data['title'] = '.:: ADD Coupon ::.';
        $data['page_header'] = 'Coupon ';
        $data['page_header_icone'] = 'fa-gift';
        $data['nav'] = 'Coupon';
        $data['panel_title'] = 'Add Coupon  '; 
        $order_by = 'id ASC';  
        $data['main'] = 'coupon_add_edit';
        //echo "lang = ".$this->session->lang;
        $this->load->view('home', $data);
    }

    public function addCoupon(){

        $this->form_validation->set_rules('coupon_code', 'coupon_code', 'required');
        //echo $this->session->lang;
        if (FALSE == $this->form_validation->run()) {
            $data['title'] = '.:: ADD Coupon ::.';
            $data['page_header'] = 'Coupon';
            $data['page_header_icone'] = 'fa-product-hunt';
            $data['nav'] = 'Coupon';
            $data['panel_title'] = 'Add Coupon ';
            
            $data['main'] = 'coupon_add_edit';

            $this->load->view('home', $data);

        } else {

            $pid = $this->Coupon_model->add_coupon();
            $this->session->set_flashdata('success', 'Coupon added Successfully...');
            redirect(base_url() . 'admin/Coupon', 'refresh');
        }
    }  

    public function edit($id){

        if (!isset($id))
            redirect(base_url() . 'admin/Coupon');

        if (!is_numeric($id))
            redirect(base_url() . 'admin/Coupon');

        $data['title'] = '.:: EDIT Coupon ::.';
        $data['page_header'] = 'Coupon';
        $data['page_header_icone'] = 'fa-gift';
        $data['nav'] = 'Coupon';
        $data['panel_title'] = 'Edit Coupon ';
        $where = array('parent_id'=>'0');  
        $order_by = 'fullname ASC';  
        $data['coupon_detail'] = $this->general_model->getById('tbl_coupon','id',$id);
        $data['main'] = 'coupon_add_edit';

        $this->load->view('home', $data);
    }

    public function editCoupon($pid){

        if (!isset($pid))
            redirect(base_url() . 'admin/Coupon');

        if (!is_numeric($pid))
            redirect(base_url() . 'admin/Coupon');

        
        $this->form_validation->set_rules('coupon_code', 'coupon_code', 'required');

        if (FALSE == $this->form_validation->run()) {
            $data['title'] = '.:: EDIT Coupon ::.';
            $data['page_header'] = 'Coupon';
            $data['page_header_icone'] = 'fa-gift';
            $data['nav'] = 'Coupon';
            $data['panel_title'] = 'Edit Coupon ';
            $data['Coupon_detail'] = $this->general_model->getById('tbl_coupon','id',$pid);
            $data['main'] = 'Coupon/edit/'.$pid;

            $this->load->view('home', $data);

        } else {

            $this->Coupon_model->update_coupon($pid);
            $this->session->set_flashdata('success', 'Coupon Updated Successfully...');
            redirect(base_url() . 'admin/Coupon/edit/'.$pid, 'refresh');
        }
    }

    function get_coupons(){
        if (isset($_GET['term'])){
          $q = strtolower($_GET['term']);
          $this->Coupon_model->get_coupon($q);
        }
    }
}

/* End of file Coupon.php
 * Location: ./application/modules/admin/controllers/Coupon.php */
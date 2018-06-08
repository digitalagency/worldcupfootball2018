<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Region Controller
 * @region Controller
 * @subregion Controller
 * Date created:August 04, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class Region extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Region_model');
        $this->load->model('general_model');
    }

    public function index(){

        $config['base_url'] = base_url() . 'admin/Region';
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

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        
        $config['total_rows'] = $this->db->count_all('tbl_region');
        $data['region_info'] = $this->Region_model->get_all_region($config['per_page'], $page);
        

        $this->pagination->initialize($config);

        $data['title'] = '.:: Region ::.';
        $data['page_header'] = 'Region';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'Region';
        $data['panel_title'] = 'Region List';
        $data['main'] = 'region_registration_numbers';
        //$data['organisation_type'] =$this->general_model->getAll('dropdown','fid = 6','','id,dropvalue');

        $this->load->view('home', $data);
    }

    public function deleteRegion($pid){

        if (!isset($pid))
            redirect(base_url() . 'admin/Region');

        if (!is_numeric($pid))
            redirect(base_url() . 'admin/Region');

        $this->Region_model->delete_region($pid);
        $this->session->set_flashdata('success', 'Region Deleted Successfully...');
        redirect(base_url() . 'admin/Region', 'refresh');
    }

    public function registered($region)
    {
        $config['base_url'] = base_url() . 'admin/Region/registered/'.$this->uri->segment(4);
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

        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
        //echo $page;
        
        $config['total_rows'] = $this->Region_model->count_all_registered_region($region);
        //echo $this->Region_model->count_all_registered_region($region);
        $data['region_info'] = $this->Region_model->get_all_registered_region($config['per_page'], $page,$region);
        

        $this->pagination->initialize($config);

        $data['title'] = '.:: Region ::.';
        $data['page_header'] = 'Region';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'Region';
        $data['panel_title'] = 'Region List';
        $data['main'] = 'region_listall';
        //$data['organisation_type'] =$this->general_model->getAll('dropdown','fid = 6','','id,dropvalue');

        $this->load->view('home', $data);
    }

    public function registration_numbers($region){

        $config['base_url'] = base_url() . 'admin/Region/registration_numbers/'.$region;
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

        
        $config['total_rows'] = $this->Region_model->count_all_regions($region);
        $data['region_info'] = $this->Region_model->get_all_region($config['per_page'], $page, $region);
        

        $this->pagination->initialize($config);

        $data['title'] = '.:: Region ::.';
        $data['page_header'] = 'Region';
        $data['page_header_icone'] = 'fa-regions';
        $data['nav'] = 'Region';
        $data['panel_title'] = 'Region List';
        $data['main'] = 'region_registration_numbers';
        //$data['organisation_type'] =$this->general_model->getAll('dropdown','fid = 6','','id,dropvalue');

        $this->load->view('home', $data);
    }

    public function listAll($pid){

        if (!isset($pid))
            redirect(base_url() . 'admin/Region');

        if (!is_numeric($pid))
            redirect(base_url() . 'admin/Region');

        $data['title'] = '.:: VIEW Region ::.';
        $data['page_header'] = 'View Region ';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'Region';
        $data['panel_title'] = 'View Region  ';
        $data['main'] = 'region_show_list';
        $data['region_info'] = $this->Region_model->get_all_by_aid($pid);

        $this->load->view('home', $data);
    }

    public function add(){
        $data['title'] = '.:: ADD Region ::.';
        $data['page_header'] = 'Region ';
        $data['page_header_icone'] = 'fa-gift';
        $data['nav'] = 'Region';
        $data['panel_title'] = 'Add Region  '; 
        $order_by = 'id ASC';  
        $data['main'] = 'region_add_edit';
        //echo "lang = ".$this->session->lang;
        $this->load->view('home', $data);
    }

    public function addRegion(){

        $this->form_validation->set_rules('region_code', 'region_code', 'required');
        //echo $this->session->lang;
        if (FALSE == $this->form_validation->run()) {
            $data['title'] = '.:: ADD Region ::.';
            $data['page_header'] = 'Region';
            $data['page_header_icone'] = 'fa-product-hunt';
            $data['nav'] = 'Region';
            $data['panel_title'] = 'Add Region ';
            
            $data['main'] = 'region_add_edit';

            $this->load->view('home', $data);

        } else {

            $pid = $this->Region_model->add_region();
            $this->session->set_flashdata('success', 'Region added Successfully...');
            redirect(base_url() . 'admin/Region', 'refresh');
        }
    }  

    public function edit($id){

        if (!isset($id))
            redirect(base_url() . 'admin/Region');

        if (!is_numeric($id))
            redirect(base_url() . 'admin/Region');

        $data['title'] = '.:: EDIT Region ::.';
        $data['page_header'] = 'Region';
        $data['page_header_icone'] = 'fa-Region';
        $data['nav'] = 'Region';
        $data['panel_title'] = 'Edit Region ';
        $where = array('parent_id'=>'0'); 
        $orderBy = array('region ASC'); 
        $data['main_region'] = $this->general_model->getAll('tbl_regions',$where);
        //getAll($table, $where = NULL, $orderBy = NULL, $select = NULL, $group_by = NULL,$limit = NULL) {
        $order_by = 'fullname ASC';  

        $data['region_detail'] = $this->general_model->getById('tbl_region','id',$id);
        $data['main'] = 'region_add_edit';

        $this->load->view('home', $data);
    }

    public function editRegion($pid){

        if (!isset($pid))
            redirect(base_url() . 'admin/Region');

        if (!is_numeric($pid))
            redirect(base_url() . 'admin/Region');

        
        $this->form_validation->set_rules('region_code', 'region_code', 'required');

        if (FALSE == $this->form_validation->run()) {
            $data['title'] = '.:: EDIT Region ::.';
            $data['page_header'] = 'Region';
            $data['page_header_icone'] = 'fa-gift';
            $data['nav'] = 'Region';
            $data['panel_title'] = 'Edit Region ';
            $data['Region_detail'] = $this->general_model->getById('tbl_region','id',$pid);
            $data['main'] = 'Region/edit/'.$pid;

            $this->load->view('home', $data);

        } else {

            $this->Region_model->update_region($pid);
            $this->session->set_flashdata('success', 'Region Updated Successfully...');
            redirect(base_url() . 'admin/Region/edit/'.$pid, 'refresh');
        }
    }

    function get_regions(){
        if (isset($_GET['term'])){
          $q = strtolower($_GET['term']);
          $this->Region_model->get_region($q);
        }
    }
}

/* End of file Region.php
 * Location: ./application/modules/admin/controllers/Region.php */
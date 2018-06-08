<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Match Controller
 * @match Controller
 * @submatch Controller
 * Date created:June 01, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class Match extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Match_model');
        $this->load->model('Country_model');
        $this->load->model('general_model');
    }

    public function index(){

        $config['base_url'] = base_url() . 'admin/Match';
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

        
        $config['total_rows'] = $this->db->count_all('tbl_match');
        $data['match_info'] = $this->Match_model->get_all_match($config['per_page'], $page);
        

        $this->pagination->initialize($config);

        $data['title'] = '.:: Match ::.';
        $data['page_header'] = 'Match';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'Match';
        $data['panel_title'] = 'Match List';
        $data['main'] = 'match_listall';

        $this->load->view('home', $data);
    }

    public function listAll(){    
        if(isset($_POST['match_id']))
        {
            $this->Match_model->update_match($_POST['match_id']);            
            $this->session->set_flashdata('success', 'Match Information Updated Successfully.');          
        }
        
        $config['base_url'] = base_url() . 'admin/Match/listAll';
        $config['uri_segment'] = 4;
        $config['per_page'] = 16;

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

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        
        $config['total_rows'] = $this->db->count_all('tbl_match');
        $data['match_info'] = $this->Match_model->get_all_match($config['per_page'], $page);
        

        $this->pagination->initialize($config);

        $data['title'] = '.:: Match ::.';
        $data['page_header'] = 'Match';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'Match';
        $data['panel_title'] = 'Match List';
        $data['main'] = 'match_listall';
        //$data['organisation_type'] =$this->general_model->getAll('dropdown','fid = 6','','id,dropvalue');
        $data['countries'] = $this->Country_model->get_all_countries();
        $this->load->view('home', $data);
    }

    public function add(){
        $data['title'] = '.:: ADD Match ::.';
        $data['page_header'] = 'Match ';
        $data['page_header_icone'] = 'fa-gift';
        $data['nav'] = 'Match';
        $data['panel_title'] = 'Add Match  '; 
        $order_by = 'id ASC';  
        $data['main'] = 'match_add_edit';
        //echo "lang = ".$this->session->lang;
        $this->load->view('home', $data);
    }

    public function addMatch(){

        $this->form_validation->set_rules('match_code', 'match_code', 'required');
        //echo $this->session->lang;
        if (FALSE == $this->form_validation->run()) {
            $data['title'] = '.:: ADD Match ::.';
            $data['page_header'] = 'Match';
            $data['page_header_icone'] = 'fa-product-hunt';
            $data['nav'] = 'Match';
            $data['panel_title'] = 'Add Match ';
            
            $data['main'] = 'match_add_edit';

            $this->load->view('home', $data);

        } else {

            $pid = $this->Match_model->add_match();
            $this->session->set_flashdata('success', 'Match added Successfully...');
            redirect(base_url() . 'admin/Match', 'refresh');
        }
    } 

    public function addMatchTemp()
    {
        $this->Match_model->add_all_match_questions();
    } 

    public function edit($id){

        if (!isset($id))
            redirect(base_url() . 'admin/Match');

        if (!is_numeric($id))
            redirect(base_url() . 'admin/Match');

        $data['title'] = '.:: EDIT Match ::.';
        $data['page_header'] = 'Match';
        $data['page_header_icone'] = 'fa-gift';
        $data['nav'] = 'Match';
        $data['panel_title'] = 'Edit Match ';
        $where = array('parent_id'=>'0');  
        $order_by = 'fullname ASC';  
        $data['match_detail'] = $this->general_model->getById('tbl_match','id',$id);
        $data['main'] = 'match_add_edit';

        $this->load->view('home', $data);
    }

    public function editMatch($pid){

        if (!isset($pid))
            redirect(base_url() . 'admin/Match');

        if (!is_numeric($pid))
            redirect(base_url() . 'admin/Match');

        
        $this->form_validation->set_rules('match_code', 'match_code', 'required');

        if (FALSE == $this->form_validation->run()) {
            $data['title'] = '.:: EDIT Match ::.';
            $data['page_header'] = 'Match';
            $data['page_header_icone'] = 'fa-gift';
            $data['nav'] = 'Match';
            $data['panel_title'] = 'Edit Match ';
            $data['Match_detail'] = $this->general_model->getById('tbl_match','id',$pid);
            $data['main'] = 'Match/edit/'.$pid;

            $this->load->view('home', $data);

        } else {

            $this->Match_model->update_match($pid);
            $this->session->set_flashdata('success', 'Match Updated Successfully...');
            redirect(base_url() . 'admin/Match/edit/'.$pid, 'refresh');
        }
    }

    function get_matchs(){
        if (isset($_GET['term'])){
          $q = strtolower($_GET['term']);
          $this->Match_model->get_match($q);
        }
    }
}

/* End of file Match.php
 * Location: ./application/modules/admin/controllers/Match.php */
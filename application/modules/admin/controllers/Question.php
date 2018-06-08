<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Question Controller
 * @question Controller
 * @subquestion Controller
 * Date created:June 01, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class Question extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Question_model');
        $this->load->model('Match_model');
        $this->load->model('Country_model');
        $this->load->model('general_model');
    }

    public function index(){

        $config['base_url'] = base_url() . 'admin/Question';
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

        
        $config['total_rows'] = $this->db->count_all('tbl_questions');
        $data['question_info'] = $this->Question_model->get_all_question($config['per_page'], $page);
        

        $this->pagination->initialize($config);

        $data['title'] = '.:: Question ::.';
        $data['page_header'] = 'Question';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'Question';
        $data['panel_title'] = 'Question List';
        $data['main'] = 'question_listall';
        //$data['organisation_type'] =$this->general_model->getAll('dropdown','fid = 6','','id,dropvalue');

        $this->load->view('home', $data);
    }



    public function MatchDayContest(){

        $config['base_url'] = base_url() . 'admin/Question/MatchDayContest';
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

        
        $config['total_rows'] = $this->db->count_all('tbl_match');
        $data['match_info'] = $this->Match_model->get_all_match($config['per_page'], $page);        

        $this->pagination->initialize($config);

        $data['title'] = '.:: Match Day Contest ::.';
        $data['page_header'] = 'Match Day Contest';
        $data['page_header_icone'] = 'fa-question';
        $data['nav'] = 'Question';
        $data['panel_title'] = 'Question List';
        $data['questionpage'] = 'taken';        
        $data['main'] = 'matchdaycontest_listall';
        //$data['organisation_type'] =$this->general_model->getAll('dropdown','fid = 6','','id,dropvalue');

        $this->load->view('home', $data);
    }

    function MatchDayContestAnswer($match_id)
    {
        $match_info = $this->Match_model->get_match_by_id($match_id);
        //print_r($match_info);
        $team_1 = $this->Country_model->get_country_name($match_info['0']->team_1);
        $team_2 = $this->Country_model->get_country_name($match_info['0']->team_2);
        

        if(isset($_POST['question_id_1']))
        {
            $this->Question_model->updateAnswers();
            $this->session->set_flashdata('success', 'Answer Updated Successfully...');
            redirect(base_url() . 'admin/Question/MatchDayContestAnswer/'.$match_id, 'refresh');
        }

        $data['title'] = '.:: Match Day Contest Answer ::.';
        $data['page_header'] = 'Match Day Contest Answer for '.$team_1.' VS '.$team_2.' / Match Date : '.$match_info['0']->match_date;
        $data['page_header_icone'] = 'fa-question';
        $data['nav'] = 'Question';
        $data['panel_title'] = 'Question List';
        $data['main'] = 'matchdaycontest_answer';
        $data['match_id'] = $match_id;
        $data['match_question'] =$this->general_model->getAll('tbl_questions','match_id = '.$match_id,'','id,question_number,question,answer');

        $this->load->view('home', $data);
    }

    public function TheUltimateContest(){

        $config['base_url'] = base_url() . 'admin/Question/TheUltimateContest';
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

        $this->db->where('contest_type', '1');
        $this->db->from('tbl_questions');
        $query = $this->db->get();
        $total_rows = $query->num_rows();
        $config['total_rows'] = $total_rows; 
        
        //$data['question_info'] = $this->Question_model->get_all_match_day_questions($config['per_page'], $page);
        

        $this->pagination->initialize($config);

        $data['title'] = '.:: The Ultimate Contest  ::.';
        $data['page_header'] = 'The Ultimate Contest';
        $data['page_header_icone'] = 'fa-question ';
        $data['nav'] = 'Question';
        $data['panel_title'] = 'Question List';
        $data['questionpage'] = 'taken';        
        $data['main'] = 'theultimatecontest_listall';
        //$data['organisation_type'] =$this->general_model->getAll('dropdown','fid = 6','','id,dropvalue');

        $this->load->view('home', $data);
    }

    public function AllTimeContest(){

        $config['base_url'] = base_url() . 'admin/Question/AllTimeContest';
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

        $this->db->where('contest_type', '1');
        $this->db->from('tbl_questions');
        $query = $this->db->get();
        $total_rows = $query->num_rows();
        $config['total_rows'] = $total_rows; 
        
        //$data['question_info'] = $this->Question_model->get_all_match_day_questions($config['per_page'], $page);
        

        $this->pagination->initialize($config);

        $data['title'] = '.:: All Time Contest ::.';
        $data['page_header'] = 'All Time Contest';
        $data['page_header_icone'] = 'fa-question';
        $data['nav'] = 'Question';
        $data['panel_title'] = 'Question List';
        $data['questionpage'] = 'taken';        
        $data['main'] = 'alltimecontest_listall';
        //$data['organisation_type'] =$this->general_model->getAll('dropdown','fid = 6','','id,dropvalue');

        $this->load->view('home', $data);

    }

    public function deleteQuestion($pid){

        if (!isset($pid))
            redirect(base_url() . 'admin/Question');

        if (!is_numeric($pid))
            redirect(base_url() . 'admin/Question');

        $this->Question_model->delete_question($pid);
        $this->session->set_flashdata('success', 'Question Deleted Successfully...');
        redirect(base_url() . 'admin/Question', 'refresh');
    }

    public function listAll($pid){    

        $config['base_url'] = base_url() . 'admin/Question';
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

        
        $config['total_rows'] = $this->db->count_all('tbl_question');
        $data['question_info'] = $this->Question_model->get_all_question($config['per_page'], $page);
        

        $this->pagination->initialize($config);

        $data['title'] = '.:: Question ::.';
        $data['page_header'] = 'Question';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'Question';
        $data['panel_title'] = 'Question List';
        $data['main'] = 'question_listall';
        //$data['organisation_type'] =$this->general_model->getAll('dropdown','fid = 6','','id,dropvalue');

        $this->load->view('home', $data);
    }

    public function add(){
        $data['title'] = '.:: ADD Question ::.';
        $data['page_header'] = 'Question ';
        $data['page_header_icone'] = 'fa-gift';
        $data['nav'] = 'Question';
        $data['panel_title'] = 'Add Question  '; 
        $order_by = 'id ASC';  
        $data['main'] = 'question_add_edit';
        //echo "lang = ".$this->session->lang;
        $this->load->view('home', $data);
    }

    public function addQuestion(){

        $this->form_validation->set_rules('question_code', 'question_code', 'required');
        //echo $this->session->lang;
        if (FALSE == $this->form_validation->run()) {
            $data['title'] = '.:: ADD Question ::.';
            $data['page_header'] = 'Question';
            $data['page_header_icone'] = 'fa-product-hunt';
            $data['nav'] = 'Question';
            $data['panel_title'] = 'Add Question ';
            
            $data['main'] = 'question_add_edit';

            $this->load->view('home', $data);

        } else {

            $pid = $this->Question_model->add_question();
            $this->session->set_flashdata('success', 'Question added Successfully...');
            redirect(base_url() . 'admin/Question', 'refresh');
        }
    }  

    public function edit($id){

        if (!isset($id))
            redirect(base_url() . 'admin/Question');

        if (!is_numeric($id))
            redirect(base_url() . 'admin/Question');

        $data['title'] = '.:: EDIT Question ::.';
        $data['page_header'] = 'Question';
        $data['page_header_icone'] = 'fa-gift';
        $data['nav'] = 'Question';
        $data['panel_title'] = 'Edit Question ';
        $where = array('parent_id'=>'0');  
        $order_by = 'fullname ASC';  
        $data['question_detail'] = $this->general_model->getById('tbl_question','id',$id);
        $data['main'] = 'question_add_edit';

        $this->load->view('home', $data);
    }

    public function editQuestion($pid){

        if (!isset($pid))
            redirect(base_url() . 'admin/Question');

        if (!is_numeric($pid))
            redirect(base_url() . 'admin/Question');

        
        $this->form_validation->set_rules('question_code', 'question_code', 'required');

        if (FALSE == $this->form_validation->run()) {
            $data['title'] = '.:: EDIT Question ::.';
            $data['page_header'] = 'Question';
            $data['page_header_icone'] = 'fa-gift';
            $data['nav'] = 'Question';
            $data['panel_title'] = 'Edit Question ';
            $data['Question_detail'] = $this->general_model->getById('tbl_question','id',$pid);
            $data['main'] = 'Question/edit/'.$pid;

            $this->load->view('home', $data);

        } else {

            $this->Question_model->update_question($pid);
            $this->session->set_flashdata('success', 'Question Updated Successfully...');
            redirect(base_url() . 'admin/Question/edit/'.$pid, 'refresh');
        }
    }

    function get_questions(){
        if (isset($_GET['term'])){
          $q = strtolower($_GET['term']);
          $this->Question_model->get_question($q);
        }
    }
}

/* End of file Question.php
 * Location: ./application/modules/admin/controllers/Question.php */
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
        $data['active'] = 'MatchDayContest';
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
        

        if(isset($_POST['question_id_1']))
        {
            $this->Question_model->updateUltimateContestAnswers();
            $this->session->set_flashdata('success', 'Answer Updated Successfully...');
            redirect(base_url() . 'admin/Question/TheUltimateContest/', 'refresh');
        }

        $data['title'] = '.:: The Ultimate Contest  ::.';
        $data['page_header'] = 'The Ultimate Contest';
        $data['page_header_icone'] = 'fa-question ';
        $data['nav'] = 'Question';
        $data['active'] = 'TheUltimateContest';
        $data['panel_title'] = 'Question List';
        $data['questionpage'] = 'taken';        
        $data['main'] = 'theultimatecontest_listall';
        $data['question_info'] = $this->Question_model->get_all_ultimate_contest_questions();

        $this->load->view('home', $data);
    }

    public function AllTimeContest(){

        $data['title'] = '.:: All Time Contest ::.';
        $data['page_header'] = 'All Time Contest';
        $data['page_header_icone'] = 'fa-question';
        $data['nav'] = 'Question';
        $data['panel_title'] = 'Question List';
        $data['questionpage'] = 'taken';        
        $data['main'] = 'alltimecontest_listall';
        $data['question_info'] = $this->Question_model->get_all_time_contest_questions();
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
        $data['page_header_icone'] = 'fa-question';
        $data['nav'] = 'Question';
        $data['active'] = 'AllTimeContest';
        $data['panel_title'] = 'Add Question  '; 
        $order_by = 'id ASC';  
        $data['main'] = 'question_add_edit';
        //echo "lang = ".$this->session->lang;
        $this->load->view('home', $data);
    }

    public function addQuestionProcess(){
        $contest_type = $this->uri->segment(4);
        $qid = $this->Question_model->add_question($contest_type);
        if($qid>0)
        {
            $this->session->set_flashdata('success', 'All Time Contest Question added Successfully...');
            redirect(base_url() . 'admin/Question/AllTimeContest', 'refresh');
        }
    }  

    public function edit(){
        $id = $this->uri->segment(5);
        if (!isset($id))
            redirect(base_url() . 'admin/Question/AllTimeContest');

        if (!is_numeric($id))
            redirect(base_url() . 'admin/Question/AllTimeContest');

        $data['title'] = '.:: EDIT Question ::.';
        $data['page_header'] = 'Question';
        $data['page_header_icone'] = 'fa-question';
        $data['nav'] = 'Question';
        $data['active'] = 'AllTimeContest';
        $data['panel_title'] = 'Edit Question ';  
        $data['question_detail'] = $this->general_model->getById('tbl_questions','id',$id);
        $data['main'] = 'question_add_edit';

        $this->load->view('home', $data);
    }

    public function editQuestionProcess(){
        $qid = $this->uri->segment(5);

        if (!isset($qid))
            redirect(base_url() . 'admin/Question/AllTimeContest');

        if (!is_numeric($qid))
            redirect(base_url() . 'admin/Question/AllTimeContest');        

        $status = $this->Question_model->update_question($qid);
        if($status>0)
        {
            $this->session->set_flashdata('success', 'All Time Contest Question Updated Successfully...');
            redirect(base_url() . 'admin/Question/edit/3/'.$qid, 'refresh');
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
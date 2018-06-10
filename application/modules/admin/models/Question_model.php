<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Question Model
 * @question Model
 * @subquestion Model
 * Date created:August 8, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class question_model extends CI_Model {

    private $table_question = 'tbl_questions';

    public function __construct() {
        parent::__construct();
    }    

    public function get_all_question($limit,$offset){
        $this->db->select('*');
        $this->db->order_by("id","ASC");
        $query =  $this->db->get($this->table_question,$limit,$offset);
        //echo "SELECT * FROM ".$this->table_question." LIMIT ".$limit.", ".$offset;
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_field_by_id($field,$cid){
        $this->db->select($field);
        $this->db->where('id',$cid);
        $q = $this->db->get($this->table_question);
        $data1 = $q->result_array();
        $data = array_shift($data1);
        return $data[$field];
    }

    public function get_all_field($id){
        $this->db->select();
        $this->db->where('aid',$id);
        $query = $this->db->get($this->table_question);  
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function delete_question($id){
        $this->db->where('id',$id);
        $this->db->delete($this->table_question);
    }

    public function add_question($contest_type){
        $data = array(
            'contest_type' => $contest_type,
            'datetime' => $this->input->post('question_date'),            
            'question' => $this->input->post('question'),
            'answer' => $this->input->post('answer'),
            'option_1' => $this->input->post('option_1'),
            'option_2' => $this->input->post('option_2'),
            'option_3' => $this->input->post('option_3')
        );
        $this->db->insert($this->table_question,$data);
        $qid = $this->db->insert_id(); 
        return $qid;       
    }

    public function update_question($qid){
        $data = array(
            'datetime' => $this->input->post('question_date'),
            'question' => $this->input->post('question'),
            'answer' => $this->input->post('answer'),
            'option_1' => $this->input->post('option_1'),
            'option_2' => $this->input->post('option_2'),
            'option_3' => $this->input->post('option_3')
        );
        $this->db->where('id',$qid);
        if($this->db->update($this->table_question,$data))
            return '1';
        else
            return '0';
    }

    function updateAnswers()
    {
        for($i=1;$i<=4;$i++)
        {
            $question_id = $_POST['question_id_'.$i];
            $answer = $_POST['answer_'.$i];
            //echo $question_id.' -- '.$answer.'<br>';
            $data = array(
              'answer' => $answer
            );
            $this->db->where('id',$question_id);
            $this->db->update($this->table_question,$data);
        }
    }

    function updateUltimateContestAnswers()
    {
        for($i=1;$i<=5;$i++)
        {
            $question_id = $_POST['question_id_'.$i];
            if($i==2 && isset($_POST['answer_'.$i]['0']) && isset($_POST['answer_'.$i]['1']))
            {                
                $answer = $_POST['answer_'.$i]['0'].','.$_POST['answer_'.$i]['1'];
            }
            else
                $answer = $_POST['answer_'.$i];
            //echo $question_id.' -- '.$answer.'<br>';
            $data = array(
              'answer' => $answer
            );
            $this->db->where('id',$question_id);
            $this->db->update($this->table_question,$data);
        }
    }

    function get_all_ultimate_contest_questions(){
        $this->db->select();
        $this->db->where('contest_type', '2');
        $query = $this->db->get($this->table_question);  
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    function get_all_time_contest_questions(){
        $this->db->select();
        $this->db->where('contest_type', '3');
        $query = $this->db->get($this->table_question);  
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    function get_question($q){
        $this->db->select('*');
        $this->db->like('question_code', $q,'after');
        //$this->db->like('prize_details', $q,'after');
        $query = $this->db->get('tbl_question');
        if($query->num_rows() > 0){
          foreach ($query->result_array() as $row){
            $new_row['label']=htmlentities(stripslashes($row['question_code']));
            $new_row['value']=htmlentities(stripslashes($row['question_code']));
            $new_row['the_link']=base_url()."admin/Question/edit/".$row['id'];
            $row_set[] = $new_row; //build an array
          }
          echo json_encode($row_set); //format the array into json data
        }
    }

}

/* End of file Question_model.php
 * Location: ./application/modules/admin/models/Question_model.php */
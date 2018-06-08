<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Coupon Model
 * @match Model
 * @submatch Model
 * Date created:August 8, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class match_model extends CI_Model {

    private $table_match = 'tbl_match';

    public function __construct() {
        parent::__construct();
    }    

    public function get_all_match($limit,$offset){
        $this->db->select('*');
        $this->db->order_by("id","ASC");
        $query =  $this->db->get($this->table_match,$limit,$offset);
        //echo "SELECT * FROM ".$this->table_match." LIMIT ".$limit.", ".$offset;
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }   

    public function get_all_taken_match($limit,$offset){
        $this->db->select('tbl_match.*,tu.full_name,tu.registration_number');
        $this->db->join('tbl_user tu', 'tu.registration_number = tbl_match.user_id');
        $this->db->where("tbl_match.match_status","1");
        $this->db->order_by("tbl_match.id","ASC");
        $query =  $this->db->get($this->table_match,$limit,$offset);
        //echo "SELECT * FROM ".$this->table_match." LIMIT ".$limit.", ".$offset;
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_field_by_id($field,$cid){
        $this->db->select($field);
        $this->db->where('id',$cid);
        $q = $this->db->get($this->table_match);
        $data1 = $q->result_array();
        $data = array_shift($data1);
        return $data[$field];
    }

    public function get_all_field($id){
        $this->db->select();
        $this->db->where('aid',$id);
        $query = $this->db->get($this->table_match);  
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_match_by_id($match_id){
        $this->db->select();
        $this->db->where('id',$match_id);
        $query = $this->db->get($this->table_match);  
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function delete_match($id){
        $this->db->where('id',$id);
        $this->db->delete($this->table_match);
    }

    public function add_match(){
        $data = array(
            'match_code' => $this->input->post('match_code'),
            'prize_details' => $this->input->post('prize_details')
        );
        $this->db->insert($this->table_match,$data);
        $cid = $this->db->insert_id();        
    }

    public function add_all_match_questions(){
        
        for($i=1;$i<=64;$i++)
        {         
            $q_array = array('Which country will win the match ?','What will be the final score of the match ?','Which team will score the first goal ?','Which player will score the first goal ?');
            $k=1;
            for($j=0;$j<count($q_array);$j++)
            {
                $data = array(
                    'contest_type' => '1',
                    'match_id' => $i,
                    'question_number' => $k,
                    'question' => $q_array[$j]
                );
                $this->db->insert('tbl_questions',$data);
                $k++;
            }   
        }
    }

    public function update_match($match_id){
        $data = array(
          'match_date' => $this->input->post('match_date'),
          'team_1' => $this->input->post('team_1'),
          'team_1_goal' => $this->input->post('team_1_goal'),
          'team_2' => $this->input->post('team_2'),
          'team_2_goal' => $this->input->post('team_2_goal'),
          'winner' => $this->input->post('winner')
        );
        $this->db->where('id',$match_id);
        $this->db->update($this->table_match,$data);
        //echo $this->db->last_query();
    }

    function get_match($q){
        $this->db->select('*');
        $this->db->like('match_code', $q,'after');
        //$this->db->like('prize_details', $q,'after');
        $query = $this->db->get('tbl_match');
        if($query->num_rows() > 0){
          foreach ($query->result_array() as $row){
            $new_row['label']=htmlentities(stripslashes($row['match_code']));
            $new_row['value']=htmlentities(stripslashes($row['match_code']));
            $new_row['the_link']=base_url()."admin/Coupon/edit/".$row['id'];
            $row_set[] = $new_row; //build an array
          }
          echo json_encode($row_set); //format the array into json data
        }
    }

}

/* End of file Coupon_model.php
 * Location: ./application/modules/admin/models/Coupon_model.php */
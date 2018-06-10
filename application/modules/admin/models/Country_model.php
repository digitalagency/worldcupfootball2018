<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Coupon Model
 * @country Model
 * @subcountry Model
 * Date created:August 8, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class country_model extends CI_Model {

    private $table_country = 'tbl_country';

    public function __construct() {
        parent::__construct();
    }    

    public function get_all_country($limit,$offset){
        $this->db->select('*');
        $this->db->order_by("country_name","ASC");
        $query =  $this->db->get($this->table_country,$limit,$offset);
        //echo "SELECT * FROM ".$this->table_country." LIMIT ".$limit.", ".$offset;
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }    

    public function get_all_countries(){
        $this->db->select('*');
        $this->db->order_by("country_name","ASC");
        $query =  $this->db->get($this->table_country);
        //echo "SELECT * FROM ".$this->table_country." LIMIT ".$limit.", ".$offset;
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_field_by_id($field,$cid){
        $this->db->select($field);
        $this->db->where('id',$cid);
        $q = $this->db->get($this->table_country);
        $data1 = $q->result_array();
        $data = array_shift($data1);
        return $data[$field];
    }

    public function get_all_field($id){
        $this->db->select();
        $this->db->where('aid',$id);
        $query = $this->db->get($this->table_country);  
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    function get_country_name($country_id)
    {        
        $this->db->select('country_name');
        $this->db->where('id',$country_id);
        $q = $this->db->get('tbl_country');
        $data1 = $q->result_array();
        $data = array_shift($data1);
        return $data['country_name'];
    }

    public function delete_country($id){
        $this->db->where('id',$id);
        $this->db->delete($this->table_country);
    }

    public function add_country(){
        $data = array(
            'country_name' => $this->input->post('country_name')
        );
        $this->db->insert($this->table_country,$data);
        $cid = $this->db->insert_id();        
    }

    public function update_country($cid){
        $data = array(
          'country_name' => $this->input->post('country_name')
        );
        $this->db->where('id',$cid);
        $this->db->update($this->table_country,$data);
    }

    public function add_player(){
        $data = array(
            'country_id' => $this->input->post('country_id'),
            'player_name' => $this->input->post('player_name')
        );
        $this->db->insert('tbl_players',$data);
        $cid = $this->db->insert_id();        
    }

    public function update_player($player_id){
        $data = array(
            'country_id' => $this->input->post('country_id'),
            'player_name' => $this->input->post('player_name')
        );
        $this->db->where('id',$player_id);
        $this->db->update('tbl_players',$data);
        $cid = $this->db->insert_id();        
    }

    public function delete_player($pid){
        $this->db->where('id',$pid);
        $this->db->delete('tbl_players');
    }

    function get_player_info($player_id)
    {
        $this->db->select();
        $this->db->where('id',$player_id);
        $query = $this->db->get('tbl_players');  
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        } 
    }

    function get_players()
    {
        $this->db->select();
        $query = $this->db->get('tbl_players');  
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }        
    }

    function get_all_players($country_id)
    {
        $this->db->select();
        $this->db->where('country_id',$country_id);
        $query = $this->db->get('tbl_players');  
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }        
    }

    function get_country($q){
        $this->db->select('*');
        $this->db->like('country_code', $q,'after');
        //$this->db->like('prize_details', $q,'after');
        $query = $this->db->get('tbl_country');
        if($query->num_rows() > 0){
          foreach ($query->result_array() as $row){
            $new_row['label']=htmlentities(stripslashes($row['country_code']));
            $new_row['value']=htmlentities(stripslashes($row['country_code']));
            $new_row['the_link']=base_url()."admin/Coupon/edit/".$row['id'];
            $row_set[] = $new_row; //build an array
          }
          echo json_encode($row_set); //format the array into json data
        }
    }

}

/* End of file Coupon_model.php
 * Location: ./application/modules/admin/models/Coupon_model.php */
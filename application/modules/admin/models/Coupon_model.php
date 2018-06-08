<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Coupon Model
 * @coupon Model
 * @subcoupon Model
 * Date created:August 8, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class coupon_model extends CI_Model {

    private $table_coupon = 'tbl_coupon';

    public function __construct() {
        parent::__construct();
    }    

    public function get_all_coupon($limit,$offset){
        $this->db->select('*');
        $this->db->order_by("id","ASC");
        $query =  $this->db->get($this->table_coupon,$limit,$offset);
        //echo "SELECT * FROM ".$this->table_coupon." LIMIT ".$limit.", ".$offset;
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }   

    public function get_all_taken_coupon($limit,$offset){
        $this->db->select('tbl_coupon.*,tu.full_name,tu.registration_number');
        $this->db->join('tbl_user tu', 'tu.registration_number = tbl_coupon.user_id');
        $this->db->where("tbl_coupon.coupon_status","1");
        $this->db->order_by("tbl_coupon.id","ASC");
        $query =  $this->db->get($this->table_coupon,$limit,$offset);
        //echo "SELECT * FROM ".$this->table_coupon." LIMIT ".$limit.", ".$offset;
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
        $q = $this->db->get($this->table_coupon);
        $data1 = $q->result_array();
        $data = array_shift($data1);
        return $data[$field];
    }

    public function get_all_field($id){
        $this->db->select();
        $this->db->where('aid',$id);
        $query = $this->db->get($this->table_coupon);  
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function delete_coupon($id){
        $this->db->where('id',$id);
        $this->db->delete($this->table_coupon);
    }

    public function add_coupon(){
        $data = array(
            'coupon_code' => $this->input->post('coupon_code'),
            'prize_details' => $this->input->post('prize_details')
        );
        $this->db->insert($this->table_coupon,$data);
        $cid = $this->db->insert_id();        
    }

    public function update_coupon($cid){
        $data = array(
          'coupon_code' => $this->input->post('coupon_code'),
          'prize_details' => $this->input->post('prize_details'),
          'coupon_status' => $this->input->post('coupon_status'),
          'user_id' => $this->input->post('user_id')
        );
        $this->db->where('id',$cid);
        $this->db->update($this->table_coupon,$data);
    }

    function get_coupon($q){
        $this->db->select('*');
        $this->db->like('coupon_code', $q,'after');
        //$this->db->like('prize_details', $q,'after');
        $query = $this->db->get('tbl_coupon');
        if($query->num_rows() > 0){
          foreach ($query->result_array() as $row){
            $new_row['label']=htmlentities(stripslashes($row['coupon_code']));
            $new_row['value']=htmlentities(stripslashes($row['coupon_code']));
            $new_row['the_link']=base_url()."admin/Coupon/edit/".$row['id'];
            $row_set[] = $new_row; //build an array
          }
          echo json_encode($row_set); //format the array into json data
        }
    }

}

/* End of file Coupon_model.php
 * Location: ./application/modules/admin/models/Coupon_model.php */
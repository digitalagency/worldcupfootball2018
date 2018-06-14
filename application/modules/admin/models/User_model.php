<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin User Model
 * @user Model
 * Date created:August 8, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class user_model extends CI_Model {

    private $table_user = 'tbl_user';

    public function __construct() {
        parent::__construct();
    }    

    public function get_all_user($limit,$offset,$region){
        $this->db->select('*');
        if($region!='all')
            $this->db->like('registration_number', $region, 'after');
        $this->db->order_by("id","ASC");
        $query =  $this->db->get($this->table_user,$limit,$offset);
        //echo "SELECT * FROM ".$this->table_user." LIMIT ".$limit.", ".$offset;
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }



    public function get_all_registered_user($limit,$offset,$flag=''){
        $this->db->select('*');
        $this->db->from('tbl_participants');
        $this->db->limit($limit, $offset);
        $this->db->order_by("id","ASC");
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function count_all_registered_user($flag){
        $this->db->select('*');
        $this->db->from('tbl_participants');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_users($region){
        $this->db->select('id');
        $this->db->from('tbl_user');
        if($region!='all')
            $this->db->like('registration_number', $region, 'after');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_field_by_id($field,$cid){
        $this->db->select($field);
        $this->db->where('id',$cid);
        $q = $this->db->get($this->table_user);
        $data1 = $q->result_array();
        $data = array_shift($data1);
        return $data[$field];
    }

    public function get_field_by_id2($table_name,$field,$id){        
        $this->db->select($field);
        $this->db->where('id',$id);
        $q = $this->db->get($table_name);
        $data1 = $q->result_array();
        $data = array_shift($data1);
        return $data[$field];
    }

    public function get_id_by_field($table_name,$field,$fieldvalue){
        $this->db->select('id');
        $this->db->where($field,$fieldvalue);
        $q = $this->db->get($table_name);
        $data1 = $q->result_array();
        $data = array_shift($data1);
        return $data['id'];
    }

    public function get_client_name_by_regno($regno){
        $this->db->select('full_name');
        $this->db->where('registration_number',$regno);
        $q = $this->db->get('tbl_user');
        $data1 = $q->result_array();
        $data = array_shift($data1);
        return $data['full_name'];
    }

    function remove_image($photo_id)
    {
        $imagepath = $this->get_field_by_id2('tbl_photo','imagepath',$photo_id);
        $imagename = $this->get_field_by_id2('tbl_photo','imagename',$photo_id);
        $unlink = $imagepath.$imagename;
        @unlink($unlink);
    }

    function get_photo_id($user_id)
    {
        $user_code = $this->get_field_by_id('registration_number',$user_id);
        $photo_id = $this->get_id_by_field('tbl_photo','user_id',$user_code);
        return $photo_id;
    }
    
    public function get_all_registered_user_info($id){
        $this->db->select('tp.id,tp.uploaded_date,tp.likes,tp.imagepath,tp.imagename,tu.id as user_id,tu.registration_number,tu.full_name,tu.sub_region,tu.main_region,tu.coupon_no,tu.coupon_qty,tu.shade,tu.pattern,tu.passcode');
        $this->db->from('tbl_user AS tu');
        $this->db->join('tbl_photo AS tp', 'tp.user_id = tu.registration_number', 'INNER');
        $this->db->where('tu.id', $id);
        
        $query = $this->db->get();
        //$query->result();
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->row();
        }
    }

    public function delete_user($id){
        //echo $id;
        $photo_id = $this->get_photo_id($id);
        //echo "<br>";
        //echo  $photo_id;
        $this->remove_user($photo_id);
        $this->db->where('id',$id);
        $this->db->delete($this->table_user);
    }

    public function remove_user($photo_id){
        $this->remove_image($photo_id);
        $this->db->where('id',$photo_id);
        $this->db->delete('tbl_photo');
    }
    
    public function add_user(){
        $data = array(
            'registration_date' => date('Y-m-d'),
            'registration_number' => strtoupper($this->input->post('registration_number')),
            'passcode' => $this->input->post('passcode'),
            'full_name' => $this->input->post('full_name'),
            'main_region' => $this->input->post('main_region'),
            'sub_region' => $this->input->post('sub_region'),
            /*'coupon_no' => $this->input->post('coupon_no'),
            'coupon_qty' => $this->input->post('coupon_qty'),*/
            'medium' => $this->input->post('medium')            
        );
        $this->db->insert($this->table_user,$data);
        $cid = $this->db->insert_id();        
    }

    public function update_user($cid,$image,$imagepath){
        //echo $cid.' - '.$image.' - '.$imagepath;
        $data = array(
            'registration_number' => $this->input->post('registration_number'),
            'full_name' => $this->input->post('full_name'),
            'main_region' => $this->input->post('main_region'),
            'sub_region' => $this->input->post('sub_region'),
            'passcode' => $this->input->post('passcode'),
            'coupon_no' => $this->input->post('coupon_no'),
            'coupon_qty' => $this->input->post('coupon_qty'),
            'medium' => $this->input->post('medium'),
            'shade' => $this->input->post('shade'),
            'pattern' => $this->input->post('pattern')   
        );
        $this->db->where('id',$cid);
        $this->db->update($this->table_user,$data);
        //echo $this->db->last_query();
        if(!empty($image))
        {
            $data2 = array(
                'imagepath' => $imagepath,
                'imagename' => $image
            );

            //Check if exists
            $where = array('user_id'=>$this->input->post('registration_number'));
            $this->db->where($where);
            $this->db->from('tbl_photo');
            $count = $this->db->count_all_results();
            if($count==0)
            {
                $data2 = array(
                    'user_id' => $this->input->post('registration_number')
                );
                $this->db->insert('tbl_photo', $data2);
            }
            else
            {
                $this->db->where('user_id',$this->input->post('registration_number'));  
                $this->db->update('tbl_photo',$data2);              
            }
        }
    }
    
    function get_user($q){
        $this->db->select('*');
        $this->db->like('full_name', $q,'after');
        $query = $this->db->get('tbl_user');
        if($query->num_rows() > 0){
          foreach ($query->result_array() as $row){
            $new_row['label']=htmlentities(stripslashes($row['full_name']));
            $new_row['value']=htmlentities(stripslashes($row['full_name']));
            $new_row['the_link']=base_url()."admin/User/edit/".$row['id'];
            $row_set[] = $new_row; //build an array
          }
          echo json_encode($row_set); //format the array into json data
        }
    }

    /*
    function get_sub_region($main_region)
    {
        //echo "main_region =".$main_region;
        $this->db->select('id,region');
        $this->db->where('parent_id',$main_region);
        //return  $this->db->last_query();
        //exit();
        return $this->db->get("tbl_regions")->result();
    }*/
    public function getSubregions_by_main_region($main_region)
    {
        $this->db->select('region');
        $this->db->from('tbl_regions');        
        $this->db->where('`parent_id` = (SELECT `id` FROM `tbl_regions` WHERE parent_id="0" AND region="'.$main_region.'")', NULL, FALSE);
        $this->db->order_by("region","ASC");
        $query =  $this->db->get();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        } 
    }

    public function getPattern_by_shade($shades)
    {
        $this->db->select('id,pattern');
        $this->db->where('shades',$shades);
        $this->db->where('display','1');
        $this->db->order_by("pattern","ASC");
        $query =  $this->db->get('tbl_pattern');
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }
}

/* End of file User_model.php
 * Location: ./application/modules/admin/models/User_model.php */
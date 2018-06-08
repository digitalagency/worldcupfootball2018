<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin User Model
 * @country Model
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



    public function get_all_registered_country($limit,$offset,$region){
        $this->db->select('tp.id,tp.uploaded_date,tp.likes,tp.imagepath,tp.imagename,tu.id as country_id,tu.registration_number,tu.full_name,tu.sub_region,tu.main_region,tu.coupon_no,tu.coupon_qty,tu.shade,tu.pattern');
        $this->db->from('tbl_photo AS tp');
        if($region!='all')
            $this->db->like('tu.registration_number', $region.'-', 'after');

        $this->db->join('tbl_country AS tu', 'tp.country_id = tu.registration_number', 'INNER');
        $this->db->limit($limit, $offset);
        $this->db->order_by("tp.id","ASC");
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function count_all_registered_country($region){
        $this->db->select('tp.id,tp.uploaded_date,tp.likes,tp.imagepath,tp.imagename,tu.registration_number,tu.full_name,tu.sub_region,tu.main_region,tu.coupon_no,tu.coupon_qty,tu.shade,tu.pattern');
        $this->db->from('tbl_photo AS tp');
        if($region!='all')
            $this->db->like('tu.registration_number', $region, 'after');

        $this->db->join('tbl_country AS tu', 'tp.country_id = tu.registration_number', 'INNER');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_countrys($region){
        $this->db->select('id');
        $this->db->from('tbl_country');
        if($region!='all')
            $this->db->like('registration_number', $region, 'after');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_field_by_id($field,$cid){
        $this->db->select($field);
        $this->db->where('id',$cid);
        $q = $this->db->get($this->table_country);
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
        $q = $this->db->get('tbl_country');
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

    function get_photo_id($country_id)
    {
        $country_code = $this->get_field_by_id('registration_number',$country_id);
        $photo_id = $this->get_id_by_field('tbl_photo','country_id',$country_code);
        return $photo_id;
    }
    
    public function get_all_registered_country_info($id){
        $this->db->select('tp.id,tp.uploaded_date,tp.likes,tp.imagepath,tp.imagename,tu.id as country_id,tu.registration_number,tu.full_name,tu.sub_region,tu.main_region,tu.coupon_no,tu.coupon_qty,tu.shade,tu.pattern,tu.passcode');
        $this->db->from('tbl_country AS tu');
        $this->db->join('tbl_photo AS tp', 'tp.country_id = tu.registration_number', 'INNER');
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

    public function delete_country($id){
        //echo $id;
        $photo_id = $this->get_photo_id($id);
        //echo "<br>";
        //echo  $photo_id;
        $this->remove_country($photo_id);
        $this->db->where('id',$id);
        $this->db->delete($this->table_country);
    }

    public function remove_country($photo_id){
        $this->remove_image($photo_id);
        $this->db->where('id',$photo_id);
        $this->db->delete('tbl_photo');
    }
    
    public function add_country(){
        $data = array(
            'country_name' => $this->input->post('country_name')           
        );
        $this->db->insert($this->table_country,$data);
        $cid = $this->db->insert_id();        
    }

    public function update_country($cid,$image,$imagepath){
        //echo $cid.' - '.$image.' - '.$imagepath;
        $data = array(
            'country_name' => $this->input->post('country_name')
        );
        $this->db->where('id',$cid);
        $this->db->update($this->table_country,$data);
        //echo $this->db->last_query();        
    }
    
    function get_country($q){
        $this->db->select('*');
        $this->db->like('full_name', $q,'after');
        $query = $this->db->get('tbl_country');
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
}

/* End of file User_model.php
 * Location: ./application/modules/admin/models/User_model.php */
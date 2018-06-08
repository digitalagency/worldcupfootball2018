<?php defined('BASEPATH') OR exit('No direct script access allowed');
define('SITEROOTFB',base_url().'facebook');
/**
 * Admin Home_model Model
 * @package Model
 * @subpackage Model
 * Date created:January 31, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class Home_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }


    public function function_name($argument1,$argument2){

    }

    public function getPattern()
    {
    	$this->db->select('id,pattern,shades');
        $this->db->order_by("id","ASC");
        $query =  $this->db->get('tbl_pattern');
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

    public function getTopusers_by_regioncode($regioncode)
    {
        $this->db->select('tp.id id,tp.user_id,tp.likes,tp.imagepath,tp.imagename,tu.full_name');
        $this->db->from('tbl_photo tp');
        $this->db->join('tbl_user tu', 'tu.registration_number = tp.user_id');
        $this->db->like('tp.user_id',$regioncode.'-','after');
        $this->db->where('tp.imagepath!=','');
        $this->db->where('tp.imagename!=','');
        $this->db->order_by("tp.likes","DESC");
        $this->db->limit(16);
        $query =  $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_user_by_reg_no($reg_no)
    {
        $this->db->select('tp.id id,tp.user_id,tp.likes,tp.imagepath,tp.imagename,tu.full_name');
        $this->db->from('tbl_photo tp');
        $this->db->join('tbl_user tu', 'tu.registration_number = tp.user_id');
        $this->db->where('tp.user_id',$reg_no);
        $query =  $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function getRegisteredusers_by_regioncode($regioncode)
    {
        $this->db->select('id,user_id,likes,imagepath,imagename');
        $this->db->like('user_id',$regioncode,'after');
        $this->db->where('imagepath!=','');
        $this->db->where('imagename!=','');
        $this->db->order_by("likes","DESC");
        $query =  $this->db->get('tbl_photo');
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_all_registered_user($limit,$offset,$region){
        $this->db->select('tp.id,tp.uploaded_date,tp.likes,tp.imagepath,tp.imagename,tu.id as user_id,tu.registration_number,tu.full_name,tu.sub_region,tu.main_region,tu.coupon_no,tu.coupon_qty,tu.shade,tu.pattern');
        $this->db->from('tbl_photo AS tp');
        if($region!='all')
            $this->db->like('tu.registration_number', $region.'-', 'after');

        $this->db->join('tbl_user AS tu', 'tp.user_id = tu.registration_number', 'INNER');
        $this->db->limit($limit, $offset);
        $this->db->order_by("tu.full_name","ASC");
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function count_all_registered_user($region){
        $this->db->select('tp.id,tp.uploaded_date,tp.likes,tp.imagepath,tp.imagename,tu.registration_number,tu.full_name,tu.sub_region,tu.main_region,tu.coupon_no,tu.coupon_qty,tu.shade,tu.pattern');
        $this->db->from('tbl_photo AS tp');
        if($region!='all')
            $this->db->like('tu.registration_number', $region, 'after');

        $this->db->join('tbl_user AS tu', 'tp.user_id = tu.registration_number', 'INNER');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_uid_by_rp($registration_number,$passcode)
    {
        $this->db->select('id');
        $this->db->where('registration_number',$registration_number);
        $this->db->where('passcode',$passcode);
        $query =  $this->db->get('tbl_user');
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            $val = $query->row();
            return $val->id;
        }

    }

    public function getSubregions_by_main_region($main_region)
    {
        $this->db->select('region');
        $this->db->from('tbl_regions');        
        $this->db->where('`parent_id` = (SELECT `id` FROM `tbl_regions` WHERE parent_id="0" AND region="'.$main_region.'")', NULL, FALSE);
        $this->db->order_by("region","ASC");
        $query =  $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        } 
    }

    public function selectbox_for_Subregions_by_main_region($main_region)
    {
        $this->db->select('region');
        $this->db->from('tbl_regions');        
        $this->db->where('`parent_id` = (SELECT `id` FROM `tbl_regions` WHERE parent_id="0" AND region="'.$main_region.'")', NULL, FALSE);
        $this->db->order_by("region","ASC");
        $query =  $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            $selectbox = '
            <select name="sub_region" id="sub_region" class="form-control">
                <option value="">Select sub region</option>
            ';
            $subregion = $query->result();
            foreach($subregion as $key=>$value)
            {
            $selectbox = '
                <option value="'.$value->region.'">'.$value->region.'</option>
                ';
            }

            $selectbox .= '
            </select>
            ';
            echo $selectbox;
        } 
    }

    public function getSerialnumber($regioncode)
    {
        $this->db->select('serial_number');
        $this->db->like('user_id',$regioncode,'after');
        $this->db->order_by('serial_number','DESC');
        $this->db->limit(1);
        $query =  $this->db->get('tbl_photo'); 
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return 1;
        } else {
            $val = $query->row();

            $serialNumber = $val->serial_number;
            return ($serialNumber+1);
        }
    }

    public function getRegion($regno)
    {        
        $regno_arr = explode('-',$regno);
        $area = $regno_arr['1'];
        $region_arr = array('K'=>'kathmandu','P'=>'pokhara','C'=>'central','E'=>'eastern','W'=>'western','COM'=>'commercial');
        return $region_arr[$area];
    }

    function uploadPhoto($no_of_coupon,$coupon_no,$imagepath,$imagename,$medium)
    {
        $registration_number = strtoupper($this->input->post('regno'));
        $reg_arr = explode('-',$registration_number);
        //print_r($reg_arr);
        $regioncode = $reg_arr['0'].'-'.$reg_arr['1'];
        $serialNumber = $this->getSerialnumber($regioncode);
        //echo 'serialNumber = '.$serialNumber;
        $data = array(
            'registration_date' => date('Y-m-d'),
            'full_name' => $this->input->post('fname'),
            'main_region' => $this->input->post('main_region'),
            'sub_region' => $this->input->post('sub_region'),
            'coupon_qty' => $no_of_coupon,
            'coupon_no' => $coupon_no,
            'shade' => $this->input->post('shade'),
            'pattern' => $this->input->post('pattern'),
            'facebook_id' => $this->input->post('facebook_id'),
            'facebook_name' => $this->input->post('facebook_name'),
            'facebook_email' => $this->input->post('facebook_email'),
            'medium' => $medium
        );

        $data2 = array(
            'serial_number' => $serialNumber,
            'user_id' => $registration_number,
            'imagepath' => $imagepath,
            'imagename' => $imagename
        );

        $photo_id_prev = $this->checkPrevious($registration_number);
        if($photo_id_prev==0)
        {   
            //Update user table
            $this->db->where('registration_number', $registration_number);
            $this->db->update('tbl_user', $data); 

            //Insert in Photo table
            $this->db->insert('tbl_photo', $data2);
            return $this->db->insert_id();
        }
        else
            return $photo_id_prev;
    }

    public function checkPrevious($regno)
    {
        $this->db->select('id');
        $this->db->where('user_id',$regno);
        $query =  $this->db->get('tbl_photo');
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            $val = $query->row();
            $photo_id = $val->id;
            return $photo_id;
        }
    }

    public function getGift($regno)
    {
        $this->db->select('prize_image,coupon_code,prize_details');
        $this->db->where('user_id',$regno);
        $query =  $this->db->get('tbl_coupon');
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            $val = $query->row();
            $prize_image = $val->prize_image;
            $coupon_code = $val->coupon_code;
            $prize_details = $val->prize_details;

            return $prize_image.'___'.$coupon_code.'___'.$prize_details;
        }
    }

    public function getRandomCoupon($n)
    {
        $this->db->order_by('rand()');
        $this->db->where('coupon_status','0');
        $this->db->limit($n);
        $query = $this->db->get('tbl_coupon');
        return $query->result_array();
    } 

    public function isRegistered($regno)
    {
        $this->db->select('id');
        $this->db->where('user_id',$regno);
        $query =  $this->db->get('tbl_photo');
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function updateCouponstatus($ecoupon,$user_id)
    {
        $data = array(
            'coupon_status' => '1',
            'user_id' => $user_id
        );
        $this->db->where('coupon_code', $ecoupon);
        $this->db->update('tbl_coupon', $data); 
    }

    public function getLikesCount($share_url){
        $url = 'https://graph.facebook.com/?fields=og_object%7Blikes.summary(true).limit(0)%7D,share&id='.$share_url;
        //  Initiate curl
        $ch = curl_init();
        // Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL,$url);
        // Execute
        $result=curl_exec($ch);
        // Closing
        curl_close($ch);

        $data = (array)json_decode($result, true);

        $tc = '0';
        if (isset($data['og_object'])) {
            $bj = $data['og_object'];
            $lik = $bj['likes'];
            $summ = $lik['summary'];
            $tc = $summ['total_count'];
        }
        return $tc;
    }

    public function update_likes_with_cron_job($regioncode)
    {
        $regno = $regioncode.'-';
        $rusers = $this->getRegisteredusers_by_regioncode($regno);
        //print_r($rusers);
        if($rusers):
        foreach($rusers as $key=>$row)
        {
            $id = $row->id;
            $user_id = $row->user_id;
            $old_likes = $row->likes;
            $share_url = "https://rangmagical.bergernepal.com/photo-gallery-single/".$user_id;
            $new_likes = $this->getLikesCount($share_url);
            if($new_likes>$old_likes)
            {
                $data='';
                $data['likes'] = $new_likes;                
                $this->db->where('user_id', $user_id);
                $this->db->update('tbl_photo', $data);
                echo $id.' -- '.$old_likes.' -- UPDATED';
                echo "<br>";
            }
        }
        endif;
    }

    public function get_user($q){
        //echo $q;
        $this->db->select('*');
        $this->db->like('full_name', $q,'after');
        $query = $this->db->get('tbl_user');
        if($query->num_rows() > 0){
          foreach ($query->result_array() as $row){
            //check if exists in tbl_photo
            $registration_number = $row['registration_number'];
            if($this->isRegistered($row['registration_number']))
            {
                $new_row['label']=htmlentities(stripslashes($row['full_name']));
                $new_row['value']=htmlentities(stripslashes($row['full_name']));
                $new_row['the_link']=base_url()."photo-gallery-single/".$row['registration_number'];
                $row_set[] = $new_row; //build an array
            }
          }
          echo json_encode($row_set); //format the array into json data
        }
    }

    public function get_user_fb($q){
        //echo $q;
        $this->db->select('*');
        $this->db->like('full_name', $q,'after');
        $query = $this->db->get('tbl_user');
        if($query->num_rows() > 0){
          foreach ($query->result_array() as $row){
            //check if exists in tbl_photo
            $registration_number = $row['registration_number'];
            if($this->isRegistered($row['registration_number']))
            {
                $new_row['label']=htmlentities(stripslashes($row['full_name']));
                $new_row['value']=htmlentities(stripslashes($row['full_name']));
                $new_row['the_link']=base_url()."facebook/photo_gallery_single/".$row['registration_number'];
                $row_set[] = $new_row; //build an array
            }
          }
          echo json_encode($row_set); //format the array into json data
        }
    }
}

/* End of file Home_model.php
 * Location: ./application/modules/home/models/Home_model.php */

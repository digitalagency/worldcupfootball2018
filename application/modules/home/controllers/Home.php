<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home Controller
 * @package Controller
 * @subpackage Controller
 * Date created:January 31, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class Home extends View_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('home_model');
        $this->load->helper("view_helper");
        $this->load->model('admin/general_model','general_model');
    }

    function index() {    
        $data['menu'] = 'home';
        $data['page_title'] = '.:: Set Wet Nepal :: ';
        $data['main'] = 'home';
        $this->load->view('main',$data);
    }

    function terms_and_condition()
    {        
        $data['menu'] = 'terms';
        $data['page_title'] = '.:: Set Wet Nepal :: ';
        $data['main'] = 'terms_and_condition';
        $this->load->view('main',$data);
    }

    function dashboard()
    {        
        $this->home_model->checkLoggedIn();
        $data['menu'] = 'procedure';
        $data['page_title'] = '.:: Set Wet Nepal :: ';
        $data['main'] = 'dashboard';
        $this->load->view('main',$data);
    }



    function registration_process()
    {
        $data['menu'] = 'register';
        $data['page_title'] = '.:: Set Wet Nepal :: ';

        $userpassword = $this->input->post('userpassword');
        $conf_password = $this->input->post('conf_password');
        if($userpassword==$conf_password)
        {
            if(!empty($_FILES['yourimage']['name']))
            {            
                $imagename = $_FILES['yourimage']['name'];
                if ($imagename !== "") {
                    $ext = pathinfo($_FILES['yourimage']['name'], PATHINFO_EXTENSION); 
                    $imagepath = 'uploads/'.date('Y').'/';
                    $imagepath_thumb = 'uploads/'.date('Y').'/thumb/';
                    $config1['upload_path'] = FCPATH.$imagepath;
                    $config1['log_threshold'] = 1;
                    //$config1['allowed_types'] = 'doc|docx|pdf|txt|rtf';
                    $config1['allowed_types'] = 'jpg|jpeg|png|bmp';
                    $config1['max_size'] = '100000'; // 0 = no file size limit
                    $config1['file_name'] = $imagename;
                    $config1['overwrite'] = true;
                    //print_r($config1);
                    $this->load->library('upload', $config1);
                    $this->upload->do_upload('yourimage');
                    $upload_data1 = $this->upload->data();
                    $imagename = $upload_data1['file_name'];

                    //Create Thumbnail
                    $config_resize = array(
                        'image_library' => 'gd2',
                        'source_image' => $imagepath.$imagename,
                        'new_image' => $imagepath_thumb.$imagename,
                        'maintain_ratio' => TRUE,
                        'create_thumb' => TRUE,
                        'thumb_marker' => '',
                        'width' => 220,
                        'height' => 150
                    );
                    
                    $this->load->library('image_lib', $config_resize);
                    if (!$this->image_lib->resize()) {
                        echo $this->image_lib->display_errors();
                    }
                    $this->image_lib->clear();
                    //Create Thumbnail ends here
                }
            }

            $image_path = FCPATH.$imagepath.$imagename;
            $registration_id = $this->home_model->doRegistration($imagepath,$imagename);
            if($registration_id>0)  
                redirect(base_url() . 'thank-you');
        }
        else
        {            
            redirect(base_url() . '?error=ip');
        }
    }

    function login_process()
    { 
        $user_id = $this->home_model->doLogin();
        if($user_id==0)
            redirect(base_url() . '?error=iupc'); // Incorrect Username/Password Combination

    }

    function match_day_contest()
    {        
        $this->home_model->checkLoggedIn();
        $data['menu'] = 'procedure';
        $data['page_title'] = '.:: Set Wet Nepal :: ';
        $data['main'] = 'match_day_contest';  
        $data['question_info'] = $this->home_model->getMatchDayContest();      
        $this->load->view('main',$data);
    }

    function match_day_contest_question($match_id)
    {        
        $data['menu'] = 'procedure';
        $data['page_title'] = '.:: Set Wet Nepal :: ';
        $data['main'] = 'match_day_contest_question';  
        $data['match_info'] = $this->home_model->getMatchInfo($match_id);
        $data['question_info'] = $this->home_model->getMatchDayContestQuestion($match_id);      
        $this->load->view('main',$data);
    }

    function ultimate_contest_question()
    {        
        $data['menu'] = 'procedure';
        $data['page_title'] = '.:: Set Wet Nepal :: ';
        $data['main'] = 'ultimate_contest_question';
        $data['countries'] = $this->home_model->get_all_countries();      
        $data['question_info'] = $this->home_model->getUltimateContestQuestion();      
        $this->load->view('main',$data);
    }

    function all_time_contest()
    {        
        $data['menu'] = 'procedure';
        $data['page_title'] = '.:: Set Wet Nepal :: ';
        $data['main'] = 'all_time_contest';
        $data['countries'] = $this->home_model->get_all_countries();      
        $data['question_info'] = $this->home_model->all_time_contest();      
        $this->load->view('main',$data);
    }

    function all_time_contest_question($question_id)
    {        
        $data['menu'] = 'procedure';
        $data['page_title'] = '.:: Set Wet Nepal :: ';
        $data['main'] = 'all_time_contest_question';     
        $data['question_info'] = $this->home_model->all_time_contest_questions($question_id);      
        $this->load->view('main',$data);
    }



    function photo_upload()
    {        
        $data['menu'] = 'register';
        $data['page_title'] = '.:: Set Wet Nepal :: ';           
        $data['metallica'] = $this->home_model->getPattern_by_shade('Metallica');
        $data['nonmetallica'] = $this->home_model->getPattern_by_shade('Non - metallica');

        $data['main'] = 'photo_upload';
        //$data['main'] = 'photo_upload_completed';
        $this->load->view('main',$data);
    }

    function photo_upload_test()
    {        
        $data['menu'] = 'register';
        $data['page_title'] = '.:: Set Wet Nepal :: ';           
        $data['metallica'] = $this->home_model->getPattern_by_shade('Metallica');
        $data['nonmetallica'] = $this->home_model->getPattern_by_shade('Non - metallica');

        $data['main'] = 'photo_upload_test';
        $this->load->view('main',$data);
    }

    function photo_upload_process()
    {
        $data['menu'] = 'register';
        $data['page_title'] = '.:: Set Wet Nepal :: ';           
        $data['metallica'] = $this->home_model->getPattern_by_shade('Metallica');
        $data['nonmetallica'] = $this->home_model->getPattern_by_shade('Non - metallica');
        //print_r($_POST);

        $regno = strtoupper($_POST['regno']);
        $region = $this->home_model->getRegion($regno);
        $passcode = $_POST['passcode'];
        $isRegistered = $this->home_model->checkPrevious($regno);
        $uid = $this->home_model->get_uid_by_rp($regno,$passcode); //the value of uid becomes null if the registration number doesnt exist.
        
        //Count Coupons and assign coupon_no    
        $no_of_coupon=0;
        $qx_text="XP";
        $qx_count=0;
        $coupon_no = '';
        for ($cnt=0;$cnt<count($_POST['couponumber']);$cnt++)
        {
          //echo $cnt." --> ".$_POST['couponumber'][$cnt];
          //echo "<br>";
          if(!empty($_POST['couponumber'][$cnt]))
          {
            ++$no_of_coupon;
            $coupon_no.=$_POST['couponumber'][$cnt].', ';
            $couponumber = strtoupper($_POST['couponumber'][$cnt]);
            if (strpos($couponumber, $qx_text) !== false) {
                ++$qx_count;
            }
          }
        }
        //echo $no_of_coupon;

        $couponumber_1 = $_POST['couponumber']['0'];
        
        if(!empty($isRegistered)){
            $message = "You have already registered with the registration number " . $regno . ".";
        } 
        else if ($uid == '') {
            $message = "The Registration number " . $regno . " and passcode combination doesnt match.";
        } 
        else if ($couponumber_1 == '') {
            $message = "You must enter your coupon number to participate in Rang Magical consumer scheme.";
        }
        else if($no_of_coupon<3)
        {
            $message = "You must enter at least three coupon numbers to participate in Rang Magical consumer scheme.";
        }
        /*else if($qx_count>=3)
        {
            $message = "There is some technical error regarding the XP coupon. Please try again after some time. Sorry for the inconvenience.";
        }*/
        //echo $message;
        $this->form_validation->set_rules('fname', 'Full Name', 'required');
        $this->form_validation->set_rules('regno', 'Registration Number', 'required');
        $this->form_validation->set_rules('passcode', 'Passcode', 'required');
        
        if (empty($_FILES['houseimage']['name']))
        {
            $this->form_validation->set_rules('houseimage', 'House Image', 'required');
        }

        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('success', validation_errors());
            $data['metallica'] = $this->home_model->getPattern_by_shade('Metallica');
            $data['nonmetallica'] = $this->home_model->getPattern_by_shade('Non - metallica');
            $data['main'] = 'photo_upload';
            $this->load->view('main',$data);
        }
        elseif(!empty($message))
        {            
            $data['metallica'] = $this->home_model->getPattern_by_shade('Metallica');
            $data['nonmetallica'] = $this->home_model->getPattern_by_shade('Non - metallica');
            $this->session->set_flashdata('success', $message);
            $data['main'] = 'photo_upload';
            $this->load->view('main',$data);
        }
        else
        {            
            $houseimage = $_FILES['houseimage']['name'];
            if ($houseimage !== "") {
                $ext = pathinfo($_FILES['houseimage']['name'], PATHINFO_EXTENSION); 
                $imagepath = 'uploads/'.date('Y').'/'.$region.'/';
                $imagepath_thumb = 'uploads/'.date('Y').'/'.$region.'/thumb/';
                $imagename = $regno.'.'.$ext;
                $config1['upload_path'] = FCPATH.$imagepath;
                $config1['log_threshold'] = 1;
                //$config1['allowed_types'] = 'doc|docx|pdf|txt|rtf';
                $config1['allowed_types'] = 'jpg|jpeg|png|bmp';
                $config1['max_size'] = '100000'; // 0 = no file size limit
                $config1['file_name'] = $imagename;
                $config1['overwrite'] = true;
                //print_r($config1);
                $this->load->library('upload', $config1);
                $this->upload->do_upload('houseimage');
                $upload_data1 = $this->upload->data();
                $houseimage = $upload_data1['file_name'];

                //Create Thumbnail
                $config_resize = array(
                    'image_library' => 'gd2',
                    'source_image' => $imagepath.$imagename,
                    'new_image' => $imagepath_thumb.$imagename,
                    'maintain_ratio' => TRUE,
                    'create_thumb' => TRUE,
                    'thumb_marker' => '',
                    'width' => 220,
                    'height' => 150
                );
                
                $this->load->library('image_lib', $config_resize);
                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors();
                }
                $this->image_lib->clear();
                //Create Thumbnail ends here
            }

            $image_path = FCPATH.$imagepath.$imagename;
            if(!file_exists($image_path))
            {
                //$regno
                $this->session->set_flashdata('success', 'A technical problem has occured while uploading your image. Please re-upload the image again.');            
                
                $data['metallica'] = $this->home_model->getPattern_by_shade('Metallica');
                $data['nonmetallica'] = $this->home_model->getPattern_by_shade('Non - metallica');
                $data['main'] = 'photo_upload';
                $this->load->view('main',$data);
            }
            else
            {
                $photo_id = $this->home_model->uploadPhoto($no_of_coupon,$coupon_no,$imagepath,$imagename,'website');
                //echo $qx_count;
                if($qx_count>=3) //if entered coupon code is liable for gift voucher
                {                
                    $data['regno'] = $regno;
                    $data['ecoupon'] = $this->home_model->getRandomCoupon(16);
                    $data['main'] = 'e_coupon';
                    $this->load->view('main',$data);
                }
                else //if entered coupon code is NOT liable for gift voucher
                {
                    //echo "Thank you";
                    redirect(base_url() . 'thank-you');
                }
            }
        }
    }

    function photo_album()
    {        
        $data['menu'] = 'album';
        $data['page_title'] = '.:: Set Wet Nepal :: ';
        $data['main'] = 'photo_album';
        $this->load->view('main',$data);
    }

    function photo_gallery_top()
    {        
        $data['menu'] = 'album';
        $data['page_title'] = '.:: Set Wet Nepal :: ';
        $regioncode = $this->uri->segment(2);
        //$resGal = $mydb->getQuery('*', 'tbl_photo', 'user_id LIKE "'.$code.'%" AND imagepath!="" AND imagename!="" ORDER BY likes DESC, id ASC LIMIT 16');
        $data['regioncode'] = $regioncode;
        $data['nor'] = $this->home_model->getTopusers_by_regioncode($regioncode);
        $data['topusers'] = $this->home_model->getTopusers_by_regioncode($regioncode);
        $data['main'] = 'photo_gallery_top';
        $this->load->view('main',$data);
    }

    function photo_gallery()
    {
        $data['menu'] = 'album';        
        $config['base_url'] = base_url() . 'photo-gallery/'.$this->uri->segment(2);
        //$config['uri_segment'] = 3;
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
        $region = $this->uri->segment(2);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        //echo $page;
        $total_rows = $this->home_model->count_all_registered_user($region);
        //echo $total_rows; exit();
        $config['total_rows'] = $total_rows;
        //echo $this->User_model->count_all_registered_user($region);
        $data['user_info'] = $this->home_model->get_all_registered_user($config['per_page'], $page,$region);
        

        $this->pagination->initialize($config);

        $data['title'] = '.:: User ::.';
        $data['page_header'] = 'User';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'User';
        $data['panel_title'] = 'User List';
        //$data['main'] = 'user_registered';
        //$data['organisation_type'] =$this->general_model->getAll('dropdown','fid = 6','','id,dropvalue');
        $data['nor'] = $total_rows;
        $data['main'] = 'photo_gallery';
        $this->load->view('main',$data);        
    }

    function photo_gallery_single($reg_no)
    {
        $data['menu'] = 'album';
        $data['page_title'] = '.:: Set Wet Nepal :: ';
        $registration_no = $this->uri->segment(2);

        $data['registration_no'] = $registration_no;
        $data['userinfo'] = $this->home_model->get_user_by_reg_no($reg_no);
        $data['main'] = 'photo_gallery_single';
        $this->load->view('main',$data);
    }

    function thank_you()
    {
        $data['menu'] = 'register';
        $data['page_title'] = '.:: Set Wet Nepal :: ';
        $data['regno'] = $this->uri->segment('2');
        $data['main'] = 'thank_you';
        $this->load->view('main',$data);
    }

    function showSubregion()
    {
        $main_region = $this->uri->segment(3);
        $class = $this->uri->segment(4);
        if(empty($class))
            $class = 'form-control';
        $subregion = $this->home_model->getSubregions_by_main_region($main_region);
        
        $required = '';
        if($subregion)
            $required = 'required';
        $selectbox = '
        <select name="sub_region" id="sub_region" class="'.$class.'" '.$required.'>
            <option value="">Select sub region</option>
        ';
        if($subregion)
        {
            foreach($subregion as $key=>$value)
            {
            $selectbox .= '
                <option value="'.$value->region.'">'.$value->region.'</option>
                ';
            }
        }
        $selectbox .= '
        </select>
        ';
        echo $selectbox;
    }

    function ecoupon_process($ecoupon,$regno)
    {
        $this->home_model->updateCouponstatus($ecoupon,$regno);
        redirect(base_url() . 'thank-you/'.$regno);
    }

    function update_likes_with_cron($regioncode)
    {
        $this->home_model->update_likes_with_cron_job($regioncode);
    }

    function updatePatternname() {    
        $data['menu'] = 'home';
        $data['page_title'] = '.:: Set Wet Nepal :: ';
        $data['main'] = 'home';
        $pattern = $this->home_model->getPattern();
        foreach($pattern as $key=>$value)
        {
            $id = $value->id;
            $shades = strtolower($value->shades);
            $shades = str_replace(' - ','',$shades);
            $pattern = $value->pattern;
            $new_name = strtolower($pattern);
            $new_name = str_replace(' ','_',$new_name);
            $new_name = str_replace('-','_',$new_name);
            $this->home_model->updatePattern($id,$new_name);
            $path = FCPATH;
            echo $oldpath = $path.'content_home\images'.'\\'.$shades."\\"."large"."\\".$pattern;
            echo "<br>";
            echo $newpath = $path.'content_home\images'.'\\'.$shades."\\"."large"."\\".$new_name;
            echo "<br>";
            echo $oldpath2 = $path.'content_home\images'.'\\'.$shades."\\".$pattern;
            echo "<br>";
            echo $newpath2 = $path.'content_home\images'.'\\'.$shades."\\".$new_name;
            echo "<br>";echo "<br>";
            @rename($oldpath, $newpath);
            @rename($oldpath2, $newpath2);
        }

        //$this->load->view('main',$data);
    }

    function add_new_gift_coupons()
    {        
        //$sql = "SELECT * FROM tbl_coupon_temp ORDER BY rand()";
        $this->db->select('*');
        $this->db->order_by('rand()');
        $query =  $this->db->get('tbl_coupon_temp');
        $results = $query->result();
        foreach($results as $result)
        {
            echo $result->coupon_code."<br>";
        }
    }

    function get_users(){
        if (isset($_GET['term'])){
          $q = strtolower($_GET['term']);
          $this->home_model->get_user($q);
        }
    }
}

/* End of file Home.php
 * Location: ./application/modules/home/controllers/home.php */

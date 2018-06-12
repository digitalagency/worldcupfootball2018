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
        
        if(isset($_POST['btnSubmit']))
        {
            //print_r($_POST);
            $this->home_model->enter_match_day_contest_answer($match_id); 
        }

        $data['match_id'] = $match_id;
        $data['match_info'] = $this->home_model->getMatchInfo($match_id);
        $data['question_info'] = $this->home_model->getMatchDayContestQuestion($match_id);      
        $this->load->view('main',$data);
    }

    function ultimate_contest_question()
    {        
        $data['menu'] = 'procedure';
        $data['page_title'] = '.:: Set Wet Nepal :: ';
        $data['main'] = 'ultimate_contest_question';        
        if(isset($_POST['btnSubmit']))
        {
            $this->home_model->enter_ultimate_contest_answer(); 
        }
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
        if(isset($_POST['btnSubmit']))
        {
            $this->home_model->enter_all_time_contest_answer(); 
        } 
        $data['question_info'] = $this->home_model->all_time_contest_questions($question_id);      
        $this->load->view('main',$data);
    }



    function forgot_password()
    {        
        $message='';
        $data['menu'] = 'register';
        $data['page_title'] = '.:: Set Wet Nepal :: ';  
        if(isset($_POST['emailaddress']))
        {
            $emailaddress = $_POST['emailaddress'];
            $message = $this->home_model->send_reset_password_link($emailaddress);
        }         
        //echo $message;
        $data['message'] = $message;
        $data['main'] = 'forgot_password';
        $this->load->view('main',$data);
    }

    function reset_password()
    {        
        $message='';
        $data['menu'] = 'register';
        $data['page_title'] = '.:: Set Wet Nepal :: ';  
        if(isset($_POST['your_password']))
        {
            $your_password = $_POST['your_password'];
            $confirm_password = $_POST['confirm_password'];
            if($your_password == $confirm_password)
                $message = $this->home_model->reset_password($your_password);
            else
                $message = "Password Confirmation doesn't Match. Please try again";
        }         
        //echo $message;
        $data['message'] = $message;
        $data['main'] = 'reset_password';
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

    function thank_you()
    {
        $data['menu'] = 'register';
        $data['page_title'] = '.:: Set Wet Nepal :: ';
        $data['regno'] = $this->uri->segment('2');
        $data['main'] = 'thank_you';
        $this->load->view('main',$data);
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

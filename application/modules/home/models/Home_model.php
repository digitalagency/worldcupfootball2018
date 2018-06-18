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

    function doRegistration($imagepath,$imagename)
    {
        $username = $this->input->post('username');
        $emailaddress = $this->input->post('emailaddress');
        $userpassword = $this->input->post('userpassword');
        $mobile_number = $this->input->post('mobile_number');
        //$checkIfUsernameExists = $this->checkIfUsernameExists($username);
        $checkIfNumberExists = $this->checkIfNumberExists($mobile_number);
        $checkIfEmailExists = $this->checkIfEmailExists($emailaddress);
        //if($checkIfUsernameExists==0 && $checkIfEmailExists==0){
        if($checkIfEmailExists==0 && $checkIfNumberExists==0){
            $data = array(
                'fname' => $this->input->post('fname'),
                /*'username' => $this->input->post('username'),*/
                'gender' => $this->input->post('gender'),
                'mobile_number' => $this->input->post('mobile_number'),
                'email' => $this->input->post('emailaddress'),
                'password' => md5($userpassword),
                'registered_on' => date('Y-m-d H:i:s'),
                'imagepath' => $imagepath.$imagename,
                'facebook_name' => $this->input->post('facebook_name'),
                'facebook_email' => $this->input->post('facebook_email'),
                'facebook_link' => $this->input->post('facebook_link')
            );
            $this->db->insert('tbl_participants',$data);
            $id = $this->db->insert_id(); 
            return $id;
        }
        else if($checkIfNumberExists>0){
            redirect(base_url() . '?error=rn');
        } 
        else if($checkIfEmailExists>0){
            redirect(base_url() . '?error=re');
        } 
    }

    public function checkIfEmailExists($emailaddress)
    {
        $this->db->select('id');
        $this->db->where('email',$emailaddress);
        $query =  $this->db->get('tbl_participants');
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            $val = $query->row();
            $user_id = $val->id;
            return $user_id;
        }
    }

    public function checkIfNumberExists($mobile_number)
    {
        $this->db->select('id');
        $this->db->where('mobile_number',$mobile_number);
        $query =  $this->db->get('tbl_participants');
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            $val = $query->row();
            $user_id = $val->id;
            return $user_id;
        }

    }

    public function checkIfUsernameExists($username)
    {
        $this->db->select('id');
        $this->db->where('username',$username);
        $query =  $this->db->get('tbl_participants');
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            $val = $query->row();
            $user_id = $val->id;
            return $user_id;
        }

    }

    function doLogin()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('userpassword');

        $provided_password = md5($password);
        
        $where = '(username="'.$username.'" OR email = "'.$username.'") AND password = "'.$provided_password.'"';
        $this->db->select('id,mobile_number,email');
        $this->db->where($where);
        $query =  $this->db->get('tbl_participants');
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            //echo $this->db->last_query();
            $val = $query->row();
            $user_id = $val->id;
            $userdata = array(
                   'contestant_id'  => $val->id,
                   'mobile_number'  => $val->mobile_number,
                   'email'     => $val->email,
                   'logged_in' => TRUE
               );
            $this->session->set_userdata($userdata);
            redirect(base_url() . 'dashboard');
        }

    }  

    function doLogout()
    {
        $userdata = array('contestant_id' => '', 'mobile_number' => '', 'email' => '', 'logged_in' => '');
        $this->session->set_userdata($userdata);
        $this->session->unset_userdata($userdata);
        $this->session->sess_destroy();
        //print_r($this->session->all_userdata());
        redirect(base_url());
    }  

    public function send_reset_password_link($emailaddress) 
    {
        $user_id = $this->getUserIdByEmail($emailaddress);
        if($user_id>0)
        {
            $user_info = $this->getUser($user_id);
            $name = $user_info['0']->fname;
            //do send password reset link
            $reset_code = rand(11111111,99999999);


            $data = array(
                'reset_code' => $reset_code
            );
            $this->db->where('id', $user_id);
            $this->db->update('tbl_participants', $data); 
            // Multiple recipients
            $to = $emailaddress;

            // Subject
            $subject = 'Forgot Password Request - SETWET Play in Style';

            // Message
            $message = '
            <html>
            <head>
              <title>Forgot Password Request - SETWET Play in Style</title>
            </head>
            <body>
              Dear '.$name.',<br><br>
                To reset your password, please click on <a href="'.base_url().'reset-password/'.$reset_code.'" target="_blank">Reset My Password</a><br>
                
                If you do not wish to change your password, please ignore this email.<br><br><br><br>


                Thank You !!!<br>
                SETWET<br>
                Play in Style
            </body>
            </html>
            ';
            //echo $message;
            // To send HTML mail, the Content-type header must be set
            $headers[] = 'MIME-Version: 1.0';
            $headers[] = 'Content-type: text/html; charset=iso-8859-1';

            // Additional headers
            $headers[] = 'To: '.$name.' <'.$to.'>';
            $headers[] = 'From: SETWET Play in Style <noreply@setwetnepal.com>';

            // Mail it
            if(mail($to, $subject, $message, implode("\r\n", $headers)))
                return "Please check your email to reset your password.";
            else
                return "Sorry, we are unable to reset your password due to some technical problem. Please try again later.";
        }
        else
        {
            return "Sorry, the email address provided doesn't exist in our database.";
        }
    } 

    function reset_password($your_password)
    {
        $reset_code = $this->uri->segment(2);
        $user_id = $this->getUserIdByResetcode($reset_code);
        if($user_id>0)
        {
            $new_password = md5($your_password);
            $data = array(
                'reset_code' => '',
                'password' => $new_password
            );
            $this->db->where('id', $user_id);
            $this->db->update('tbl_participants', $data);
            return "You have successfully reset your password.";
        }
        else
        {
            return "Sorry, the provided reset code is not available or has expired. Please reset your password again.";
        }
    }

    public function checkLoggedIn()
    {
        $user_id = $this->session->userdata('contestant_id');
        $mobile_number = $this->session->userdata('mobile_number');
        if(empty($user_id) && empty($mobile_number))
            redirect(base_url());



    }

    public function getUser($user_id)
    {
    	$this->db->select('');
        $this->db->where("id",$user_id);
        $query =  $this->db->get('tbl_participants');
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function getUserIdByEmail($emailaddress)
    {
        $this->db->select('id');
        $this->db->where("email",$emailaddress);
        $query =  $this->db->get('tbl_participants');
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            $val = $query->row();
            $id = $val->id;
            return $id;
        }
    }

    public function getGender($emailaddress)
    {
        $this->db->select('id');
        $this->db->where("gender",$emailaddress);
        $query =  $this->db->get('tbl_participants');
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            $val = $query->row();
            $gender = $val->gender;
            return $gender;
        }
    }

    public function getUserIdByResetcode($resetcode)
    {
        $this->db->select('id');
        $this->db->where("reset_code",$resetcode);
        $query =  $this->db->get('tbl_participants');
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            $val = $query->row();
            $id = $val->id;
            return $id;
        }
    }

    public function getMatchInfo($match_id)
    {
        $this->db->select('');
        $this->db->where("id",$match_id);
        $query =  $this->db->get('tbl_match');
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function getMatchDayContest()
    {
        $this->db->select('');
        $query =  $this->db->get('tbl_match');
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    function getMatchDayContestQuestion($match_id)
    {
        $this->db->select('');
        $this->db->where("match_id",$match_id);
        $query =  $this->db->get('tbl_questions');
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }        
    }

    function get_question_date_by_question_id($question_id)
    {
        $this->db->select('datetime');
        $this->db->where("id",$question_id);
        $query =  $this->db->get('tbl_questions');
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            
            $val = $query->row();
            $datetime = $val->datetime;
            return $datetime;
        }
    }

    function get_match_date_by_match_id($match_id)
    {
        $this->db->select('match_date');
        $this->db->where("id",$match_id);
        $query =  $this->db->get('tbl_match');
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            
            $val = $query->row();
            $match_date = $val->match_date;
            return $match_date;
        }
    }

    function enter_match_day_contest_answer($match_id){
        $user_id = $this->session->userdata('contestant_id');

        $match_date = $this->get_match_date_by_match_id($match_id);
        $current_date = date('Y-m-d H:i:s');
        //$difference = $this->dateDiff($current_date, $match_date);
        $difference = $this->calculate_remaining_time($match_date);
        //echo 'difference = '.$difference;
        //echo '<br>Is Answered = '.$this->check_if_already_answered($match_id);
        if($this->check_if_already_answered($match_id)==0 && $difference>0)
        {
            for($i=1;$i<=4;$i++)
            {
                if(isset($_POST['question_id_'.$i]) && (isset($_POST['answer_'.$i]) || isset($_POST['answer1_'.$i]) || isset($_POST['answer2_'.$i])))
                {
                    $data='';
                    $data = array(
                        'match_id' => $match_id,
                        'user_id' => $user_id,
                        'question_id' => $this->input->post('question_id_'.$i)
                    );
                    if($i==2)
                        $data['answer'] = $this->input->post('answer1_'.$i).'-'.$this->input->post('answer2_'.$i);
                    else
                        $data['answer'] = $this->input->post('answer_'.$i);
                    $this->db->insert('tbl_answer',$data);
                    $aid = $this->db->insert_id(); 
                }
            }
            return $aid;
        }
        else{
            return 0;
        }
    }

    function check_if_already_answered($match_id)
    {        
        $user_id = $this->session->userdata('contestant_id');
        $this->db->select('');
        $this->db->where("match_id",$match_id);
        $this->db->where("user_id",$user_id);
        $query =  $this->db->get('tbl_answer');
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            return 1;
        }
    }

    function check_if_already_answered_by_question_id($question_id)
    {        
        $user_id = $this->session->userdata('contestant_id');
        $this->db->select('');
        $this->db->where("question_id",$question_id);
        $this->db->where("user_id",$user_id);
        $query =  $this->db->get('tbl_answer');
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            return 1;
        }
    }

    function get_correct_answer_by_question_id($question_id)
    {
        $this->db->select('answer,contest_type');
        $this->db->where("id",$question_id);
        $query =  $this->db->get('tbl_questions');
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            
            $val = $query->row();
            $answer = $val->answer;
            return $answer;
        }
    }

    function get_correct_answer_n_contest_type_by_question_id($question_id)
    {
        $this->db->select('answer,contest_type');
        $this->db->where("id",$question_id);
        $query =  $this->db->get('tbl_questions');
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            
            $val = $query->row();
            $answer = $val->answer;
            $result['contest_type'] = $val->contest_type;
            $result['answer'] = $val->answer;
            return $result;
        }
    }

    function get_user_answer_by_question_id($question_id)
    {        
        $user_id = $this->session->userdata('contestant_id');
        $this->db->select('answer');
        $this->db->where("question_id",$question_id);
        $this->db->where("user_id",$user_id);
        $query =  $this->db->get('tbl_answer');
        if ($query->num_rows() == 0) {
            return 0;
        } else {            
            $val = $query->row();
            $answer = $val->answer;
            return $answer;
        }
    }

    function getUltimateContestQuestion(){
        $this->db->select('');
        $this->db->where("contest_type",'2');
        $query =  $this->db->get('tbl_questions');
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        } 

    }

    function enter_ultimate_contest_answer(){
        $user_id = $this->session->userdata('contestant_id');
        //print_r($_POST);
        if($this->check_if_already_answered('0')==0)
        {
            for($i=1;$i<=5;$i++)
            {
                
                if(isset($_POST['question_id_'.$i]) && (isset($_POST['answer_'.$i]) || isset($_POST['answer1_'.$i]) || isset($_POST['answer2_'.$i])))
                {
                    $data='';
                    $data = array(
                        'user_id' => $user_id,
                        'question_id' => $this->input->post('question_id_'.$i)
                    );
                    $question_id = $_POST['question_id_'.$i];
                    if($i==1 && isset($_POST['answer1_'.$i]) && isset($_POST['answer2_'.$i]))
                    {                
                        $data['answer'] = $_POST['answer1_'.$i].','.$_POST['answer2_'.$i];
                    }
                    else
                        $data['answer'] = $_POST['answer_'.$i];
                    //print_r($data);
                    //echo $question_id.' -- '.$answer.'<br>';            
                    $this->db->insert('tbl_answer',$data);
                    $aid = $this->db->insert_id();
                }
                
            }
            return $aid;
        }
    }

    function all_time_contest(){        
        $this->db->select('');
        $this->db->where("contest_type",'3');
        $this->db->group_by('datetime');
        $query =  $this->db->get('tbl_questions');
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        } 
    }

    function all_time_contest_questions($question_id){
        $datetime = $this->get_datetime($question_id);
        $this->db->select('');
        $this->db->where("datetime",$datetime);
        $query =  $this->db->get('tbl_questions');
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }    

    function enter_all_time_contest_answer(){
        $user_id = $this->session->userdata('contestant_id');
        $question_id = $this->uri->segment(2);
        //print_r($_POST);
        
        if($this->check_if_already_answered_by_question_id($question_id)==0)
        {
            for($i=1;$i<=4;$i++)
            {
                if(isset($_POST['question_id_'.$i]) && isset($_POST['answer_'.$i]))
                {
                    $data='';
                    $data = array(
                        'user_id' => $user_id,
                        'question_id' => $this->input->post('question_id_'.$i),
                        'answer' => $this->input->post('answer_'.$i)
                    );
                    $question_id = $_POST['question_id_'.$i];
                        $data['answer'] = $_POST['answer_'.$i];        
                    $this->db->insert('tbl_answer',$data);
                    $aid = $this->db->insert_id(); 
                }
            }
            return $aid;
        }
    }

    function get_datetime($question_id)
    {        
        $this->db->select('datetime');
        $this->db->where('id',$question_id);
        $q = $this->db->get('tbl_questions');
        $data1 = $q->result_array();
        $data = array_shift($data1);
        return $data['datetime'];
    }

    public function get_all_countries(){
        $this->db->select('*');
        $this->db->order_by("country_name","ASC");
        $query =  $this->db->get('tbl_country');
        //echo "SELECT * FROM ".$this->table_country." LIMIT ".$limit.", ".$offset;
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

    function calculateUserScore()
    {
        $user_id = $this->session->userdata('contestant_id');
        //if contest_type = 1, score = 10
        //if contest_type = 2, score = 100
        //if contest_type = 3, score = 10

        $this->db->select();
        $this->db->where('user_id',$user_id);
        $query = $this->db->get('tbl_answer');  
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            $totalScore = 0;
            $results = $query->result();
            foreach($results as $row){
                $result = $this->get_correct_answer_n_contest_type_by_question_id($row->question_id);
                $correctAnswer = $result['answer'];
                $contest_type = $result['contest_type']; 
                $userAnswer = $row->answer;
                if($correctAnswer==$userAnswer)
                {
                    if($contest_type==1 || $contest_type==3)
                        $totalScore+=10;
                    elseif($contest_type==2)
                        $totalScore+=100;
                }
            }
        } 
        return $totalScore;
    }

    function calculate_point_by_contest_type($contest_type)
    {
        $user_id = $this->session->userdata('contestant_id');
        //if contest_type = 1, score = 10
        //if contest_type = 2, score = 100
        //if contest_type = 3, score = 10

        $this->db->select('tbl_questions.contest_type,tbl_answer.question_id,tbl_answer.answer');    
        $this->db->from('tbl_answer');
        $this->db->join('tbl_questions', 'tbl_questions.id = tbl_answer.question_id');
        $this->db->where('tbl_questions.contest_type',$contest_type);
        $this->db->where('tbl_answer.user_id',$user_id);
        $query = $this->db->get(); 
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            $totalScore = 0;
            $results = $query->result();
            foreach($results as $row){
                $result = $this->get_correct_answer_n_contest_type_by_question_id($row->question_id);
                $correctAnswer = $result['answer'];
                //$contest_type = $result['contest_type']; 
                $userAnswer = $row->answer;
                //echo $correctAnswer.' -- '.$userAnswer;
                if($correctAnswer==$userAnswer)
                {
                    if($contest_type==1 || $contest_type==3)
                        $totalScore+=10;
                    elseif($contest_type==2)
                        $totalScore+=100;
                }
            }
        } 
        return $totalScore;
    }

    function calculate_knockout_point()
    {
        $user_id = $this->session->userdata('contestant_id');
        //if contest_type = 1, score = 10
        //if contest_type = 2, score = 100
        //if contest_type = 3, score = 10

        $this->db->select();
        $this->db->where('user_id',$user_id);
        $query = $this->db->get('tbl_answer');  
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            $totalScore = 0;
            $results = $query->result();
            foreach($results as $row){
                $result = $this->get_correct_answer_n_contest_type_by_question_id($row->question_id);
                $correctAnswer = $result['answer'];
                //$contest_type = $result['contest_type']; 
                $userAnswer = $row->answer;
                $totalScore+=100;
            }
        } 
        return $totalScore;
    }

    function calculate_football_knowledge_point()
    {
        $user_id = $this->session->userdata('contestant_id');
        //if contest_type = 1, score = 10
        //if contest_type = 2, score = 100
        //if contest_type = 3, score = 10

        $this->db->select();
        $this->db->where('user_id',$user_id);
        $query = $this->db->get('tbl_answer');  
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            $totalScore = 0;
            $results = $query->result();
            foreach($results as $row){
                $result = $this->get_correct_answer_n_contest_type_by_question_id($row->question_id);
                $correctAnswer = $result['answer'];
                $contest_type = $result['contest_type']; 
                $userAnswer = $row->answer;
                $totalScore+=10;
            }
        } 
        return $totalScore;
    }

    function calculateDateDiff($fromDate, $toDate)
    {
        /*$start  = date_create($fromDate);
        $end    = date_create($toDate);
        echo $start.' -- '.$end;*/
        $start=strtotime($fromDate);
        $end=strtotime($toDate);
        $diff = $end-$start;

       /* echo 'The difference is ';
        echo  $diff->y . ' years, ';
        echo  $diff->m . ' months, ';
        echo  $diff->d . ' days, ';
        echo  $diff->h . ' hours, ';
        echo  $diff->i . ' minutes, ';
        echo  $diff->s . ' seconds';*/
        // Output: The difference is 28 years, 5 months, 19 days, 20 hours, 34 minutes, 36 seconds
        //echo 'The difference in hours : ' . $diff->h;
        //echo 'The difference in days : ' . $diff->days;
        // Output: The difference in days : 10398
            return $diff;
    }

    function dateDiff($fromDate, $toDate)
    {
        
        //$matchdatetime = $match_info[0]->match_date;
        $dt = new DateTime($toDate);
        $date = $dt->format('Y-m-d H:i:s');

        $today = strtotime(date("Y-m-d H:i:s"));
        $date    = strtotime($date);

        $datediff = $date - $today;
        //$difference = floor($datediff/(60*60*24));
        $difference = gmdate("H", $datediff);

        $hours = floor($datediff / 3600);
        $minutes = floor(($datediff / 60) % 60);
        $seconds = $datediff % 60;

        $hms = "$hours:$minutes:$seconds";
        return $hours;
    }

    function checkifActive($date)
    {
        $dt = new DateTime($date);
        $date = $dt->format('Y-m-d H:i:s');

        $today = strtotime(date("Y-m-d H:i:s"));
        $date    = strtotime($date);

        $datediff = $today-$date;
        return $datediff;
    }



    function calculate_remaining_time($date)
    {
        $dt = new DateTime($date);
        $date = $dt->format('Y-m-d H:i:s');

        $today = strtotime(date("Y-m-d H:i:s"));
        $date    = strtotime($date);

        $datediff = $date-$today;
        return $datediff;
    }

    public function get_all_registered_user(){
        $this->db->select('*');
        $this->db->from('tbl_participants');
        $this->db->order_by("id","ASC");
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

    function get_total_score_by_user_id($user_id)
    {
        //$user_id = $this->session->userdata('user_id');
        //if contest_type = 1, score = 10
        //if contest_type = 2, score = 100
        //if contest_type = 3, score = 10

        $this->db->select();
        $this->db->where('user_id',$user_id);
        $query = $this->db->get('tbl_answer');  
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            $totalScore = 0;
            $results = $query->result();
            foreach($results as $row){
                $result = $this->get_correct_answer_n_contest_type_by_question_id($row->question_id);
                $correctAnswer = $result['answer'];
                $contest_type = $result['contest_type']; 
                $userAnswer = $row->answer;
                if($correctAnswer==$userAnswer)
                {
                    if($contest_type==1 || $contest_type==3)
                        $totalScore+=10;
                    elseif($contest_type==2)
                        $totalScore+=100;
                }
            }
        } 
        return $totalScore;
    }
}

/* End of file Home_model.php
 * Location: ./application/modules/home/models/Home_model.php */

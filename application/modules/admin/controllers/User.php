<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User Controller
 * @user Controller
 * @subuser Controller
 * Date created:August 04, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class User extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('general_model');
        $this->load->library('multiupload');
    }

    public function index(){
    }

    public function deleteUser($pid){

        if (!isset($pid))
            redirect(base_url() . 'admin/User');

        if (!is_numeric($pid))
            redirect(base_url() . 'admin/User');

        $this->User_model->delete_user($pid);
        $this->session->set_flashdata('success', 'User Deleted Successfully...');
        $redirect =base_url() . 'admin/User/registration_numbers/'.$this->uri->segment(5).'/'.$this->uri->segment(6); 
        //echo $redirect;
        redirect($redirect, 'refresh');
    }

    public function removeUser($uid){

        if (!isset($uid))
            redirect(base_url() . 'admin/User/registered/all');

        if (!is_numeric($uid))
            redirect(base_url() . 'admin/User/registered/all');

        $this->User_model->remove_user($uid);
        $this->session->set_flashdata('success', 'User Removed Successfully...');
        $redirect = base_url() . 'admin/User/registered/'.$this->uri->segment(5).'/'.$this->uri->segment(6); 
        redirect($redirect, 'refresh');
    }

    public function registered($region)
    {
        $config['base_url'] = base_url() . 'admin/User/registered/'.$this->uri->segment(4);
        //$config['uri_segment'] = 3;
        $config['per_page'] = 50;

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

        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
        //echo $page;
        $total_rows = $this->User_model->count_all_registered_user($region);
        //echo $total_rows; exit();
        $config['total_rows'] = $total_rows;
        //echo $this->User_model->count_all_registered_user($region);
        $data['user_info'] = $this->User_model->get_all_registered_user($config['per_page'], $page,$region);
        

        $this->pagination->initialize($config);

        $data['title'] = '.:: User ::.';
        $data['page_header'] = 'User';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'User';
        $data['panel_title'] = 'User List';
        $data['main'] = 'user_registered';
        //$data['organisation_type'] =$this->general_model->getAll('dropdown','fid = 6','','id,dropvalue');

        $this->load->view('home', $data);
    }

    public function registration_numbers($region){

        $config['base_url'] = base_url() . 'admin/User/registration_numbers/'.$region;
        //$config['uri_segment'] = 10;
        $config['per_page'] = 50;

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

        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

        $search_region = $region.'-';
        $config['total_rows'] = $this->User_model->count_all_users($search_region);
        $data['user_info'] = $this->User_model->get_all_user($config['per_page'], $page, $search_region);
        

        $this->pagination->initialize($config);

        $data['title'] = '.:: User ::.';
        $data['page_header'] = 'User';
        $data['page_header_icone'] = 'fa-users';
        $data['nav'] = 'User';
        $data['panel_title'] = 'User List';
        $data['main'] = 'user_registration_numbers';
        //$data['organisation_type'] =$this->general_model->getAll('dropdown','fid = 6','','id,dropvalue');

        $this->load->view('home', $data);
    }

    public function listAll($pid){

        if (!isset($pid))
            redirect(base_url() . 'admin/User');

        if (!is_numeric($pid))
            redirect(base_url() . 'admin/User');

        $data['title'] = '.:: VIEW User ::.';
        $data['page_header'] = 'View User ';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'User';
        $data['panel_title'] = 'View User  ';
        $data['main'] = 'user_show_list';
        $data['user_info'] = $this->User_model->get_all_by_aid($pid);

        $this->load->view('home', $data);
    }

    public function add(){
        $data['title'] = '.:: ADD Registration Number ::.';
        $data['page_header'] = 'Registration Number ';
        $data['page_header_icone'] = 'fa-gift';
        $data['nav'] = 'User';
        $data['panel_title'] = 'Add Registration Number  '; 
        $where = array('parent_id'=>'0'); 
        $orderBy = array('region ASC'); 
        $data['main_region'] = $this->general_model->getAll('tbl_regions',$where);
        $order_by = 'id ASC';  
        $data['main'] = 'user_add_edit';
        //echo "lang = ".$this->session->lang;
        $this->load->view('home', $data);
    }

    public function addUser(){

        $this->form_validation->set_rules('registration_number', 'registration_number', 'required');
        //echo $this->session->lang;
        if (FALSE == $this->form_validation->run()) {
            $data['title'] = '.:: ADD User ::.';
            $data['page_header'] = 'User';
            $data['page_header_icone'] = 'fa-product-hunt';
            $data['nav'] = 'User';
            $data['panel_title'] = 'Add User ';
            
            $data['main'] = 'user_add_edit';

            $this->load->view('home', $data);

        } else {
            $reg_code_arr = explode('-',$this->input->post('registration_number'));
            $reg_code = $reg_code_arr['0'].'-'.$reg_code_arr['1'];
            $pid = $this->User_model->add_user();
            $this->session->set_flashdata('success', 'User added Successfully...');
            redirect(base_url() . 'admin/User/registration_numbers/'.$reg_code, 'refresh');
        }
    }  

    public function edit($id){

        if (!isset($id))
            redirect(base_url() . 'admin/User');

        if (!is_numeric($id))
            redirect(base_url() . 'admin/User');

        $data['title'] = '.:: EDIT User ::.';
        $data['page_header'] = 'User';
        $data['page_header_icone'] = 'fa-User';
        $data['nav'] = 'User';
        $data['panel_title'] = 'Edit User ';
        $where = array('parent_id'=>'0'); 
        $orderBy = array('region ASC'); 
        $data['main_region'] = $this->general_model->getAll('tbl_regions',$where);
        //getAll($table, $where = NULL, $orderBy = NULL, $select = NULL, $group_by = NULL,$limit = NULL) {
        $order_by = 'fullname ASC';  
        
        //$data['user_detail'] = $this->User_model->get_all_registered_user_info($id);

        $data['user_detail'] = $user_detail = $this->general_model->getById('tbl_user','id',$id);
        $registration_number = $user_detail->registration_number;
        $data['user_photo_detail'] = $this->general_model->getById('tbl_photo','user_id',$registration_number);
        //echo $this->db->last_query();

        $data['metallica'] = $this->User_model->getPattern_by_shade('Metallica');
        $data['nonmetallica'] = $this->User_model->getPattern_by_shade('Non - metallica');

        $data['main'] = 'user_add_edit';

        $this->load->view('home', $data);
    }

    public function editUser($pid){

        if (!isset($pid))
            redirect(base_url() . 'admin/User');

        if (!is_numeric($pid))
            redirect(base_url() . 'admin/User');

        
        $this->form_validation->set_rules('registration_number', 'registration_number', 'required');

        if (FALSE == $this->form_validation->run()) {
            $data['title'] = '.:: EDIT User ::.';
            $data['page_header'] = 'User';
            $data['page_header_icone'] = 'fa-gift';
            $data['nav'] = 'User';
            $data['panel_title'] = 'Edit User ';
            $data['User_detail'] = $this->general_model->getById('tbl_user','id',$pid);
            $data['main'] = 'User/edit/'.$pid;

            $this->load->view('home', $data);

        } else {
            
            $a = $_FILES['image']['name'];

            if ($a !== "") {
                $registration_number = strtolower($_POST['registration_number']);
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $filename = $registration_number.".".$ext;

                $imagepath = $this->general_model->getImagepath($registration_number);
                //echo $imagepath;
                $config['upload_path'] = './././'.$imagepath;
                $config['log_threshold'] = 1;
                $config['allowed_types'] = 'jpg|png|jpeg|gif';
                $config['max_size'] = '100000'; // 0 = no file size limit
                $config['file_name'] = $filename;
                $config['overwrite'] = false;
                $this->load->library('upload', $config);
                $this->upload->do_upload('image');
                $upload_data = $this->upload->data();
                $image = $upload_data['file_name'];
            }
            if(!isset($image))  $image = '';
            if(!isset($imagepath))  $imagepath = '';

            $this->User_model->update_user($pid,$image,$imagepath);
            $this->session->set_flashdata('success', 'User Updated Successfully...');
            redirect(base_url() . 'admin/User/edit/'.$pid, 'refresh');
        }
    }


    function get_users(){
        if (isset($_GET['term'])){
          $q = strtolower($_GET['term']);
          $this->User_model->get_user($q);
        }
    }

    function get_sub_regions($parent_id){        
      //$main_region = $this->input->post("value");
      //echo "main_region =".$main_region;
        //$parent_id = $_REQUEST['parent_id'];
        //$option = "<option value='".$parent_id."' >".$parent_id."</option>";
        //echo $option;
      /*$data = $this->User_model->get_sub_region($parent_id);
      $option ="";
      foreach($data as $d)
      {
         $option .= "<option value='".$d->id."' >".$d->region."</option>";
      }
       echo "option = ".$option;*/
       $result = $this->db->where("parent_id",$parent_id)->get("tbl_regions")->result();
       ?>
       <script>
       alert("<?php echo json_encode($result);?>");
       </script>
       <?php
       echo json_encode($result);
    }

    function showSubregion()
    {
        $main_region = $this->uri->segment(4);
        $subregion = $this->User_model->getSubregions_by_main_region($main_region);
        
        $required = '';
        if($subregion)
            $required = 'required';
        $selectbox = '
        <option value="">Sub Region</option>
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
        echo $selectbox;
    }
}

/* End of file User.php
 * Location: ./application/modules/admin/controllers/User.php */
<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Country Controller
 * @country Controller
 * @subcountry Controller
 * Date created:August 04, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class Country extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Country_model');
        $this->load->model('general_model');
    }

    public function index(){

        $config['base_url'] = base_url() . 'admin/Country';
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

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        
        $config['total_rows'] = $this->db->count_all('tbl_country');
        $data['country_info'] = $this->Country_model->get_all_country($config['per_page'], $page);
        

        $this->pagination->initialize($config);

        $data['title'] = '.:: Country ::.';
        $data['page_header'] = 'Country';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'Country';
        $data['panel_title'] = 'Country List';
        $data['main'] = 'country_list';
        //$data['organisation_type'] =$this->general_model->getAll('dropdown','fid = 6','','id,dropvalue');

        $this->load->view('home', $data);
    }

    public function deleteCountry($pid){

        if (!isset($pid))
            redirect(base_url() . 'admin/Country');

        if (!is_numeric($pid))
            redirect(base_url() . 'admin/Country');

        $this->Country_model->delete_country($pid);
        $this->session->set_flashdata('success', 'Country Deleted Successfully...');
        redirect(base_url() . 'admin/Country', 'refresh');
    }

    public function listAll($pid){

        if (!isset($pid))
            redirect(base_url() . 'admin/Country');

        if (!is_numeric($pid))
            redirect(base_url() . 'admin/Country');

        $data['title'] = '.:: VIEW Country ::.';
        $data['page_header'] = 'View Country ';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'Country';
        $data['panel_title'] = 'View Country  ';
        $data['main'] = 'country_show_list';
        $data['country_info'] = $this->Country_model->get_all_by_aid($pid);

        $this->load->view('home', $data);
    }

    public function add(){
        $data['title'] = '.:: ADD Country ::.';
        $data['page_header'] = 'Country ';
        $data['page_header_icone'] = 'fa-gift';
        $data['nav'] = 'Country';
        $data['panel_title'] = 'Add Country  '; 
        $order_by = 'id ASC';  
        $data['main'] = 'country_add_edit';
        //echo "lang = ".$this->session->lang;
        $this->load->view('home', $data);
    }

    public function addCountry(){

        $this->form_validation->set_rules('country_name', 'country_name', 'required');
        //echo $this->session->lang;
        if (FALSE == $this->form_validation->run()) {
            $data['title'] = '.:: ADD Country ::.';
            $data['page_header'] = 'Country';
            $data['page_header_icone'] = 'fa-flag';
            $data['nav'] = 'Country';
            $data['panel_title'] = 'Add Country ';
            
            $data['main'] = 'country_add_edit';

            $this->load->view('home', $data);

        } else {

            $pid = $this->Country_model->add_country();
            $this->session->set_flashdata('success', 'Country added Successfully...');
            redirect(base_url() . 'admin/Country', 'refresh');
        }
    }  

    public function edit($id){

        if (!isset($id))
            redirect(base_url() . 'admin/Country');

        if (!is_numeric($id))
            redirect(base_url() . 'admin/Country');

        $data['title'] = '.:: EDIT Country ::.';
        $data['page_header'] = 'Country';
        $data['page_header_icone'] = 'fa-flag';
        $data['nav'] = 'Country';
        $data['panel_title'] = 'Edit Country ';
        $data['country_detail'] = $this->general_model->getById('tbl_country','id',$id);
        $data['main'] = 'country_add_edit';

        $this->load->view('home', $data);
    }

    public function editCountry($pid){

        if (!isset($pid))
            redirect(base_url() . 'admin/Country');

        if (!is_numeric($pid))
            redirect(base_url() . 'admin/Country');

        
        $this->form_validation->set_rules('country_name', 'country_name', 'required');

        if (FALSE == $this->form_validation->run()) {
            $data['title'] = '.:: EDIT Country ::.';
            $data['page_header'] = 'Country';
            $data['page_header_icone'] = 'fa-flag';
            $data['nav'] = 'Country';
            $data['panel_title'] = 'Edit Country ';
            $data['Country_detail'] = $this->general_model->getById('tbl_country','id',$pid);
            $data['main'] = 'Country/edit/'.$pid;

            $this->load->view('home', $data);

        } else {

            $this->Country_model->update_country($pid);
            $this->session->set_flashdata('success', 'Country Updated Successfully...');
            redirect(base_url() . 'admin/Country/edit/'.$pid, 'refresh');
        }
    }

    function addPlayer($country_id)
    {
        $data['title'] = '.:: ADD Player ::.';
        $data['page_header'] = 'Player';
        $data['page_header_icone'] = 'fa-users';
        $data['nav'] = 'Player';
        $data['panel_title'] = 'Add Player';
        $data['countries'] = $this->Country_model->get_all_countries(); 
        $data['country_id'] = $country_id;
        $data['main'] = 'player_add_edit';
        //echo "lang = ".$this->session->lang;
        $this->load->view('home', $data);
    }

    public function addPlayerProcess(){
        //print_r($_POST);
        $this->form_validation->set_rules('player_name', 'player_name', 'required');
        //echo $this->session->lang;
        if (FALSE == $this->form_validation->run()) {
            $data['title'] = '.:: ADD Player ::.';
            $data['page_header'] = 'Player';
            $data['page_header_icone'] = 'fa-users';
            $data['nav'] = 'Player';
            $data['panel_title'] = 'Add Player ';
            
            $data['main'] = 'player_add_edit';

            $this->load->view('home', $data);

        } else {

            $pid = $this->Country_model->add_player();
            $this->session->set_flashdata('success', 'Player added Successfully...');
            redirect(base_url() . 'admin/Country/addPlayer/'.$this->uri->segment(4), 'refresh');
        }
    } 

    function editPlayer($player_id)
    {
        $data['title'] = '.:: ADD Player ::.';
        $data['page_header'] = 'Player';
        $data['page_header_icone'] = 'fa-users';
        $data['nav'] = 'Player';
        $data['panel_title'] = 'Add Player';
        $data['countries'] = $this->Country_model->get_all_countries();
        $data['player_detail'] = $this->Country_model->get_player_info($player_id);
        $data['main'] = 'player_add_edit';
        //echo "lang = ".$this->session->lang;
        $this->load->view('home', $data);
    }

    public function editPlayerProcess($player_id,$country_id){
        //print_r($_POST);
        $this->form_validation->set_rules('player_name', 'player_name', 'required');
        //echo $this->session->lang;
        if (FALSE == $this->form_validation->run()) {
            $data['title'] = '.:: Edit Player ::.';
            $data['page_header'] = 'Player';
            $data['page_header_icone'] = 'fa-users';
            $data['nav'] = 'Player';
            $data['panel_title'] = 'Edit Player ';
            
            $data['main'] = 'player_add_edit';

            $this->load->view('home', $data);

        } else {

            $pid = $this->Country_model->update_player($player_id);
            $this->session->set_flashdata('success', 'Player updated Successfully...');
            redirect(base_url() . 'admin/Country/editPlayer/'.$this->uri->segment(4), 'refresh');
        }
    } 

    public function deletePlayer($country_id, $pid){

        if (!isset($pid))
            redirect(base_url() . 'admin/Country');

        if (!is_numeric($pid))
            redirect(base_url() . 'admin/Country');
        //echo $pid;
        $this->Country_model->delete_player($pid);
        $this->session->set_flashdata('success', 'Player Deleted Successfully...');
        redirect(base_url() . 'admin/Country/listPlayers/'.$country_id, 'refresh');
    }

    function listPlayers($country_id)
    {

        $data['title'] = '.:: List Players ::.';
        $data['page_header'] = 'Player sqad of '.$this->Country_model->get_country_name($country_id);
        $data['page_header_icone'] = 'fa-list';
        $data['nav'] = 'Country';
        $data['panel_title'] = 'List Players';
        $data['main'] = 'player_listall';
        $data['player_info'] = $this->Country_model->get_all_players($country_id);

        $this->load->view('home', $data);

    }

    function get_country(){
        if (isset($_GET['term'])){
          $q = strtolower($_GET['term']);
          $this->Country_model->get_country($q);
        }
    }
}

/* End of file Country.php
 * Location: ./application/modules/admin/controllers/Country.php */
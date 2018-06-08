<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Api Controller
 * @package Controller
 * @subpackage Controller
 * Date created:March 08, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class Api extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('api_model');
    }

    public function index(){
        //Do Nothing
    }
}

/* End of file Slider.php
 * Location: ./application/modules/api/controllers/Slider.php */

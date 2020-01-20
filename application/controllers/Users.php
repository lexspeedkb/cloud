<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function add10()
    {
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('Model_users');
        
        $this->Model_users->setBalance($_SESSION['id'], 10, '');
    	redirect('/');
    }

}

?>
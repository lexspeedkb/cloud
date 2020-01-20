<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bets extends CI_Controller {

    public function bet()
    {
        $this->load->library('session');
        $this->load->helper('html');
        $this->load->helper('url');
        $this->load->model('Model_auth');
        $this->load->model('Model_bet');
        $this->load->model('Model_history');

        $this->Model_auth->checkToken($_SESSION['id'], $_SESSION['token']);

        var_dump($_SESSION);
        return 1;
    }
}

?>
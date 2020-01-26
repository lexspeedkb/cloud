<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function index()
    {
        $this->load->library('session');
        $this->load->model('Model_files');
        $this->load->model('Model_auth');
        $this->load->helper('files');

        $this->Model_auth->checkToken($_SESSION['id'], $_SESSION['token']);

        $user = $this->Model_auth->getDataByToken($_SESSION['id'], $_SESSION['token']);

        $files = $this->Model_files->getFilesOfUser($user['id']);

        $data['allData']=0;
        foreach ($files as $file) {
            $data['allData'] += $file['filesize_o'] + $file['filesize_s'];
        }

        $data['allData'] = bytesConvert($data['allData']);
        $limit = bytesConvert(STORAGE_SIZE);
        $data['limit'] = $limit['size']." ".$limit['unit'];
        $data['user'] = $user;


        $this->load->view('include/nav', $data);
        $this->load->view('include/header', $data);

        $this->load->view('dashboard/index', $data);

        $this->load->view('include/snackbar', $data);
        $this->load->view('include/footer', $data);
    }
}

?>
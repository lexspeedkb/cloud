<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    private $user;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Model_files');
        $this->load->model('Model_admin');
        $this->load->model('Model_auth');
        $this->load->helper('files');

        $this->user = $this->Model_auth->getDataByToken($_SESSION['id'], $_SESSION['token']);
        if ($this->user['id']!=1) {
            header('HTTP/1.0 403 Forbidden');
            die();
        }
    }

    public function filesIndexing ()
    {
        $files = $this->Model_files->getAllFiles();

        foreach ($files as $file) {
            $path = getPath($file['src']);
            $file_o = $_SERVER['DOCUMENT_ROOT'].'/files/o/'.$path['text'] . $path['name'];
            $file_s = $_SERVER['DOCUMENT_ROOT'].'/files/s/'.$path['text'] . $path['name'];
            $filesize_o = filesize($file_o);
            $filesize_s = filesize($file_s);
            $this->Model_files->updateFileSize($file['id'], $filesize_o, $filesize_s);
        }
    }

    public function users ()
    {
        $data['user'] = $this->user;

        $data['users'] = $this->Model_admin->getAllUsers();

        $this->load->view('include/nav', $data);
        $this->load->view('include/header', $data);

        $this->load->view('admin/users', $data);

        $this->load->view('include/snackbar', $data);
        $this->load->view('include/footer', $data);
    }

}

?>
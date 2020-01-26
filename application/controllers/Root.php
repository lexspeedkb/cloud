<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function filesIndexing () {
        $this->load->library('session');
        $this->load->model('Model_files');
        $this->load->model('Model_auth');
        $this->load->helper('files');

        $user = $this->Model_auth->getDataByToken($_SESSION['id'], $_SESSION['token']);
        if ($user['id']!=1) {
            header('HTTP/1.0 403 Forbidden');
            die();
        }

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

}

?>
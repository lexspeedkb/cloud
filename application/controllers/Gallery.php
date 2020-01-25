<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller {

    public function index()
    {
        $this->load->library('session');
        $this->load->model('Model_files');
        $this->load->model('Model_auth');
        $this->load->helper('files');

        $this->Model_auth->checkToken($_SESSION['id'], $_SESSION['token']);

        $user = $this->Model_auth->getDataByToken($_SESSION['id'], $_SESSION['token']);

        $data['user'] = $user;

        if (empty($this->uri->segment(3))) {
            $ROOTfolder = $this->Model_auth->getRootFolder($user['id']);

            $data['files']   = $this->Model_files->getFiles($ROOTfolder['id']);
            $data['folders'] = $this->Model_files->getFolders($ROOTfolder['id']);

            $data['breadcrumbs'] = $this->breadcrumbs($ROOTfolder['id']);

            $data['current_folder'] = $ROOTfolder['id'];
        } else {
            if ($this->isOwner('dir', $this->uri->segment(3), $user['id'])!==true) {

                header('HTTP/1.0 403 Forbidden');
                die();
            }
            $data['files']   = $this->Model_files->getFiles($this->uri->segment(3));
            $data['folders'] = $this->Model_files->getFolders($this->uri->segment(3));

            $data['breadcrumbs'] = $this->breadcrumbs($this->uri->segment(3));

            $data['current_folder'] = $this->uri->segment(3);
        }

        foreach ($data['files'] as $key => $value) {
            $data['files'][$key]['path'] = getPath($value['src']);
        }

        foreach ($data['files'] as $key => $value) {
            $data['files'][$key]['type'] = getTypeByMIME($value['type']);
        }
        
        $this->load->view('include/nav', $data);
        $this->load->view('include/header', $data);
        $this->load->view('gallery/index', $data);

        $this->load->view('gallery/dialog-load', $data);
        $this->load->view('gallery/preview', $data);
        $this->load->view('gallery/options', $data);
        $this->load->view('gallery/actions', $data);
        $this->load->view('include/snackbar', $data);
        $this->load->view('include/footer', $data);
    }
}
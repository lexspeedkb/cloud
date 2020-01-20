<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function login()
    {
        $this->load->library('session');
        $this->load->helper('html');
        $this->load->helper('url');
        $this->load->model('Model_auth');
        $this->Model_auth->checkToken($_SESSION['id'], $_SESSION['token'], true);
        if (isset($_POST['log'])) {
            if ($_POST['log'] == 1) {
                $authReturn = $this->authorization($_POST);
                switch ($authReturn) {
                    case 0:
                        redirect('/', 'refresh');
                        break;
                    
                    case 1:
                        $data['errorMessage'] = 'Empty login';
                        break;
                    case 2:
                        $data['errorMessage'] = 'Empty password';
                        break;
                    case 3:
                        $data['errorMessage'] = 'Login incorrect';
                        break;
                }
            }
        }
        $this->load->view('include/login/header', $data);
        $this->load->view('login', $data);
        $this->load->view('include/login/footer', $data);
    }

    public function logup()
    {
        $this->load->library('session');
        $this->load->helper('html');
        $this->load->helper('url');
        $this->load->model('Model_auth');
        $this->Model_auth->checkToken($_SESSION['id'], $_SESSION['token'], true);
        if (isset($_POST['log'])) {
            if ($_POST['log'] == 1) {
                $authReturn = $this->Register($_POST);
                switch ($authReturn) {
                    case 0:
                        redirect('/auth/login', 'refresh');
                        break;
                    
                    case 1:
                        $data['errorMessage'] = 'Empty login';
                        break;
                    case 2:
                        $data['errorMessage'] = 'Empty password';
                        break;
                    case 3:
                        $data['errorMessage'] = 'Different passwords';
                        break;
                    
                    case 4:
                        $data['errorMessage'] = 'Login is buizy';
                        break;
                    case 5:
                        $data['errorMessage'] = 'Empty name';
                        break;
                }
            }
        }
        
        $this->load->view('include/login/header', $data);
        $this->load->view('logup', $data);
        $this->load->view('include/login/footer', $data);
    }

    public function Register($data)
    {
        if (empty($data['login'])) return 1;
        if (empty($data['name'])) return 5;
        if (empty($data['password'])) return 2;
        if ($data['password']!=$data['password_re']) return 3;
        
        $dataByLogin = $this->Model_auth->getDataByLogin($data['login']);
        if (!empty($dataByLogin['id'])) {
            return 4;
        } else {
            $this->Model_auth->register($data);
            return 0;
        }
    }

    public function authorization($data)
    {
        if (empty($data['login'])) return 1;
        if (empty($data['password'])) return 2;
        $checkLogin = $this->Model_auth->checkLogin($data['login'], $data['password']);
        
        if ($checkLogin == 0) {
            $newToken = $this->generateRandomString(100);
            $userData = $this->Model_auth->getDataByLogin($data['login']);
            $array = array(
                'id' => $userData['id'],
                'token' => $newToken,
            );
            $this->Model_auth->updateToken($userData['id'], $newToken);
            $this->session->set_userdata($array);
            return 0;
        } else {
            return 3;
        }
        
    }

    public function exit()
    {
        $this->load->library('session');
        $this->load->helper('url');
        
        $this->session->sess_destroy();
        redirect('/', 'refresh');
    }

    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

?>
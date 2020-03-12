<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

//    private $user;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Model_files');
        $this->load->model('Model_auth');
        $this->load->helper('files');

        $this->user = $this->Model_auth->getDataByToken($_SESSION['id'], $_SESSION['token']);
    }

    public function getSession() {
        print_r($_SESSION);
    }

    public function getAllUserPhotos () {
        $files = $this->Model_files->getFilesOfUser(2);

        foreach ($files as $key => $value) {
            $p = getPath($value['src']);
            $files[$key]['path'] = $p['text'];
        }

        $files = array_reverse($files);

//        foreach ($files as $key => $value) {
//            $p = getTypeByMIME($value['type']);
//            $files[$key]['type'] = $p['text'];
//        }

//        echo "<pre>";
//        print_r($files);

        $items = $this->arrToApi($files, TRUE);

//        echo "<pre>";
//        print_r($items);

        $json = json_encode($items);

        echo $json;

    }

    public function changeName () {
        $this->Model_files->updateName($_POST['id'], $_POST['value']);
    }

//    AUTH

    public function auth () {
        if (isset($_POST['log'])) {
            if ($_POST['log'] == 1) {
                $authReturn = $this->authorization($_POST);
                switch ($authReturn) {
                    case 1:
                        echo 'Empty login';
                        break;
                    case 2:
                        echo 'Empty password';
                        break;
                    case 3:
                        echo 'Login incorrect';
                        break;
                    default:
                        $json = json_encode($authReturn);
                        echo $json;
                        break;

                }
            }
        }
    }

    public function checkToken() {
        var_dump($_POST);
        echo $this->Model_auth->checkToken($_POST['id'], $_POST['token']);
    }

    public function authorization($data)
    {
        if (empty($data['login'])) return 1;
        if (empty($data['password'])) return 2;
        $checkLogin = $this->Model_auth->checkLogin($data['login'], $data['password']);

        if ($checkLogin == 0) {
            $newToken = generateRandomString(100);
            $userData = $this->Model_auth->getDataByLogin($data['login']);
            $array = array(
                'id' => $userData['id'],
                'token' => $newToken,
            );
            $this->Model_auth->updateToken($userData['id'], $newToken);
            return $array;
        } else {
            return 3;
        }

    }

    private function arrToApi ($array, $multi=FALSE) {
        if ($multi) {
            $get = array();
            foreach ($array as $item) {
                array_push($get, $item);
            }

            $items = array('items' => $get);

            return $items;
        } else {

        }
    }
}

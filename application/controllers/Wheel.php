<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wheel extends CI_Controller {

    public function index()
    {
        $this->load->library('session');
        $this->load->model('Model_files');
        $this->load->model('Model_auth');

        $this->Model_auth->checkToken($_SESSION['id'], $_SESSION['token']);

        $user = $this->Model_auth->getDataByToken($_SESSION['id'], $_SESSION['token']);
        $data['balance'] = $user['balance'];

        $data['files'] = $this->Model_files->getFiles($user['id']);

        foreach ($data['files'] as $key => $value) {
            $data['files'][$key]['path'] = $this->getPath($value['src']);
        }
        
        $this->load->view('include/nav', $data);
        $this->load->view('include/header', $data);
        $this->load->view('gallery', $data);
        $this->load->view('include/footer', $data);
    }

    private function getPath ($name) {
        $i=0;
        $array = array();

        while ($i <= 10) {
            $push = substr($name, $i, 2);
            $text .= $push."/";
            array_push($array, $push);
            $i+=2;
        }

        $return['text'] = $text;
        $return['array'] = $array;
        $return['name'] = $name;

        return $return;
    }

    public function get_wheel()
    {
        $this->load->model('Model_history');
        $this->load->model('Model_bet');

        $min = date('s');

        $lastGame    = $this->Model_history->getLastGame();
        $preLastGame = $this->Model_history->getPreLastGame();

        $timing = $this->time_elapsed_from_last_game($lastGame['time']);

        if ($min==0||$min==30||$min==60) {
            $data['lastGame'] = $lastGame['degree'];

            if ($timing >= 30) {
                $randomDegree = rand(0, 360);
                $data['degree'] = $randomDegree + 360*10;
                $data['win']    = $this->num_from_degree($randomDegree);

                $this->Model_history->addToHistory($randomDegree, $data['win']);
                $this->Model_bet->whoWin($data['win']);
            } else {
                $data['degree'] = $lastGame['degree'];
                $data['win']    = $this->num_from_degree($lastGame['degree']);
                $data['loaded'] = 1;
            }
        } else {
            $data['degree'] = $lastGame['degree'];
            $data['win']    = $this->num_from_degree($lastGame['degree']);
            $data['loaded'] = 1;
        }

        if ($data['lastGame'] == $data['degree']) {
            $data['lastGame'] = $preLastGame['degree'] + 360*10;
        }

        $this->load->view('wheel', $data);
    }

    public function get_history()
    {
        $this->load->model('Model_history');

        $data['history'] = $this->Model_history->getHistory();

        $this->load->view('include/history', $data);
    }

    /* 
    1) 353 - 64
    2) 281 - 352
    3) 209 - 280
    4) 137 - 208
    5) 65 - 136
    353 - exit
    */
    private function num_from_degree($degree)
    {
        if ($degree >=353 && $degree <=360 || $degree >=0 && $degree <=64 )
            return 1;
        if ($degree >=281 && $degree <=352)
            return 2;
        if ($degree >=209 && $degree <=280)
            return 3;
        if ($degree >=137 && $degree <=208)
            return 4;
        if ($degree >=65 && $degree <=136)
            return 5;
    }

    public function time_elapsed_from_last_game($lastGame)
    {
        return strtotime(date("Y-m-d H:i:s")) - strtotime($lastGame)-3600;
    }
}

<?php
class Model_files extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function getFiles($user_id)
    {
        $query = $this->db->query("SELECT * FROM files WHERE user_id='$user_id' ORDER BY id DESC");

        foreach ($query->result_array() as $row) {
            $files[$i]['id']        = $row['id'];
            $files[$i]['src']       = $row['src'];
            $files[$i]['name']      = $row['name'];
            $files[$i]['user_id']   = $row['user_id'];
            $i++;

        }
        return $files;
    }

    public function getOneFile($id)
    {
        $query = $this->db->query("SELECT * FROM files WHERE id='$id'");

        foreach ($query->result_array() as $row) {
            $file['id']        = $row['id'];
            $file['src']       = $row['src'];
            $file['name']      = $row['name'];
            $file['user_id']   = $row['user_id'];
        }
        return $file;
    }

    public function delete ($id) {
        $file = $this->getOneFile($id);

        $file['path'] = $this->getPath($file['src']);

        $this->db->query("DELETE FROM files WHERE id='$id'");

        $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/files/';
        $dirs_o = $uploaddir.'o/';
        $dirs_s = $uploaddir.'s/';

        $file_o = $dirs_o.$file['path']['text'].$file['path']['name'];
        $file_s = $dirs_s.$file['path']['text'].$file['path']['name'];

        unlink($file_o);
        unlink($file_s);
    }


    public function uploadFile($src, $user_id)
    {
        $name    = $_POST['name'];
        $this->db->query("INSERT INTO files (src, name, user_id) VALUES ('$src', '$name', '$user_id')");
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

}
?>
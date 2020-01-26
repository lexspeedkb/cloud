<?php
class Model_files extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function getFiles($dir_id)
    {
        $query = $this->db->query("SELECT * FROM files WHERE dir='$dir_id' ORDER BY id DESC");

        foreach ($query->result_array() as $row) {
            foreach ($row as $key => $value) {
                $files[$i][$key] = $value;
            }
            $i++;

        }
        return $files;
    }

    public function getAllFiles()
    {
        $query = $this->db->query("SELECT * FROM files ORDER BY id DESC");

        foreach ($query->result_array() as $row) {
            foreach ($row as $key => $value) {
                $files[$i][$key] = $value;
            }
            $i++;

        }
        return $files;
    }

    public function getFilesOfUser($user_id)
    {
        $query = $this->db->query("SELECT * FROM files WHERE user_id='$user_id'");

        foreach ($query->result_array() as $row) {
            foreach ($row as $key => $value) {
                $files[$i][$key] = $value;
            }
            $i++;

        }
        return $files;
    }

    public function getFolders($parent_id)
    {
        $query = $this->db->query("SELECT * FROM dirs WHERE parent_id='$parent_id' ORDER BY id DESC");

        foreach ($query->result_array() as $row) {
            foreach ($row as $key => $value) {
                $folders[$i][$key] = $value;
            }
            $i++;

        }
        return $folders;
    }

    public function getOneFile($type, $search)
    {
        switch ($type) {
            case 'id':
                $query = $this->db->query("SELECT * FROM files WHERE id='$search'");
                break;
            case 'name':
                $query = $this->db->query("SELECT * FROM files WHERE src='$search'");
                break;
            default:
                $query = $this->db->query("SELECT * FROM files WHERE id='$search'");
        }

        foreach ($query->result_array() as $row)
        {
            foreach ($row as $key => $value) {
                $file[$key] = $value;
            }
        }
        return $file;
    }

    public function getOneFolder($id)
    {
        $query = $this->db->query("SELECT * FROM dirs WHERE id='$id'");

        foreach ($query->result_array() as $row) {
            foreach ($row as $key => $value) {
                $folder[$key] = $value;
            }
        }
        return $folder;
    }

    public function delete ($id)
    {
        $this->load->helper('files');

        $file = $this->getOneFile('id', $id);

        $file['path'] = getPath($file['src']);

        $this->db->query("DELETE FROM files WHERE id='$id'");

        $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/files/';
        $dirs_o = $uploaddir.'o/';
        $dirs_s = $uploaddir.'s/';

        $file_o = $dirs_o.$file['path']['text'].$file['path']['name'];
        $file_s = $dirs_s.$file['path']['text'].$file['path']['name'];

        unlink($file_o);
        unlink($file_s);
    }

    public function deleteFolder ($id)
    {
        $this->db->query("DELETE FROM dirs WHERE id='$id'");
    }

    public function toggleFolderFree ($id, $toggle=true)
    {
        if ($toggle) {
            $this->db->query("UPDATE dirs SET free='1' WHERE id='$id'");
        } else {
            $this->db->query("UPDATE dirs SET free='0' WHERE id='$id'");
        }
    }

    public function uploadFile($src, $user_id, $type, $folder_id, $name, $filesize_o, $filesize_s)
    {
        $this->db->query("INSERT INTO files (src, name, user_id, type, dir, filesize_o, filesize_s) VALUES ('$src', '$name', '$user_id', '$type', '$folder_id', '$filesize_o', '$filesize_s')");
        return $insert_id = $this->db->insert_id();
    }

    public function addFolder($name, $owner_id, $parent_id)
    {
        $this->db->query("INSERT INTO dirs (name, owner_id, parent_id) VALUES ('$name', '$owner_id', '$parent_id')");
        $id = $this->db->insert_id();
        return $id;
    }

    public function updateName($id, $name)
    {
        $this->db->query("UPDATE files SET name='$name' WHERE id='$id'");
    }

    public function updateDirName($id, $name)
    {
        $this->db->query("UPDATE dirs SET name='$name' WHERE id='$id'");
    }

    public function updateFileSize ($id, $size_o, $size_s) {
        $this->db->query("UPDATE files SET filesize_o='$size_o' WHERE id='$id'");
        $this->db->query("UPDATE files SET filesize_s='$size_s' WHERE id='$id'");
    }


}
?>
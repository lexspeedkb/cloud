<?php
class Model_admin extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function getAllUsers ()
    {
        $query = $this->db->query("SELECT * FROM users ORDER BY id DESC");
        foreach ($query->result_array() as $row) {
            foreach ($row as $key => $value) {
                $users[$i][$key] = $value;
            }

            $i++;
        }

        return $users;
    }

}
?>
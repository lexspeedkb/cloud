<?php
class Model_users extends CI_Model {
    public function __construct()
    {
        $this->load->database();
    }

    public function setBalance($id, $summ, $desc)
    {
        $query = $this->db->query("SELECT balance FROM users WHERE id='$id'");
        $row = $query->row();

        $newBalance = $row->balance+$summ;
     
        $this->db->query("UPDATE users SET balance='$newBalance' WHERE id='$id'");
    }
}
?>
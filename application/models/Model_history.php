<?php
class Model_history extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function getHistory()
    {
        $query = $this->db->query("SELECT * FROM games ORDER BY id DESC");
    
        // $one = 0;
        // $two = 0;
        // $three = 0;
        // $four = 0;
        // $five = 0;
        foreach ($query->result_array() as $row) {
            $history[$i]['id']     = $row['id'];
            $history[$i]['degree'] = $row['degree'];
            $history[$i]['win']    = $row['win'];
            $history[$i]['one']    = $row['one'];
            $history[$i]['two']    = $row['two'];
            $history[$i]['three']  = $row['three'];
            $history[$i]['four']   = $row['four'];
            $history[$i]['five']   = $row['five'];
            $i++;

            // if ($row['win']==1) {
            //     $one++;
            // }
            // if ($row['win']==2) {
            //     $two++;
            // }
            // if ($row['win']==3) {
            //     $three++;
            // }
            // if ($row['win']==4) {
            //     $four++;
            // }
            // if ($row['win']==5) {
            //     $five++;
            // }
        }
        // echo $one." ".$two." ".$three." ".$four." ".$five;
        // die();
        
        return $history;
    }

    public function getLastGame()
    {
        
        $query = $this->db->query("SELECT * FROM games ORDER BY id DESC LIMIT 1");

        foreach ($query->result_array() as $row) {
            $history['id']     = $row['id'];
            $history['degree'] = $row['degree'];
            $history['win']    = $row['win'];
            $history['time']   = $row['time'];
            $history['one']    = $row['one'];
            $history['two']    = $row['two'];
            $history['three']  = $row['three'];
            $history['four']   = $row['four'];
            $history['five']   = $row['five'];
        }
        
        return $history;
    }

    public function getPreLastGame()
    {
        
        $query = $this->db->query("SELECT * FROM games ORDER BY id DESC LIMIT 1 OFFSET 1");

        foreach ($query->result_array() as $row) {
            $history['id']     = $row['id'];
            $history['degree'] = $row['degree'];
            $history['win']    = $row['win'];
            $history['time']   = $row['time'];
            $history['one']    = $row['one'];
            $history['two']    = $row['two'];
            $history['three']  = $row['three'];
            $history['four']   = $row['four'];
            $history['five']   = $row['five'];
        }
        
        return $history;
    }

    public function addToHistory($degree, $win)
    {
        $query = $this->db->query("INSERT INTO games (degree, win) VALUES ('$degree', '$win')");
    }

}
?>
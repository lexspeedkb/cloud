<?php
class Model_bet extends CI_Model {
    public function __construct()
    {
        $this->load->database();
    }

    public function addBet($user_id, $game_id, $price, $bet)
    {

        $query = $this->db->query("SELECT * FROM users WHERE id='$user_id'");
        foreach ($query->result_array() as $row) {
            $balance = $row['balance'];
        }

        $newBalance = $balance - $price;

        if ($newBalance < 0) {
            die('2');
        }

        $this->db->query("UPDATE users SET balance='$newBalance' WHERE id='$user_id'");

        $this->db->query("INSERT INTO bets (game_id, user_id, price, bet) VALUES ('$game_id', '$user_id', '$price', '$bet')");
    }

    public function whoWin($win)
    {
        $query = $this->db->query("SELECT * FROM games ORDER BY id DESC LIMIT 1");

        foreach ($query->result_array() as $row) {
            $lastGameID = $row['id'];
        }

        $query = $this->db->query("SELECT * FROM bets WHERE game_id='$lastGameID' AND bet='$win'");
        $i=0;
        foreach ($query->result_array() as $row) {
            $users[$i] = $row['user_id'];
            $i++;
        }

        foreach ($users as $user) {
            $query = $this->db->query("SELECT * FROM bets WHERE game_id='$lastGameID' AND bet='$win' AND user_id='$user'");
            foreach ($query->result_array() as $row) {
                $win_price = $row['price'];
            }

            $winned = $win_price*2;

            $query = $this->db->query("SELECT * FROM users WHERE id='$user'");
            foreach ($query->result_array() as $row) {
                $balance = $row['balance'];
            }

            $newBalance = $balance + $winned;

            $this->db->query("UPDATE users SET balance='$newBalance' WHERE id='$user'");
        }

        return $users;
    }
}
?>
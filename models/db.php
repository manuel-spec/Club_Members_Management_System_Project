<?php
class Db
{
    public $user = "root", $password = "";
    public $db;
    protected function connect()
    {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=ClubMembers', $this->user);
            return $this->db;
        } catch (Exception $e) {
            print($e);
        }
    }
}

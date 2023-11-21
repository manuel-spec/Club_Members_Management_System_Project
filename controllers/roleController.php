<?php
include_once '../models/db.php';

class RoleController extends Db
{
    function checkRole($username)
    {
        $stmt = $this->connect()->prepare('SELECT role from users where username = ?');
        $stmt->execute(array($username));

        $username1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $username1[0]['role'];
    }
}

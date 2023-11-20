<?php
include('../models/users.php');
class authController extends Users
{
    public $username, $password;
    public $validated = false;
    public $errors = array();
    public function __construct($user, $pass)
    {
        $this->username = $user;
        $this->password = $pass;
    }
    public function validate()
    {
        empty($this->username) || empty($this->password) ? array_push($this->errors, 'invalid username or password')  : $this->errors;
        strlen($this->username) < 5 || strlen($this->password) < 8 ? array_push($this->errors, 'invalid length of username or password') : $this->errors;
        if (!preg_match('/^[a-zA-Z0-9]*$/', $this->username)) {
            $this->errors = array();
            array_push($this->errors, 'username can be only characters and numbers');
        }

        if ($this->checkUser($this->username)) {
            $this->errors = array();
            array_push($this->errors, 'username alrady exists');
        }
        return $this->errors;
    }
}

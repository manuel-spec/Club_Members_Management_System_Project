<?php
include_once __DIR__ . '..\models\users.php';
class authController extends Users
{
    public $username, $password, $email;
    public $validated = false;
    public $errors = array();
    public function __construct($user, $pass, $email)
    {
        $this->username = $user;
        $this->password = $pass;
        $this->email = $email;
    }
    function isValidEmail($email)
    {
        // First, we check that there's one @ symbol, and that the lengths are right
        if (!preg_match("/^[^@]{1,64}@[^@]{1,255}$/", $email)) {
            // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
            array_push($this->errors, "invalid email");
            return false;
        }

        return true;
    }
    public function validate()
    {
        if ($this->checkEmail($this->email) != null) {
            $this->errors = array();
            array_push($this->errors, 'email already exists');
        }
        empty($this->username) || empty($this->password) ? array_push($this->errors, 'invalid username or password')  : $this->errors;
        strlen($this->username) < 5 || strlen($this->password) < 8 ? array_push($this->errors, 'invalid length of username or password') : $this->errors;
        if (!preg_match('/^[a-zA-Z0-9]*$/', $this->username)) {
            $this->errors = array();
            array_push($this->errors, 'username can be only characters and numbers');
        }

        if ($this->checkUser($this->username)) {
            $this->errors = array();
            array_push($this->errors, 'username already exists');
        }

        return $this->errors;
    }
    public function passwordReset()
    {
        echo $this->email;
    }
}

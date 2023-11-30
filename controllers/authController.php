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
        // Split it into sections to make life easier
        $email_array = explode("@", $email);
        $local_array = explode(".", $email_array[0]);
        for ($i = 0; $i < sizeof($local_array); $i++) {
            if (!preg_match("/^(([A-Za-z0-9!#$%&'*+\/=?^_`{|}~-][A-Za-z0-9!#$%&'*+\/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/", $local_array[$i])) {
                array_push($this->errors, "invalid email");
                return false;
            }
        }
        if (!preg_match("/^\[?[0-9\.]+\]?$/", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
            $domain_array = explode(".", $email_array[1]);
            if (sizeof($domain_array) < 2) {
                array_push($this->errors, "invalid email");
                return false; // Not enough parts to domain
            }
            for ($i = 0; $i < sizeof($domain_array); $i++) {
                if (!preg_match("/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$/", $domain_array[$i])) {
                    array_push($this->errors, "invalid email");
                    return false;
                }
            }
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

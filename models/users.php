<?php
include('db.php');
class Users extends Db
{
    protected function checkUser($username)
    {
        $stmt = $this->connect()->prepare("SELECT username FROM users WHERE username = ?; ");

        if (!$stmt->execute(array($username))) {
            $stmt = null;
            header('location: ../views/signup.php?error=querystatmentfailed');
            exit();
        }

        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function createUser($username, $password)
    {
        $stmt = $this->connect()->prepare("INSERT INTO users(username, password) values(?, ?); ");
        $hased_Password = password_hash($password, PASSWORD_DEFAULT);

        if (!$stmt->execute(array($username, $hased_Password))) {
            $stmt = null;
            header('location: ../views/signup.php?error=querystatmentfailed');
            exit();
        }
    }
    public function loginUser($username, $password)
    {
        $errors = array();
        $stmt = $this->connect()->prepare("SELECT * FROM users WHERE username = ?; ");
        $hashed_Password = password_hash($password, PASSWORD_DEFAULT);

        if (!$stmt->execute(array($username))) {
            $stmt = null;
            array_push($errors, "statment failed");
            return $errors;
        }
        if ($stmt->rowCount() == 0) {
            $stmt = null;
            array_push($errors, "user not found");
            return $errors;
        }


        $hashed_Password = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $check_password = password_verify($password, $hashed_Password[0]['password']);

        if ($check_password == false) {
            $stmt = null;
            array_push($errors, "wrong password");
            return $errors;
        }
        $stmt = $this->connect()->prepare("SELECT username FROM users WHERE username = ?; ");
        if (!$stmt->execute(array($username))) {
            $stmt = null;
            array_push($errors, "statment failed");
            return $errors;
        }
        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION['username'] = $user[0]['username'];
        header("location: ../views/home.php");
    }
}

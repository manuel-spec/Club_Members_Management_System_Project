<?php
include_once('db.php');
include_once('../controllers/roleController.php');

class Users extends Db
{
    public $totalUsers = 0;

    function __construct()
    {

        foreach ($this->getUser() as $key => $value) {
            $this->totalUsers++;
        }
    }
    protected function checkUser($username)
    {
        $stmt = $this->connect()->prepare("SELECT username FROM users WHERE username = ?; ");

        if (!$stmt->execute(array($username))) {
            $stmt = null;
            header('location: ../views/auth/signup.php?error=querystatmentfailed');
            exit();
        }

        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getOneUser($username)
    {
        $stmt = $this->connect()->prepare("SELECT * FROM users WHERE username = ?; ");

        if (!$stmt->execute(array($username))) {
            $stmt = null;
            header('location: ../views/auth/signup.php?error=querystatmentfailed');
            exit();
        }
        return $stmt->fetch();
    }
    public function getUser()
    {
        $stmt = $this->connect()->prepare("SELECT * FROM users; ");

        if (!$stmt->execute()) {
            $stmt = null;
            header('location: ../views/auth/signup.php?error=querystatmentfailed');
            exit();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function createUser($username, $password)
    {
        $stmt = $this->connect()->prepare("INSERT INTO users(username, password) values(?, ?); ");
        $hashed_Password = password_hash($password, PASSWORD_DEFAULT);

        if (!$stmt->execute(array($username, $hashed_Password))) {
            $stmt = null;
            header('location: ../views/auth/signup.php?error=querystatmentfailed');
            exit();
        } else {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['role'] = 'user';
        }
    }

    public function updateUser($username, $email, $role)
    {
        $stmt = $this->connect()->prepare("UPDATE users SET email = ?, role=? WHERE username = ?;");

        if (!$stmt->execute(array($email, $role, $username))) {
            $stmt = null;
            header('location: update.php?error=querystatmentfailed');
            exit();
        }
    }

    public function deleteUser($username)
    {
        echo $username;
        $stmt = $this->connect()->prepare("DELETE FROM users WHERE username = ?;");

        if (!$stmt->execute(array($username))) {
            $stmt = null;
            header('location: update.php?error=querystatmentfailed');
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
        $stmt = $this->connect()->prepare("SELECT username,role FROM users WHERE username = ?; ");
        if (!$stmt->execute(array($username))) {
            $stmt = null;
            array_push($errors, "statment failed");
            return $errors;
        }
        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
        session_start();
        echo $user[0]['role'];
        $_SESSION['role'] = $user[0]['role'];
        $_SESSION['username'] = $user[0]['username'];

        $role = new RoleController();
        $role->checkRole($user[0]['username']) == 'admin' ?  header("location: ../views/dashboard.php") :  header("location: ../views/events.php");
    }
    public function updateProfile($username, $email, $password)
    {
        $stmt = $this->connect()->prepare("UPDATE users SET email = ?, password=? WHERE username = ?;");
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        if (!$stmt->execute(array($email, $hashed_password, $username))) {
            $stmt = null;
            header('location: update.php?error=querystatmentfailed');
            exit();
        }
    }
    public function addProfile($username, $filename)
    {
        $filenameStr = '' . $filename['profile']['name'];
        $stmt = $this->connect()->prepare("UPDATE users SET profile = ? WHERE username = ?;");
        if (!$stmt->execute(array($filenameStr, $username))) {
            $stmt = null;
            header('location: update.php?error=querystatmentfailed');
            exit();
        }
    }
    public function profileUpload($file)
    {
        move_uploaded_file($file['profile']['tmp_name'], '../storage/' . $file['profile']['name']);
    }
    public function Register($username, $eventTitle)
    {
        $stmt = $this->connect()->prepare("INSERT INTO eventsstatus (username, event_title) values(?, ?); ");

        if (!$stmt->execute(array($username, $eventTitle))) {
            $stmt = null;
            header('location: ../views/events.php?error=querystatmentfailed');
            exit();
        }
    }
}

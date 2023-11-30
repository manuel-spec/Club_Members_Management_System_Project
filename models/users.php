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
    public function checkEmail($email)
    {
        $stmt = $this->connect()->prepare("SELECT email FROM users WHERE email = ?; ");

        if (!$stmt->execute(array($email))) {
            $stmt = null;
            header('location: ../views/auth/signup.php?error=querystatmentfailed');
            exit();
        }
        return $stmt->fetch();
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
    public function createUser($username, $password, $email)
    {
        $stmt = $this->connect()->prepare("INSERT INTO users(username, password, email) values(?, ?, ?); ");
        $hashed_Password = password_hash($password, PASSWORD_DEFAULT);

        if (!$stmt->execute(array($username, $hashed_Password, $email))) {
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
            array_push($errors, "wrong username or password");
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
        $path = $file['profile']['tmp_name'];
        $fileSize = filesize($path);
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $fileType = finfo_file($fileInfo, $path);
        $allowdType = [
            'image/png' => 'png',
            'image/jpeg' => 'jpeg'
        ];
        if ($fileSize == 0) {
            die("The FIle is Empty");
        } elseif ($fileSize > 3145728) {
            die("The File Is Too Large");
        } elseif (!in_array($fileType, array_keys($allowdType))) {
            die("File Not Allowed.");
        } else {
            move_uploaded_file($file['profile']['tmp_name'], '../storage/' . $file['profile']['name']);
        }
    }
    public function getProfile($username)
    {
        $stmt = $this->connect()->prepare("SELECT profile FROM users WHERE username = ?;");
        if (!$stmt->execute(array($username))) {
            $stmt = null;
            header('location: update.php?error=querystatmentfailed');
            exit();
        }
        return $stmt->fetch();
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
    public function getActiveEvents($username)
    {
        $stmt = $this->connect()->prepare("SELECT * FROM eventsstatus where username = ?; ");

        if (!$stmt->execute(array($username))) {
            $stmt = null;
            header('location: ../views/events.php?error=querystatmentfailed');
            exit();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

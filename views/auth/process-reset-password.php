<?php
$token = $_POST["token"];
$token_hash = hash("sha256", $token);
include_once __DIR__ . "\..\..\models\db.php";

class Forgot_password extends Db
{
    public function __construct($password, $password_repeat, $token)
    {
        if (!empty($password) && !empty($password_repeat)) {
            if ((strlen($password) >= 8) && (strlen($password_repeat) >= 8)) {
                if ($password == $password_repeat) {
                    $stmt = $this->connect()->prepare("UPDATE users SET password = ?, reset_token_hash = NULL, reset_token_expire_at = NULL WHERE reset_token_hash = ?; ");
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    if (!$stmt->execute(array($hashed_password, $token))) {
                        $stmt = null;
                        header('location: forgot-password.php?error=querystatmentfailed');
                        exit();
                    } else {
                        header("location: ../Login.php");
                    }
                }
            }
        } else {
            echo "invalid form submitted";
        }
    }
}

echo $token_hash;
$process = new Forgot_password($_POST['password'], $_POST['password_repeat'], $token);

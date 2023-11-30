<?php
$token = $_GET["token"];
$token_hash = hash("sha256", $token);
include_once __DIR__ . "\..\..\models\db.php";

class Forgot_password extends Db
{
    public function __construct($token)
    {

        $stmt = $this->connect()->prepare("SELECT * FROM users WHERE reset_token_hash = ?; ");

        if (!$stmt->execute(array($token))) {
            $stmt = null;
            header('location: forgot-password.php?error=querystatmentfailed');
            exit();
        }
        $data = $stmt->fetchAll();
        if ($data == null) {
            die("Token not found");
        }
        if (strtotime($data[0]['reset_token_expire_at']) <= time()) {
            die("token has expired");
        }
    }
}

$forgot_password = new Forgot_password($token_hash);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset password</title>
    <link rel="stylesheet" href="../../src/css/style.css" </head>

<body>
    <section class="bg-grey-50 flex items-center justify-center py-20">
        <div class="mx-auto bg-[#F6F7FA] rounded-2xl shadow-lg px-16 py-20">
            <form action="process-reset-password.php" method="POST" class="flex flex-col gap-3">
                <input type="hidden" name="token" value="<?= htmlspecialchars($token_hash) ?>">
                <input type="password" placeholder="New Password" class='border rounded-xl px-5 py-3 text-center' name="password" required>
                <input type="password" placeholder="Confim Password" class='border rounded-xl px-5 py-3 text-center' name="password_repeat" required>
                <button class="bg-[#002D74] rounded-xl py-2 text-white" type="submit" name="submit">Submit</button>

            </form>

        </div>
    </section>
</body>

</html>
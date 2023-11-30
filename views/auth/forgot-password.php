<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot your password ?</title>
    <link rel="stylesheet" href="../../src/css/style.css">

</head>

<body>
    <section class="bg-grey-50 flex items-center justify-center py-20">
        <div class="mx-auto bg-[#F6F7FA] rounded-2xl shadow-lg px-16 py-20">
            <form action="" method="POST" class="flex flex-col gap-4">
                <input type="email" placeholder="Email" class='border rounded-xl px-5 py-3 text-center' name="email" required>
                <button class="bg-[#002D74] rounded-xl py-2 text-white" type="submit" name="submit">Submit</button>
            </form>
        </div>
    </section>
    <?php
    if (isset($_POST['submit'])) {
        include_once __DIR__ . "\..\..\models\db.php";
        class Forgot_password extends Db
        {
            public $email, $token, $expiry_time, $token_hash;

            public function __construct($email)
            {
                $this->email = $email;
                $this->token = bin2hex(random_bytes(16));
                $this->token_hash = hash('sha256', $this->token);
                $this->expiry_time = date("Y-m-d H:i:s", (time() + 1800));

                $stmt = $this->connect()->prepare("UPDATE users SET reset_token_hash = ? , reset_token_expire_at = ? WHERE email = ?; ");

                if (!$stmt->execute(array($this->token_hash, $this->expiry_time, $email))) {
                    $stmt = null;
                    header('location: forgot-password.php?error=querystatmentfailed');
                    exit();
                } else {
                    $mail = require __DIR__ . "/mailer.php";
                    $mail->setFrom("noreply@gmail.com");
                    $mail->addAddress($email);
                    $mail->Subject = "Password RESET";
                    $mail->Body = <<<END
                    Click <a href="http://localhost:1011/views/auth/reset-password.php?token=$this->token">click me</a> <p>to reset your password</p>

                    END;
                    try {
                        $mail->send();
                    } catch (Exception $e) {
                        echo "MESSAGE COULD NOT BE SENT. Mailer error{$mail->ErrorInfo}";
                    }
                    echo "Message Sent, Please Check your Inbox..";
                }
            }
        }
        $password_reset = new Forgot_password($_POST['email']);
    }
    ?>
</body>

</html>
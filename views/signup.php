<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club Members Management System Project- Register</title>
    <link rel="stylesheet" href="../../src/css/style.css">
</head>

<body>
    <section class="bg-grey-50 flex items-center justify-center py-20">
        <div class="mx-auto bg-[#F6F7FA] rounded-2xl shadow-lg px-16 py-20">

            <div class="px-16  mx-auto">
                <div class="text-red">
                    <?php

                    if (isset($_SESSION['username'])) {
                        header('location: home.php');
                    }
                    include('../controllers/authController.php');



                    if (isset($_POST['Register'])) {
                        $auth = new authController($_POST['username'], $_POST['password']);

                        foreach ($auth->validate() as $key => $value) {
                            print('<p class="bg-red p-2">' . $value . '</p>');
                        }
                        if ($auth->validate() == null) {
                            $user = new Users();
                            $user->createUser($_POST['username'], $_POST['password']);

                            session_start();
                            $_SESSION['username'] = $_POST['username'];
                            header("location: home.php");
                        }
                    }
                    ?>
                </div>
                <h1 class="font-bold text-2xl text-center mb-5 text-[#002D74]">Register</h1>
                <form action="" method="post" class="flex flex-col gap-4">
                    <input type="text" class='border rounded-xl px-5 py-3 text-center' placeholder="username" name="username">
                    <input type="password" class='border rounded-xl px-5 py-3 text-center' placeholder="password" name="password">
                    <button class="bg-[#002D74] rounded-xl py-2 text-white" type="submit" name="Register">Register</button>
                    <div class="mt-7 grid grid-col-3  text-grey-400">
                        <span class="text-center text-sm text-grey-400">OR</span>
                        <hr class="border-grey-400">

                    </div>
                    <div class="text-center">
                        <a href="Login.php" class="text-[#002D74]">Login</a>
                    </div>
                </form>

            </div>
        </div>
    </section>
</body>

</html>
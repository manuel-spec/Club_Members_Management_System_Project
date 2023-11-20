<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club Members Management System Project-Login</title>
    <link rel="stylesheet" href="../src/css/style.css">
</head>

<body>
    <section class="bg-grey-50 flex items-center justify-center py-20">
        <div class="mx-auto bg-[#F6F7FA] rounded-2xl shadow-lg px-16 py-20">

            <div class="px-16  mx-auto">
                <div>
                    <?php
                    if (isset($_POST['Login'])) {
                        include('../models/users.php');
                        $user = new Users();
                        foreach ($user->loginUser($_POST['username'], $_POST['password']) as $errors) {
                            print($errors);
                        }
                    }
                    ?>
                </div>
                <h1 class="font-bold text-2xl text-center mb-5 text-[#002D74]">Login</h1>
                <form action="" method="post" class="flex flex-col gap-4">
                    <input type="text" class='border rounded-xl px-5 py-3 text-center' placeholder="username" name="username">
                    <input type="password" class='border rounded-xl px-5 py-3 text-center' placeholder="password" name="password">
                    <button class="bg-[#002D74] rounded-xl py-2 text-white" name="Login" type="submit">Login</button>
                    <div class="mt-7 grid grid-col-3  text-grey-400">
                        <span class="text-center text-sm text-grey-400">OR</span>
                        <hr class="border-grey-400">

                    </div>
                    <div class="flex flex-row item-center gap-2">
                        <a href="signup.php" class="text-[#002D74]">Register</a>
                        <a href="" class="px-4 text-[#002D74]">Forgot password?</a>
                    </div>
                </form>

            </div>
        </div>
    </section>


</body>

</html>
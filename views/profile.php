<?php
session_start();
if (!isset($_POST['profile'])) {
    header("location: home.php");
}
include_once($_SERVER['DOCUMENT_ROOT'] . '/models/users.php');
include_once("inc/navbar.php");
$user = new Users();
$u = $user->getOneUser($_POST['user']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Sweet Home</title>
    <link rel="stylesheet" href="../../src/css/style.css">
    <script>

    </script>
</head>

<body id="body">

    <div>
        <div action="" method="post" class="p-4 mx-auto my-10 sm:px-20  flex justify-around">
            <div class=" rounded overflow-hidden border w-full lg:w-6/12 md:w-6/12 bg-white mx-3 md:mx-0 lg:mx-0">
                <p class="text-center border p-4"><?php echo $_POST['user'];  ?></p>
                <form action="" method="post" class="mt-4 flex flex-col gap-4">
                    <label for="username">username:</label>
                    <input class="bg-gray-100 focus:outline-none border border-gray-400 rounded py-1 px-4  appearance-none leading-normal " type="text" placeholder="" value="<?php echo $u[1]; ?>">

                    <p><label for="username">email:</label></p>
                    <input class="bg-gray-100 focus:outline-none border border-gray-400 rounded py-1 px-4  appearance-none leading-normal " type="email" placeholder="" value="<?php echo $u[5]; ?>" name="email">

                    <p><label for="username">New Password:</label></p>
                    <input class="bg-gray-100 focus:outline-none border border-gray-400 rounded py-1 px-4  appearance-none leading-normal " type="text" placeholder="" name="role">
                    <div>
                        <input type="submit" name="update" value="Update" class="bg-[#002D74] rounded-xl py-2 px-4 text-white">
                        <input type="submit" name="delete" value="Delete" class="bg-[#D4413A] rounded-xl py-2 px-4 text-white">
                        <?php
                        if (isset($_POST['update'])) {
                            include_once "../models/users.php";
                            $user = new Users();
                            $user->updateUser(trim($_POST['username']), trim($_POST['email']), trim($_POST['role']));
                        } elseif (isset($_POST['delete'])) {
                            include_once "../models/users.php";
                            $user = new Users();
                            $user->deleteUser($_POST['username']);
                        }
                        ?>
                    </div>
                </form>
            </div>
        </div>

</body>

</html>
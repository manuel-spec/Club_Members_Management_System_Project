<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/models/users.php');
if (!isset($_POST['EditUser'])) {
    header("location: Login.php");
}

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
    <nav class="flex items-center justify-around flex-wrap bg-white p-6 shadow-md">
        <div class="flex items-center text-gray-800  cursor-pointer">
            <img src="../src/imgs/csec.png" alt="" class="w-1/4">
        </div>
        <div>
            <a href="dashboard.php" class="p-2">Dashboard</a>
            <a href="events.php" class="p-2">Events</a>
            <a href="post.php" class="p-2">Post</a>

        </div>
        <div class="text-sm w-64 ">
            <input class="bg-gray-100 focus:outline-none focus:shadow-outline border border-gray-400 rounded py-1 px-4 block w-full appearance-none leading-normal " type="text" placeholder="Search">
        </div>
        <div>
            <?php
            if (isset($_SESSION['username'])) {
            ?>
                <div class="flex flex-row">
                    <div class="rounded-full h-8 w-8 bg-gray-500 flex items-center justify-center overflow-hidden">
                        <img src="https://avatars0.githubusercontent.com/u/38799309?v=4" alt="profilepic">
                    </div>
                    <span class="pt-1 ml-2 font-bold text-sm"><?php echo $_SESSION['username']; ?></span>
                    <a href="auth/logout.php" class="pt-1 ml-2 font-bold text-sm">Logout</a>
                </div>

            <?php } else {
                header('location: ../Login.php');
            } ?>
        </div>
        <div>
            <i class="far fa-user text-lg cursor-pointer"></i>
        </div>
    </nav>

    <div>
        <div action="" method="post" class="p-4 mx-auto my-10 sm:px-20  flex justify-around">
            <div class=" rounded overflow-hidden border w-full lg:w-6/12 md:w-6/12 bg-white mx-3 md:mx-0 lg:mx-0">
                <p class="text-center border p-4"><?php echo $_POST['username']; ?></p>
                <form action="" method="post" class="mt-4 flex flex-col gap-4">
                    <label for="username">username:</label>
                    <input disabled class="bg-gray-100 focus:outline-none border border-gray-400 rounded py-1 px-4  appearance-none leading-normal " type="text" placeholder="" value="<?php echo $_POST['username']; ?>">
                    <input class="bg-gray-100 focus:outline-none border border-gray-400 rounded py-1 px-4  appearance-none leading-normal " type="hidden" placeholder="" value="<?php echo $_POST['username']; ?>" name="username">

                    <p><label for="username">email:</label></p>
                    <input class="bg-gray-100 focus:outline-none border border-gray-400 rounded py-1 px-4  appearance-none leading-normal " type="email" placeholder="" value="<?php echo $_POST['email']; ?>" name="email">

                    <p><label for="username">role:</label></p>
                    <input class="bg-gray-100 focus:outline-none border border-gray-400 rounded py-1 px-4  appearance-none leading-normal " type="text" placeholder="" value="<?php echo $_POST['role']; ?>" name="role">
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
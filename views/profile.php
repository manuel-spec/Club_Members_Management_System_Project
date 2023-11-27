<?php
session_start();
if (!isset($_GET['profile'])) {
    header("location: home.php");
}
include_once($_SERVER['DOCUMENT_ROOT'] . '/models/users.php');

include_once("inc/navbar.php");
// $e = $_GET['user'];
$user = new Users();
$u = $user->getOneUser($_GET['user']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="../../src/css/style.css">
    <script>

    </script>
</head>

<body id="body">

    <div>
        <div action="" method="post" class="p-4 mx-auto my-10 sm:px-20  flex justify-around">
            <div class=" rounded overflow-hidden border w-full lg:w-6/12 md:w-6/12 bg-white mx-3 md:mx-0 lg:mx-0">
                <p class="text-center border p-4"><?php echo $u[1];  ?></p>
                <form action="" method="post" class="mt-4 flex flex-col gap-4" enctype="multipart/form-data">
                    <label>username:</label>
                    <input name="username" class="bg-gray-100 focus:outline-none border border-gray-400 rounded py-1 px-4  appearance-none leading-normal " type="text" placeholder="" value="<?php echo $u[1]; ?>">

                    <p><label>email:</label></p>
                    <input name="email" class="bg-gray-100 focus:outline-none border border-gray-400 rounded py-1 px-4  appearance-none leading-normal " type="email" placeholder="" value="<?php echo $u[5]; ?>" name="email">

                    <p><label>New Password:</label></p>
                    <input name="password" class="bg-gray-100 focus:outline-none border border-gray-400 rounded py-1 px-4  appearance-none leading-normal " type="text" placeholder="">
                    <input type="file" name="profile"><input type="submit" name="uploadImg" value="Upload" class="bg-[#002D74] rounded-xl py-2 px-4 text-white">
                    <div>
                        <input type="submit" name="updateProfile" value="Update" class="bg-[#002D74] rounded-xl py-2 px-4 text-white">
                        <input type="submit" name="deleteProfile" value="Delete" class="bg-[#D4413A] rounded-xl py-2 px-4 text-white">
                        <?php
                        if (isset($_POST['uploadImg'])) {
                            $profilename = $_FILES['profile']['name'];
                            include_once "../models/users.php";
                            $user = new Users();
                            $user->profileUpload($_FILES);

                            $user->addProfile($u[1], $_FILES);
                        }
                        if (isset($_POST['updateProfile'])) {
                            include_once "../models/users.php";
                            $user = new Users();
                            if (!empty(trim($_POST['password'])) && strlen(trim($_POST['password'])) >= 8) {
                                $user->updateProfile(trim($_POST['username']), trim($_POST['email']), trim($_POST['password']));
                                header('location: auth/logout.php');
                            } else {
                                echo "<p class='text-[#FF0000]'>invalid form<p/>";
                            }
                        } elseif (isset($_POST['deleteProfile'])) {
                            include_once "../models/users.php";
                            $user = new Users();
                            $user->deleteUser($u[1]);
                            header('location: auth/logout.php');
                        }
                        ?>
                    </div>

                </form>
            </div>
        </div>

</body>

</html>
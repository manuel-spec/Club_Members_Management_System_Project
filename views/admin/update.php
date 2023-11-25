<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/models/users.php');


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
            <a href="../dashboard.php" class="p-2">Dashboard</a>
            <a href="../events.php" class="p-2">Events</a>
            <a href="../post.php" class="p-2">Post</a>

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
        <form action="" method="post" class="container mx-auto my-10 sm:px-20  flex justify-center">
            <div class=" rounded overflow-hidden border w-full lg:w-6/12 md:w-6/12 bg-white mx-3 md:mx-0 lg:mx-0">
                <div class="heading text-center font-bold text-2xl m-5 text-gray-800" <?php ?></div>
                    <style>
                        body {
                            background: white !important;
                        }
                    </style>
                    <div class="editor mx-auto w-10/12 flex flex-col text-gray-800 border border-gray-300 p-4 shadow-lg max-w-2xl">
                        <input class="title bg-gray-100 border border-gray-300 p-2 mb-4 outline-none" spellcheck="false" placeholder="Title" type="text" name="title" value="<?php ?>" required>

                        <div class="buttons flex mb-2">
                            <div class="btn border border-gray-300 p-1 px-4 font-semibold cursor-pointer text-gray-500 ml-auto">Cancel</div>
                            <button class="btn border border-indigo-500 p-1 px-4 font-semibold cursor-pointer text-gray-200 ml-2 bg-indigo-500" type="submit" name="Post">Post</button>
                        </div>
                    </div>
                </div>
        </form>
    </div>

</body>

</html>
<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Sweet Home</title>
    <link rel="stylesheet" href="../src/css/style.css">
</head>

<body>

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
                header('location: Login.php');
            } ?>
        </div>
        <div>
            <i class="far fa-user text-lg cursor-pointer"></i>
        </div>
    </nav>



    <?php
    include_once '../models/Events.php';
    $p = new Event();
    $events = $p->read();
    foreach ($events as $e) { ?>
        <div class="container mx-auto my-10 sm:px-20 flex justify-center">
            <!--  Post  -->
            <div class="rounded overflow-hidden border  bg-white w-1/2 md:mx-0 lg:mx-0 ">
                <div class="w-full flex justify-between p-3">
                    <div class="flex">
                        <div class="rounded-full h-8 w-8 bg-gray-500 flex items-center justify-center overflow-hidden">
                            <img src="https://avatars0.githubusercontent.com/u/38799309?v=4" alt="profilepic">
                        </div>
                        <span class="pt-1 ml-2 font-bold text-sm"><?php echo $e[1]; ?></span>
                    </div>
                    <span class="px-2 hover:bg-gray-300 cursor-pointer rounded"><i class="fas fa-ellipsis-h pt-2 text-lg"></i></span>
                </div>
                <div class="px-3 pb-2">
                    <div class="pt-2">
                        <i class="far fa-heart cursor-pointer"></i>
                        <span class="text-sm text-gray-400 font-medium"><?php echo $e[2]; ?></span>
                    </div>
                    <div class="pt-1">
                        <div class="mb-2 text-sm">
                            <span class="font-medium mr-2"><?php echo print($e[3]); ?></span> <?php echo $e[4]; ?>
                        </div>
                    </div>

                    <a href="" class="button">Register</a>
                </div>
            </div>
        </div>
    <?php } ?>




</body>

</html>
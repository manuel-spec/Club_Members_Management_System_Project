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
            <a href="" class="p-2">Home</a>
            <a href="" class="p-2">Home</a>
            <a href="" class="p-2">Home</a>
            <a href="" class="p-2">Home</a>
        </div>
        <div class="text-sm w-64 ">
            <input class="bg-gray-100 focus:outline-none focus:shadow-outline border border-gray-400 rounded py-1 px-4 block w-full appearance-none leading-normal " type="text" placeholder="Search">
        </div>
        <div>
            <?php
            if (isset($_SESSION['username'])) {
            ?>
                <a href="auth/logout.php">Logout</a>
            <?php } else {
                header('location: Login.php');
            } ?>
        </div>
        <div>
            <i class="far fa-user text-lg cursor-pointer"></i>
        </div>
    </nav>


    <div class="container mx-auto my-10 sm:px-20  flex justify-center">

        <!--  Post  -->
        <div class=" rounded overflow-hidden border w-full lg:w-6/12 md:w-6/12 bg-white mx-3 md:mx-0 lg:mx-0">
            <div class="w-full flex justify-between p-3">
                <div class="flex">
                    <div class="rounded-full h-8 w-8 bg-gray-500 flex items-center justify-center overflow-hidden">
                        <img src="https://avatars0.githubusercontent.com/u/38799309?v=4" alt="profilepic">
                    </div>
                    <span class="pt-1 ml-2 font-bold text-sm">admin</span>
                </div>
                <span class="px-2 hover:bg-gray-300 cursor-pointer rounded"><i class="fas fa-ellipsis-h pt-2 text-lg"></i></span>
            </div>
            <div class="px-3 pb-2">
                <div class="pt-2">
                    <i class="far fa-heart cursor-pointer"></i>
                    <span class="text-sm text-gray-400 font-medium">12 likes</span>
                </div>
                <div class="pt-1">
                    <div class="mb-2 text-sm">
                        <span class="font-medium mr-2">braydoncoyer</span> Lord of the Rings is my favorite film-series. One day I'll make my way to New Zealand to visit the Hobbiton set!
                    </div>
                </div>
                <div class="text-sm mb-2 text-gray-400 cursor-pointer font-medium">View all 14 comments</div>
                <div class="mb-2">
                    <div class="mb-2 text-sm">
                        <span class="font-medium mr-2">razzle_dazzle</span> Dude! How cool! I went to New Zealand last summer and had a blast taking the tour! So much to see! Make sure you bring a good camera when you go!
                    </div>
                </div>
                <a href="" class="button">Register</a>
            </div>
        </div>

    </div>

</body>

</html>
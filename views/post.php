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

    <div>

        <form action="" method="post" class="container mx-auto my-10 sm:px-20  flex justify-center">
            <div class=" rounded overflow-hidden border w-full lg:w-6/12 md:w-6/12 bg-white mx-3 md:mx-0 lg:mx-0">
                <div class="heading text-center font-bold text-2xl m-5 text-gray-800">New Event</div>
                <style>
                    body {
                        background: white !important;
                    }
                </style>
                <div class="editor mx-auto w-10/12 flex flex-col text-gray-800 border border-gray-300 p-4 shadow-lg max-w-2xl">
                    <input class="title bg-gray-100 border border-gray-300 p-2 mb-4 outline-none" spellcheck="false" placeholder="Title" type="text" name="title" required>
                    <textarea class="description bg-gray-100 sec p-3 h-60 border border-gray-300 outline-none" spellcheck="false" placeholder="Describe everything about this post here" name="desc" required></textarea>

                    <!-- icons -->
                    <div class="icons flex text-gray-500 m-2">
                        <svg class="mr-2 cursor-pointer hover:text-gray-700 border rounded-full p-1 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <svg class="mr-2 cursor-pointer hover:text-gray-700 border rounded-full p-1 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <svg class="mr-2 cursor-pointer hover:text-gray-700 border rounded-full p-1 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                        </svg>
                        <div class="count ml-auto text-gray-400 text-xs font-semibold">0/300</div>
                    </div>
                    <!-- buttons -->
                    <div class="buttons flex">
                        <div class="btn border border-gray-300 p-1 px-4 font-semibold cursor-pointer text-gray-500 ml-auto">Cancel</div>
                        <button class="btn border border-indigo-500 p-1 px-4 font-semibold cursor-pointer text-gray-200 ml-2 bg-indigo-500" type="submit" name="Post">Post</button>
                    </div>
                </div>
            </div>

    </div>
    </form>
    <?php
    include_once '../models/Events.php';

    if (isset($_POST['Post'])) {
        $event = new Event();
        $event->create($_SESSION['username'], $_POST['title'], $_POST['desc']);
    }
    ?>


</body>

</html>
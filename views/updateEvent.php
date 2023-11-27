<?php
session_start();
include_once 'inc/navbar.php';
include_once '../models/Events.php';

$event = new Event();
$event->read();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Event</title>
    <link rel="stylesheet" href="../src/css/style.css">
</head>

<body>
    <div>
        <?php
        include_once "../models/Events.php";
        $event = new Event();

        ?>
        <form action="" method="post" class="container mx-auto my-10 sm:px-20  flex justify-center">
            <div class=" rounded overflow-hidden border w-full lg:w-6/12 md:w-6/12 bg-white mx-3 md:mx-0 lg:mx-0">
                <div class="heading text-center font-bold text-2xl m-5 text-gray-800">Update Event</div>
                <style>
                    body {
                        background: white !important;
                    }
                </style>
                <div class="editor mx-auto w-10/12 flex flex-col text-gray-800 border border-gray-300 p-4 shadow-lg max-w-2xl">


                    <input class="title bg-gray-100 border border-gray-300 p-2 mt-4 outline-none" spellcheck="false" placeholder="Title" type="text" name="title" value="<?php echo $event->readOne($_GET['id'])[2]; ?>" required>
                    <textarea class="description bg-gray-100 sec p-3 h-60 border border-gray-300 outline-none mt-4" spellcheck="false" placeholder="" name="desc" required> <?php echo $event->readOne($_GET['id'])[3]; ?> </textarea>

                    <!-- buttons -->
                    <div class="buttons flex mt-4 justify-end">
                        <button class="btn border border-indigo-500 p-1 px-4 font-semibold cursor-pointer text-gray-200 ml-2 bg-indigo-500" type="submit" name="update">Update</button>
                    </div>
                    <?php
                    if (isset($_POST['update'])) {
                        $event->updateOne($_GET['id'], $_POST['title'], $_POST['desc']);
                    }
                    ?>
                </div>
            </div>
        </form>
    </div>



</body>

</html>
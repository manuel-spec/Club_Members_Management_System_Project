<?php
session_start();
include_once 'inc/navbar.php';
include_once '../models/users.php';
if (!isset($_SESSION['username'])) {
    header("location: auth/logout.php");
}
$userEvents = new Users();
// $itr = new ArrayIterator($userEvents->getActiveEvents($_SESSION['username']));
// var_dump($userEvents->getActiveEvents($_SESSION['username'])[1]['event_title']);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RegisteredEvents</title>
    <link rel="stylesheet" href="../src/css/style.css">
</head>

<body>
    <div class="container mx-auto my-10 sm:px-20 flex justify-center">

        <!--  Post  -->
        <div class="rounded overflow-hidden border  bg-white w-1/2 md:mx-0 lg:mx-0 ">
            <h1 class=" text-3xl text-center">active events</h1>
            <hr>
            <div>

                <?php
                for ($i = 0; $i < count($userEvents->getActiveEvents($_SESSION['username'])); $i++) {
                    echo "<div class='border p-4'>" . $userEvents->getActiveEvents($_SESSION['username'])[$i]['event_title'] . "</div>";
                }

                ?>
            </div>
        </div>


    </div>
</body>

</html>
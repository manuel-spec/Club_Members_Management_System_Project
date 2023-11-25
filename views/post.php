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
    <?php
    include_once '../models/Events.php';
    include_once 'inc/navbar.php';
    include_once 'inc/form.php';

    if (isset($_POST['Post'])) {
        $event = new Event();
        $event->create($_SESSION['username'], $_POST['title'], $_POST['desc']);
    }
    ?>

</body>

</html>
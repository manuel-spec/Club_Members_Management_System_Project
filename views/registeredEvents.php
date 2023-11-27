<?php
session_start();
include_once 'inc/navbar.php';
if (!isset($_SESSION['username'])) {
    header("location: auth/logout.php");
}

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

</body>

</html>
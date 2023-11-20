<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Sweet Home</title>
</head>

<body>
    <?php
    if (isset($_SESSION['username'])) {
    ?>
        <h1>hey <?php echo $_SESSION['username']; ?></h1>
        <a href="logout.php">Logout</a>
    <?php } else {
        header('location: Login.php');
    } ?>

</body>

</html>
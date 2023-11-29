<?php
include_once __DIR__ . "/../../models/users.php";
$profileName = new Users();

?>
<nav class="flex items-center justify-around flex-wrap bg-white p-6 shadow-md">
    <div class="flex items-center text-gray-800  cursor-pointer">
        <img src="../src/imgs/csec.png" alt="" class="w-1/4">
    </div>
    <div>

        <?php
        if ($_SESSION['role'] == "admin") { ?>
            <a href="dashboard.php" class="p-2">Dashboard</a>
            <a href="events.php" class="p-2">Events</a>
            <a href="post.php" class="p-2">Post</a>
        <?php } else { ?>
            <div>
                <a href="home.php" class="p-2">Home</a>
                <a href="events.php" class="p-2">events</a>
                <a href="registeredEvents.php" class="p-2">RegisteredEvents</a>
            </div>
        <?php } ?>
    </div>
    <div class="text-sm w-64 ">
        <input class="bg-gray-100 focus:outline-none focus:shadow-outline border border-gray-400 rounded py-1 px-4 block w-full appearance-none leading-normal " type="hidden" placeholder="Search">
    </div>
    <div>
        <?php
        if (isset($_SESSION['username'])) {
        ?>
            <div class="flex flex-row">
                <div class="rounded-full h-8 w-8 bg-gray-500 flex items-center justify-center overflow-hidden">
                    <img src="<?php echo "/../../storage/" . $profileName->getProfile($_SESSION['username'])["profile"]; ?>" alt="profilepic">
                </div>
                <form action="profile.php" method="get">
                    <input type="hidden" value="<?php echo $_SESSION['username']; ?>" name="user">
                    <button type="submit" class="pt-1 ml-2 font-bold text-sm" name="profile"><?php echo $_SESSION['username']; ?></a>
                </form>

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
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
                <a href="" class="p-2">Home</a>
                <a href="events.php" class="p-2">events</a>
                <a href="" class="p-2">RegisteredEvents</a>
            </div>
        <?php } ?>
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
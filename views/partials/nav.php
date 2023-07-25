<nav class="navbar navbar-expand-sm navbar-light bg-white shadow mt-2 rounded me-2 ms-2">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">PM-Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="/">Projects</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="users">Users</a>
                </li>
            </ul>
            <div class="me-1">
                <?php if (isset($_SESSION["uid"]) || time() > isset($_SESSION["timeout"])) {
                    $uid = $_SESSION["uid"] ?? "";
                    $user = $_SESSION["user"] ?? "";
                    $name = $_SESSION["name"] ?? "";
                    $email = $_SESSION["email"] ?? "";
                    $division = $_SESSION["division"] ?? "";
                    $userimg = $_SESSION["image"] ?? null;
                    $firstname = explode(" ", $name)[0];
                }
                ?>
                Welcome, <?php echo "<b>" . (($firstname) ? $firstname : 'Guest') . "</b>"; ?>
                <?php echo "<img class='userimg' src='" . ($userimg ?? 'views/imgs/guest.png') . "'>"; ?>

                <?php if ($uid) {
                    echo "<a href='logout' class='btn btn-sm btn-secondary'>Logout</a>";
                } ?>

            </div>
        </div>
    </div>
</nav>
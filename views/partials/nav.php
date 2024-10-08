<nav class="navbar navbar-expand-sm navbar-light bg-white shadow mt-2 rounded me-2 ms-2">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboard">PM-Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
            <div class="me-5">
                <?php if (isset($_SESSION["uid"]) || time() > isset($_SESSION["timeout"])) {
                    $uid = $_SESSION["uid"] ?? "";
                    $user = $_SESSION["user"] ?? "";
                    $name = $_SESSION["name"] ?? "";
                    $email = $_SESSION["email"] ?? "";
                    $division = $_SESSION["division"] ?? "";
                    $userimg = $_SESSION["image"] ?? null;
                    $firstname = explode(" ", $name)[0];

                    $remainingtime = time() - isset($_SESSION["timeout"]);
                }
                ?>
                <!-- read notifications from db -->
                <?php

                use Core\Db;

                $db = new Db('localhost', 'root1', 'root', 'projectsms');
                $notifications = $db->read('notifications', 'uid=? AND is_read=?', [$uid, 0], null, null, 'cdate');

                ?>
                <!-- notification area -->
                <?php
                //show only if logged in 
                if (isset($_SESSION["loggedin"])) :
                ?>
                    <div class="dropdown d-inline">
                        <?php if ($notifications) { ?>
                            <span class="position-absolute top-0 start-10 translate-middle badge border border-light rounded-circle bg-danger p-1">
                                <?= count($notifications); ?>
                            </span>
                        <?php } ?>
                        <img class="dropdown-toggle icon" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" src="/views/imgs/icons/chat.png">

                        <ul class="dropdown-menu p-2 striped scrollable-menu mt-2 dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                            <?php foreach ($notifications as $notification) : ?>
                                <li class="list-group-item list-group-item-action"><a href="<?= $notification['link'] ?>">
                                        <?= $notification['msg'] ?>
                                    </a>
                                    <div class="small text-muted"><?= $notification['cdate'] ?></div>
                                    <hr>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                Welcome,
                <span title="View Profile">
                    <?php if (isset($_SESSION["loggedin"])) {
                        $status = "";
                    } else {
                        $status = "disabled";
                    } ?>
                    <a href="userview?id=<?= $uid ?>" class="<?= $status ?>">
                        <?php echo "<b>" . (($firstname) ? $firstname : 'Guest') . "</b>"; ?>
                    </a>
                </span>
                <?php echo "<img class='sm-userimg' src='" . ($userimg ?? 'views/imgs/guest.png') . "'>"; ?>

                <?php if ($uid) { ?>
                    <form method="POST" action="/logout">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION["csrf_token"]; ?>">
                        <button type="submit" class='btn btn-sm btn-secondary'>Logout</button>
                    </form>

                    <!-- <a href='logout' class='btn btn-sm btn-secondary'>Logout</a><br> -->
                    <div></div>
                <?php } ?>

            </div>
        </div>
    </div>
</nav>
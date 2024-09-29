<?php require("auth.php"); ?>
<?php $base = __DIR__ . '/../'; ?>
<?php require($base . 'partials/head.php');
?>
<?php require($base . 'partials/nav.php'); ?>
<?php require($base . 'partials/banner.php'); ?>
<?php

use Core\Db;
use Core\validate;

$db = new Db('localhost', 'root1', 'root', 'projectsms');
$valid = new validate(); ?>
<?php require 'functions.php'; ?>

<?php
$id = $valid->str($_GET['id']);
$users = $db->read('users', 'id=?', array($id));
foreach ($users as $user) {
?>
    <?php $disable =  authBtns($_SESSION['uid'], $user['id'], $_SESSION['role']); ?>
    <main class="container">
        <div class="d-inline-block">
            <div class="card mb-2 w-auto">
                <div class="card-header h5 d-flex flex-row justify-content-between">
                    <div> User's Info </div>
                    <div><a class="<?= $disable ?>" title="Update user" href="userupdate?id=<?= $id ?>"><img class="icon" src="views/imgs/icons/edit.png"></a></div>
                </div>

                <div class="card-body">
                    <table class="table table-hover table-borderless rounded rounded-5 w-auto">
                        <tr>
                            <th class="text-dark rounded">Status</th>
                            <td class="h5 text-wrap" style="width: 20rem;">
                                <?= ($user['online'] == "1") ? "Online" : "Offline" ?>
                                <?php $img = ($user['online'] == "1") ? "/views/imgs/icons/gcircle.png" : "/views/imgs/icons/rcircle.png" ?>
                                <img src="<?= $img ?>" alt="" style="width:20px; height:20px;">
                            </td>
                        </tr>
                        <tr>
                            <th class="text-dark rounded">Image</th>
                            <td class="h5 text-wrap" style="width: 20rem;">
                                <img class="scale2" src="<?= ($user['image'] ?? "views/imgs/guest.png") ?>" style="width: 100px; height:100px">
                            </td>
                        </tr>
                        <tr>
                            <th class="text-dark rounded">User/Badge</th>
                            <td class="h5 text-wrap" style="width: 20rem;"><?= $user['user']; ?></td>
                        </tr>
                        <tr>
                            <th class="text-dark rounded">Full Name</th>
                            <td class="h5 text-wrap" style="width: 20rem;"><?= $user['name']; ?></td>
                        </tr>
                        <tr>
                            <th class="text-dark rounded">Role</th>
                            <td class="h5 text-wrap" style="width: 20rem;"><?= $user['role']; ?></td>
                        </tr>
                        <tr>
                            <th class="text-dark rounded">Division</th>
                            <td class="h5 text-wrap" style="width: 20rem;"><?= $user['division']; ?></td>
                        </tr>
                        <tr>
                            <th class="text-dark rounded">Employment Type</th>
                            <td class="h5 text-wrap" style="width: 20rem;"><?= $user['emptype']; ?></td>
                        </tr>
                        <tr>
                            <th class="text-dark rounded">Approved</th>
                            <td class="h5 text-wrap" style="width: 20rem;"><?= ($user['approved'] == 1) ? "Yes" : "No"; ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-dark rounded">Joining Date</th>
                            <td class="h5 text-wrap" style="width: 20rem;"><?= $user['joiningdate']; ?></td>
                        </tr>
                        <tr>
                            <th class="text-dark rounded">Graduation Year</th>
                            <td class="h5 text-wrap" style="width: 20rem;"><?= $user['gradyear']; ?></td>
                        </tr>
                        <tr>
                            <th class="text-dark rounded">Nationality</th>
                            <td class="h5 text-wrap" style="width: 20rem;"><?= $user['nationality']; ?></td>
                        </tr>
                        <tr>
                            <th class="text-dark rounded">Vacation Balance</th>
                            <td class="h5 text-wrap" style="width: 20rem;"><?= $user['vacbalance']; ?></td>
                        </tr>

                    </table>

                </div>
            </div>
        </div>
    </main> <?php } ?>

<?php require($base . 'partials/footer.php'); ?>
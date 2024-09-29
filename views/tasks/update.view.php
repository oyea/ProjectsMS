<?php require("auth.php"); ?>
<?php $base = __DIR__ . '/../'; ?>
<?php require($base . 'partials/head.php'); ?>
<?php require($base . 'partials/nav.php'); ?>
<?php require($base . 'partials/banner.php'); ?>
<?php

use Core\Db;
use Core\validate;
?>
<?php $db = new Db('localhost', 'root1', 'root', 'projectsms'); ?>
<?php $val = new validate(); ?>
<?php
$tid = $val->str($_GET['tid']);
$pid = $val->str($_GET['pid']);
?>
<div class="container w-50">

    <?php
    $rows = $db->read('tasks', 'id=?', array($tid));
    foreach ($rows as $row) { ?>

        <form action="taskedit" method="POST" class="row">
            <div class="form-group">
                <label for="title">Title *</label>
                <input id="title" name="title" type="text" class="form-control" value="<?= $row['title'] ?>" required>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <div>
                    <select id="category" name="category" class="custom-select">
                        <option value="">Select</option>
                        <?php $cats = $db->read('taskscategories'); ?>
                        <?php foreach ($cats as $cat) { ?>
                            <option value="<?= $cat['id'] ?>" <?= ($row['category'] == $cat['id']) ? "SELECTED" : "" ?>>
                                <?= $cat['category'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="subcat" id="subcatlabel">Sub Category</label>
                <div>
                    <select id="subcat" name="subcat" class="custom-select">
                        <option value="">Select</option>
                        <?php $subcats = $db->read('subtaskscategories'); ?>
                        <?php foreach ($subcats as $subcat) { ?>
                            <option value="<?= $subcat['id'] ?>" <?= ($row['subcat'] == $subcat['id']) ? "selected" : "" ?>>
                                <?= $subcat['subcat'] ?>
                            </option>
                        <?php } ?>
                    </select>

                </div>
            </div>
            <div class="form-group">
                <label for="revno">Revision No</label>
                <input id="revno" name="revno" type="text" class="form-control" value="<?= $row['revno'] ?>">
            </div>
            <div class="form-group">
                <label for="letterno">Letter No</label>
                <input id="letterno" name="letterno" type="text" class="form-control" value="<?= $row['letterno'] ?>">
            </div>
            <div class="form-group">
                <label for="letterdate">Letter Date *</label>
                <input id="letterdate" name="letterdate" type="date" class="form-control" value="<?= $row['letterdate'] ?>" required>
            </div>
            <div class="form-group">
                <label for="recedate">Received Date *</label>
                <input id="recedate" name="recedate" type="date" class="form-control" value="<?= $row['recedate'] ?>" required>
            </div>
            <div class="form-group">
                <label for="replyno">Reply No</label>
                <input id="replyno" name="replyno" type="text" class="form-control" value="<?= $row['replyno'] ?>">
            </div>
            <div class="form-group">
                <label for="replydate">Reply Date</label>
                <input id="replydate" name="replydate" type="date" class="form-control" value="<?= $row['replydate'] ?>">
            </div>
            <div class="form-group">
                <label for="conshrs">Consumed Hours</label>
                <input id="conshrs" name="conshrs" type="text" class="form-control" value="<?= $row['conshrs'] ?>">
            </div>
            <div class="form-group mt-3">
                <label for="progress">Progress *</label>
                <select id="progress" name="progress" class="custom-select" required>
                    <option value="0" <?= ($row['progress'] == "0") ? "SELECTED" : "" ?>>Pending</option>
                    <option value="100" <?= ($row['progress'] == "100") ? "SELECTED" : "" ?>>Completed</option>
                </select>
            </div>
            <div class="form-group mt-3">
                <label for="select">assigeduser *</label>
                <div>
                    <select id="assignuser" name="assignuser" class="custom-select" required>
                        <option value="">Select</option>
                        <?php $users = $db->read('users'); ?>
                        <?php foreach ($users as $user) { ?>
                            <option value="<?= $user['id'] ?>" <?= ($row['assignuser'] == $user['id']) ? "SELECTED" : "" ?>>
                                <?= $user['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group mt-3">
                <input type="hidden" name="tid" value="<?= $tid ?>">
                <input type="hidden" name="pid" value="<?= $pid ?>">
                <button name="submit" type="submit" class="btn btn-primary w-25 offset-5">Save</button>
                <a href="#" onclick="history.go(-1);" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    <?php } ?>
</div>
<?php require($base . 'partials/footer.php'); ?>
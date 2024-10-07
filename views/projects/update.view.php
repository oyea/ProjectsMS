<?php require("auth.php"); ?>
<?php $base = __DIR__ . '/../'; ?>
<?php require($base . 'partials/head.php'); ?>
<?php require($base . 'partials/nav.php'); ?>
<?php require($base . 'partials/banner.php'); ?>
<?php

use Core\Db;
use Core\validate;
?>
<?php
$db = new Db('localhost', 'root1', 'root', 'projectsms');
$users = $db->read('users');

$val = new validate();
$id = array($val->str($_GET['id']));

$pusers = $db->read('projects_users', 'project_id=?', $id);
$rows = $db->read('projects', 'id=?', $id);
foreach ($rows as $row) {
?>

    <main>
        <div class="container w-50">

            <form action="projectedit" method="POST">

                <div class="form-group">
                    <label for="title">Title</label>
                    <input id="title" name="title" value="<?= $row['title']; ?>" type="text" required="required" class="form-control">
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <div>
                        <select id="category" name="category" required="required" class="custom-select">
                            <option value="HV" <?= ($row['category'] == 'HV') ? 'selected' : ''; ?>>HV</option>
                            <option value="EHV" <?= ($row['category'] == 'EHV') ? 'selected' : ''; ?>>EHV</option>
                            <option value="Maintenance" <?= ($row['category'] == 'Maintenance') ? 'selected' : ''; ?>>
                                Maintenance</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="tol">TOL</label>
                    <input id="tol" name="tol" type="text" value="<?= $row['tol']; ?>" required="required" class="form-control">
                </div>
                <div class="form-group">
                    <label for="pts">PTS</label>
                    <input id="pts" name="pts" type="text" value="<?= $row['pts']; ?>" class="form-control" required="required">
                </div>
                <div class="form-group">
                    <label for="contractor">Contractor</label>
                    <input id="contractor" name="contractor" type="text" value="<?= $row['contractor']; ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="contractno">Contract No</label>
                    <input id="contractor" name="contractno" type="text" value="<?= $row['contractno']; ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="archive">Archive</label>
                    <div>
                        <select id="archive" name="archive" required="required" class="custom-select">
                            <option value="1" <?php echo ($row['archived'] == '1') ? 'selected' : ''; ?>>Archived</option>
                            <option value="0" <?php echo ($row['archived'] == '0') ? 'selected' : ''; ?>>Unarchive</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="primaryassigneng">Primary Assigned Eng.</label>
                    <select id="primaryassigneng" name="primaryassigneng" value="<?= $row['primaryassigneng']; ?>" class="form-control">

                        <?php foreach ($users as $user) { ?>
                            <option value="<?= $user['id'] ?>" <?= ' ' . $selectd = ($user['id'] == $row['primaryassigneng']) ? 'selected' : '' ?>>
                                <?= $user['name'] ?>
                            </option>

                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="user_ids[]" class="form-label">Project Users: (multi-select)</label>
                    <select multiple class="form-control" id="user_ids" name="user_ids[]" required>
                        <!-- Generate the options dynamically -->
                        <?php foreach ($users as $user) : ?>
                            <?php $isSelected = false; ?>
                            <?php foreach ($pusers as $puser) : ?>
                                <?php if ($user['id'] == $puser['userid']) {
                                    $isSelected = true;
                                    break;
                                } ?>
                            <?php endforeach; ?>
                            <option value="<?php echo $user['id']; ?>" <?php echo $isSelected ? 'selected' : ''; ?>>
                                <?php echo $user['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION["csrf_token"]; ?>">
                    <input name="id" type="hidden" value="<?= $_GET['id'] ?>">
                    <button name="submit" type="submit" class="btn btn-primary mt-3 w-25 offset-5">Save</button>
                    <a href="#" onclick="history.go(-1);" class="btn btn-danger mt-3 ">Cancel</a>
                </div>
            </form>
        <?php } ?>
        </div>

    </main>

    <?php require($base . 'partials/footer.php'); ?>
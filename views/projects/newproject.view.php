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
<?php $users = $db->read('users'); ?>
<main>
    <div class="container w-50">

        <form action="projectsave" method="POST">
            <div class="form-group">
                <label for="title">Title *</label>
                <input id="title" name="title" type="text" required="required" class="form-control">
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <div>
                    <select id="category" name="category" required="required" class="custom-select">
                        <option value="HV">HV</option>
                        <option value="EHV">EHV</option>
                        <option value="Maintenance">Maintenance</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="tol">TOL *</label>
                <input id="tol" name="tol" type="text" required="required" class="form-control">
            </div>
            <div class="form-group">
                <label for="pts">PTS *</label>
                <input id="pts" name="pts" type="text" class="form-control" required="required">
            </div>
            <div class="form-group">
                <label for="contractor">Contractor</label>
                <input id="contractor" name="contractor" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label for="contractno">Contract No</label>
                <input id="contractor" name="contractno" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label for="primaryassigneng">Primary Assigned Eng.</label>
                <select id="primaryassigneng" name="primaryassigneng" class="form-control">
                    <option value="">Select</option>
                    <?php foreach ($users as $user) { ?>
                        <option value="<?= $user['id'] ?>"><?= $user['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="user_ids[]" class="form-label">Project Users: (multi-select) *</label>
                <select multiple class="form-control" id="user_ids" name="user_ids[]" required>
                    <!-- Generate the options dynamically -->
                    <?php foreach ($users as $user) : ?>
                        <option value="<?php echo $user['id']; ?>"><?php echo $user['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <button name="submit" type="submit" class="btn btn-primary mt-3 w-25 offset-5">Save</button>
                <a href="/" class="btn btn-danger mt-3 ">Cancel</a>
            </div>
        </form>
    </div>

</main>

<?php require($base . 'partials/footer.php'); ?>
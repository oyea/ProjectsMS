<?php require("auth.php"); ?>
<?php $base = __DIR__ . '/../'; ?>
<?php require($base . 'partials/head.php'); ?>
<?php require($base . 'partials/nav.php'); ?>
<?php require($base . 'partials/banner.php'); ?>
<?php $db = new Db('localhost', 'root1', 'root', 'projectsms');
?>

<?php $adminDisable =  isadmin($_SESSION['role']); ?>

<div class="container mt-5 d-flex justify-content-center">
    <div class="w-50">
        <h1>Add New User</h1>
        <form method="POST" action="usersave" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="username" class="form-label">Username/Badge No:*</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Full Name:*</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:*</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password:*</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role:*</label>
                <select name="role" id="role" class="form-control <?= $adminDisable ?>" required>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:*</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Upload Image:</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
            </div>

            <div class="mb-3">
                <label for="division" class="form-label">Division:*</label>
                <select name="division" id="division" class="form-control" required>
                    <option value="Department">Department</option>
                    <option value="COA">COA</option>
                    <option value="EOA">EOA</option>
                    <option value="WOA">WOA</option>
                    <option value="SOA">SOA</option>
                    <option value="Studies">Studies</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="emptype" class="form-label">Employment Type:</label>
                <select name="emptype" id="emptype" class="form-control" required>
                    <option value="saeng">Saudi Engineer</option>
                    <option value="nonsaeng">non-Saudi Engineer</option>
                    <option value="saadmin">Saudi Administration</option>
                    <option value="nonsaadmin">non-Saudi Administration</option>
                    <option value="sacont">Saudi Contractor</option>
                    <option value="nonsacon">non-Saudi Contractor</option>
                    <option value="pdp">PDP</option>
                    <option value="ojt">OJT</option>
                </select>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="approved" name="approved">
                <label class="form-check-label" for="approved">Approved</label>
            </div>

            <div class="mb-3">
                <label for="nationality" class="form-label">Nationality:</label>
                <input type="text" class="form-control" id="nationality" name="nationality">
            </div>

            <div class="mb-3">
                <label for="joiningdate" class="form-label">Joining Date:*</label>
                <input type="date" class="form-control" id="joiningdate" name="joiningdate" required>
            </div>

            <div class="mb-3">
                <label for="gradyear" class="form-label">Graduation Year:</label>
                <input type="date" class="form-control" id="gradyear" name="gradyear">
            </div>

            <div class="mb-3">
                <label for="vacbalance" class="form-label">Vacation Balance:</label>
                <input type="number" class="form-control" id="vacbalance" name="vacbalance">
            </div>

            <button type="submit" class="btn btn-primary">Save User</button>
            <a href="#" onclick="history.go(-1);" class="btn btn-danger">Cancel</a>
        </form>
    </div>
</div>

<?php require($base . 'partials/footer.php'); ?>
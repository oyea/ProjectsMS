<?php require("auth.php"); ?>
<?php $base = __DIR__ . '/../'; ?>
<?php require($base . 'partials/head.php'); ?>
<?php require($base . 'partials/nav.php'); ?>
<?php require($base . 'partials/banner.php'); ?>
<?php

use Core\Db;
use Core\validate;

$db = new Db('localhost', 'root1', 'root', 'projectsms');

// Get the user ID from the query string or form submission
$userID = isset($_GET['id']) ? $_GET['id'] : (isset($_POST['id']) ? $_POST['id'] : null);

// If no user ID is provided, redirect back to the user list page or show an error message
if (!$userID) {
    echo "User ID not provided!";
    exit;
}

// Retrieve the user data from the database
$user = $db->read('users', 'id = ?', array($userID));

// If user not found, redirect back to the user list page or show an error message
if (empty($user)) {
    echo "User not found!";
    exit;
}

$user = $user[0]; // Fetch the first user (assuming user ID is unique)
?>
<?php if (isadmin($_SESSION['role'])) {
    $status = "";
} else {
    $status = "disabled";
} ?>
<div class="container mt-5 d-flex justify-content-center">
    <div class="w-50">
        <h1>Edit User</h1>
        <form id="userupdate" method="POST" action="useredit" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $user['id']; ?>">
            <div class="mb-3">
                <label for="username" class="form-label">Username/Badge No:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= $user['user']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Full Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password:</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role:*</label>
                <select name="role" id="role" class="form-control <?= $status ?>" <?= !isAdmin($_SESSION['role']) ? 'disabled' : ''; ?> required>
                    <option value="user" <?= ($user['role'] == 'user') ? "SELECTED" : ""; ?>>User</option>
                    <option value="admin" <?= ($user['role'] == 'admin') ? "SELECTED" : ""; ?>>Admin</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Upload Image:</label>
                <input type="hidden" name="dbimage" value="<?= $user['image']; ?>">
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="division" class="form-label">Division:*</label>
                <select name="division" id="division" class="form-control" <?= !isAdmin($_SESSION['role']) ? 'disabled' : ''; ?> required>
                    <option value="Department" <?= ($user['division'] == 'Department') ? "SELECTED" : ""; ?>>Department
                    </option>
                    <option value="COA" <?= ($user['division'] == 'COA') ? "SELECTED" : ""; ?>>COA</option>
                    <option value="EOA" <?= ($user['division'] == 'EOA') ? "SELECTED" : ""; ?>>EOA</option>
                    <option value="WOA" <?= ($user['division'] == 'WOA') ? "SELECTED" : ""; ?>>WOA</option>
                    <option value="SOA" <?= ($user['division'] == 'SOA') ? "SELECTED" : ""; ?>>SOA</option>
                    <option value="Studies" <?= ($user['division'] == 'Studies') ? "SELECTED" : ""; ?>>Studies</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="emptype" class="form-label">Employment Type:</label>
                <select name="emptype" id="emptype" class="form-control" <?= !isAdmin($_SESSION['role']) ? 'disabled' : ''; ?> required>
                    <option value="Saudi Engineer" <?= ($user['emptype'] === "Saudi Engineer") ? "selected" : ""; ?>>
                        Saudi Engineer</option>
                    <option value="non-Saudi Engineer" <?= ($user['emptype'] === "non-Saudi Engineer") ? "selected" : ""; ?>>non-Saudi Engineer
                    </option>
                    <option value="Saudi Administration" <?= ($user['emptype'] === "Saudi Administration") ? "selected" : ""; ?>>Saudi Administration
                    </option>
                    <option value="non-Saudi Administration" <?= ($user['emptype'] === "non-Saudi Administration") ? "selected" : ""; ?>>non-Saudi
                        Administration</option>
                    <option value="Saudi Contractor" <?= ($user['emptype'] === "Saudi Contractor") ? "selected" : ""; ?>>Saudi Contractor</option>
                    <option value="non-Saudi Contractor" <?= ($user['emptype'] === "non-Saudi Contractor") ? "selected" : ""; ?>>non-Saudi Contractor
                    </option>
                    <option value="PDP" <?= ($user['emptype'] === "PDP") ? "selected" : ""; ?>>PDP</option>
                    <option value="OJT" <?= ($user['emptype'] === "OJT") ? "selected" : ""; ?>>OJT</option>
                </select>

            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input <?= $status ?>" id="approved" name="approved" <?= ($user['approved'] == '1') ? 'checked' : ''; ?> <?= !isAdmin($_SESSION['role']) ? 'disabled' : ''; ?>>
                <label class="form-check-label" for="">Approved</label>
            </div>

            <div class="mb-3">
                <label for="nationality" class="form-label">Nationality:</label>
                <input type="text" class="form-control" id="nationality" name="nationality" value="<?= $user['nationality']; ?>">
            </div>

            <div class="mb-3">
                <label for="joiningdate" class="form-label">Joining Date:</label>
                <input type="date" class="form-control" id="joiningdate" name="joiningdate" value="<?= $user['joiningdate']; ?>">
            </div>

            <div class="mb-3">
                <label for="gradyear" class="form-label">Graduation Year:</label>
                <input type="date" class="form-control" id="gradyear" name="gradyear" value="<?= $user['gradyear']; ?>">
            </div>

            <div class="mb-3">
                <label for="vacbalance" class="form-label">Vacation Balance:</label>
                <input type="number" class="form-control" id="vacbalance" name="vacbalance" value="<?= $user['vacbalance']; ?>">
            </div>

            <input type="hidden" name="csrf_token" value="<?= $_SESSION["csrf_token"]; ?>">

            <button type="submit" class="btn btn-primary">Update User</button>
            <a href="#" onclick="history.go(-1);" class="btn btn-danger">Cancel</a>
        </form>
    </div>
</div>

<?php require($base . 'partials/footer.php'); ?>
<script>
    document.getElementById('userupdate').addEventListener('submit', function() {
        document.getElementById('division').removeAttribute('disabled');
        document.getElementById('role').removeAttribute('disabled');
        document.getElementById('approved').removeAttribute('disabled');
        document.getElementById('emptype').removeAttribute('disabled');
    });
</script>
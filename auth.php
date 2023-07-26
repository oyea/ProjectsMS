<?php
$db = new Db('localhost', 'root', 'root', 'projectsms');
session_start();

// Check if the user is not logged in (session not set or expired)
if (!isset($_SESSION["uid"]) || time() > $_SESSION["timeout"]) {
    $uid = $_SESSION["uid"] ?? "";
    $db->update('users', array('online' => '0'), 'id=?', array($uid));
    // Redirect to the login page
    header("Location: login");
    exit;
}

// Update the session timeout to keep the user logged in
$_SESSION["timeout"] = time() + 900; // 15 minutes * 60 seconds = 900 seconds

//allow clickable edit,delete,archive only if the author of project or admin
function authBtns($user, $author, $role)
{
    // Check if the user is the author of the project or an admin
    $isAuthorOrAdmin = ($user == $author || $role == "admin");

    // Return 'disabled-link' if not authorized, or an empty string otherwise
    return $isAuthorOrAdmin ? '' : 'disabled';
}
function isAdmin($role)
{
    return ($role == "admin") ?  true : false;
}
function isAssigned($table, $tid, $uid)
{
    $iSassigned = false;
    $db = new Db('localhost', 'root', 'root', 'projectsms');
    $users = $db->read($table, 'id=? AND assignuser=?', array($tid, $uid));
    return ($users) ? true : false;
}
function isAuthor($table,$tid, $uid)
{
    $db = new Db('localhost', 'root', 'root', 'projectsms');
    $tasks = $db->read($table, 'id=? AND author=?', array($tid, $uid));
    return ($tasks) ? true : false;
}
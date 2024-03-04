<?php
$db = new Db('localhost', 'root', 'root', 'projectsms');
session_start();
//set user offline 
$uid = $_SESSION["uid"];
$db->update('users', array('online' => '0'), 'id=?', array($uid));
// Clear all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page
header("Location: login");
exit;

<?php

use Core\Db;
use Core\validate;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    if (hash_equals($_SESSION["csrf_token"], $_POST['csrf_token'])) {
        $db = new Db('localhost', 'root1', 'root', 'projectsms');

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
    } else {
        // Invalid CSRF token
        echo "Invalid CSRF token!";
    }
}

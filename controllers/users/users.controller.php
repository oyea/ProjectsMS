<?php
$heading = "Users";

 require("auth.php");

 $base = __DIR__ . '/../../'; 
 
 //require the models
 require $base.'models/users/users.model.php';
 // require the partials 
 require($base . 'views/partials/head.php');
 require($base . 'views/partials/nav.php'); 
 require($base . 'views/partials/banner.php'); 
 
 require 'functions.php'; 

$valid = new validate();
$limit = $_POST['limit'] ?? 100;
$valid->str($limit);
$search = $_POST['search']  ?? "";
$valid->str($search);
$approved = $_POST['approved']  ?? "all";
$countusers = $db->read('users');

//require the views
require 'views/users/users.view.php';

//require footer
require $base .'views/partials/footer.php';
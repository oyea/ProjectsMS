<?php 
$heading = "Projects";
//require the auth
require "auth.php";
$base = __DIR__ . '/../../' ; 

 //require the model
require $base . 'models/projects/projects.model.php';

//require the partials
require $base . 'views/partials/head.php';
require $base . 'views/partials/nav.php';
require $base . 'views/partials/banner.php';

// require the functions
require 'functions.php';


$valid = new validate();
$limit = $_POST['limit'] ?? 100;
$valid->str($limit);
$search = $_POST['search'] ?? "";
$valid->str($search);
$archived = $_POST['archived'] ?? "all";
$countproject = $db->read('projects'); 

// require the views
require 'views/projects/projects.view.php';

// require the footer
require $base . 'views/partials/footer.php';
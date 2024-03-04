<?php
$heading = "Task";
 require 'auth.php' ;
 $base = __DIR__ . '/../../';
  //require the model
 require $base . 'models/tasks/task.model.php';

 require($base . 'views/partials/head.php'); 
 require($base . 'views/partials/nav.php'); 
 require($base . 'views/partials/banner.php'); 
 
 $tid = trim($_GET['id']) ?? ""; 

 require 'functions.php'; 

require 'views/tasks/task.view.php';

require($base . 'views/partials/footer.php'); 
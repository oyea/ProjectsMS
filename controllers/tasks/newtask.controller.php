<?php

use Core\Db;
use Core\validate;

$db = new Db('localhost', 'root1', 'root', 'projectsms');
$pid = $_GET['id'];
$project = $db->read('projects', 'id=?', array($pid));
$heading = "New Task in the Project : <b>" . $project[0]['title'] . "</b>";
require 'views/tasks/newtask.view.php';

<?php
function user($id)
{
    $db = new Db('localhost', 'root', 'root', 'projectsms');
    $users = $db->read('users', 'id=?', array($id));
    echo $user = $users['0']['name'] ?? NULL;
}
function project($id)
{
    $db = new Db('localhost', 'root', 'root', 'projectsms');
    $projects = $db->read('projects', 'id=?', array($id));
    echo $project = $projects['0']['title'] ?? NULL;
}
function taskcateg($id)
{
    $db = new Db('localhost', 'root', 'root', 'projectsms');
    $categories = $db->read('taskscategories', 'id=?', array($id));
    echo $category = $categories['0']['category'] ?? NULL;
}

function tasksubcateg($id)
{
    $db = new Db('localhost', 'root', 'root', 'projectsms');
    $subcategories = $db->read('subtaskscategories', 'id=?', array($id));
    echo $subcategory = $subcategories['0']['subcat'] ?? NULL;
}

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

// days difference excluding fridays and saturdays
function daysDiff($Recedate, $replyDate)
{
    $date1 = new DateTime($Recedate);
    $date2 = new DateTime($replyDate);
    if ($date2 < $date1) {
        echo "Reply Date is less than the Received Date";
        die();
    }
    $diff = $date2->diff($date1)->days + 1;

    while ($date1 <= $date2) {
        if ($date1->format('N') == 5 || $date1->format('N') == 6) {
            $diff--;
        }
        $date1->modify('+1 day');
    }

    return $diff;
}

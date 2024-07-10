<?php
function user($id)
{
    $db = new Db('localhost', 'root1', 'root', 'projectsms');
    $users = $db->read('users', 'id=?', array($id));
    echo $user = $users['0']['name'] ?? NULL;
}
function project($id)
{
    $db = new Db('localhost', 'root1', 'root', 'projectsms');
    $projects = $db->read('projects', 'id=?', array($id));
    echo $project = $projects['0']['title'] ?? NULL;
}
function taskcateg($id)
{
    $db = new Db('localhost', 'root1', 'root', 'projectsms');
    $categories = $db->read('taskscategories', 'id=?', array($id));
    echo $category = $categories['0']['category'] ?? NULL;
}

function tasksubcateg($id)
{
    $db = new Db('localhost', 'root1', 'root', 'projectsms');
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

//update task weight
function updateTaskWeight($category, $tid)
{
    $db = new Db('localhost', 'root1', 'root', 'projectsms');
    //get weight from task categories table
    $categoryInfo = $db->read('taskscategories', 'id=?', array($category));
    $weight =  $categoryInfo[0]['weight'];
    $pduration =  $categoryInfo[0]['duration'];
    //update task weight
    $wdata = ['weight' => $weight];
    $update = $db->update('tasks', $wdata, 'id=?', array($tid));

    //get task info and calculate score if days count is not null
    $task = $db->read('tasks', 'id=?', array($tid));
    if (!empty($task[0]['dayscount'])) {
        $score = $pduration / $task[0]['dayscount'] * $weight * 10;
        $sdata = ['score' => $score];
        $update = $db->update('tasks', $sdata, 'id=?', array($tid));
    }
}
// notification function for multi users you can put userids in array instead of assigned user like [$uid.$authr..etc]
function createNotification($db, $userids, $message, $link)
{

    if (is_array($userids)) {
        foreach ($userids as $uid) {
            $notifData = array(
                "uid" => $uid,
                "msg" => $message,
                "link" => $link,
            );
            $insertNotif = $db->create("notifications", $notifData);
        }
    } else {
        $notifData = array(
            "uid" => $userids,
            "msg" => $message,
            "link" => $link,
        );
        $db->create('notifications', $notifData);
    }
}

//set notifications to read
function readNotification($db, $uid, $link)
{
    $db->update('notifications', array('is_read' => 1), 'uid=? AND link=?', array($uid, $link));
}

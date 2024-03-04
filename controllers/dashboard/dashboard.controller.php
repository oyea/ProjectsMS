<?php
date_default_timezone_set("Asia/Riyadh");
$curryear = date("Y");
$heading = "Dashboard";
$db = new Db('localhost', 'root', 'root', 'projectsms');

$actproj = $db->read('projects', 'archived=?', array(0));
$archproj = $db->read('projects', 'archived=?', array(1));

$hvProjects = array_filter($actproj, function ($project) {
    return $project['category'] === 'HV';
});
$ehvProjects = array_filter($actproj, function ($project) {
    return $project['category'] === 'EHV';
});
$maintenanceProjects = array_filter($actproj, function ($project) {
    return $project['category'] === 'Maintenance';
});

$archhvProjects = array_filter($archproj, function ($project) {
    return $project['category'] === 'HV';
});
$archehvProjects = array_filter($archproj, function ($project) {
    return $project['category'] === 'EHV';
});
$archmaintenanceProjects = array_filter($archproj, function ($project) {
    return $project['category'] === 'Maintenance';
});

// current year active projects
$currYearActProj = array_filter($actproj, function ($project) {
    $curryear = date("Y");
    $projectYear = date("Y", strtotime($project['cdate']));
    return $projectYear === $curryear;
});
// current year archived projects
$currYearArchProj = array_filter($archproj, function ($project) {
    $curryear = date("Y");
    $projectYear = date("Y", strtotime($project['cdate']));
    return $projectYear === $curryear;
});

// ************************* tassks *******************************************
$pendTasks = $db->read('tasks', 'progress=?', array(0));
$compTasks = $db->read('tasks', 'progress=?', array(100));
$tasks = $db->read('tasks');

// tasks received and replied today
$todayPenTasks =
    array_filter($pendTasks, function ($task) {
        $today = date("Y-m-d");
        $taskDate = date("Y-m-d", strtotime($task['recedate']));
        return $taskDate === $today;
    });
$todayCompTasks =
    array_filter($compTasks, function ($task) {
        $today = date("Y-m-d");
        $taskDate = date("Y-m-d", strtotime($task['replydate']));
        return $taskDate === $today;
    });


// tasks received and replied more than 10 days
$penTasks10 =
    array_filter($pendTasks, function ($task) {
        $tenDaysAgo = date('Y-m-d', strtotime(date('Y-m-d') . ' - 10 days'));
        return  $task['recedate'] <= $tenDaysAgo;
    });
$compTasks10 =
    array_filter($compTasks, function ($task) {
        $tenDaysAgo = date('Y-m-d', strtotime(date('Y-m-d') . ' - 10 days'));
        return  $task['replydate'] <= $tenDaysAgo;
    });
// tasks received and replied more than 15 days
$penTasks15 =
    array_filter($pendTasks, function ($task) {
        $fiftenDaysAgo =  date('Y-m-d', strtotime(date('Y-m-d') . ' - 15 days'));
        return  $task['recedate'] <= $fiftenDaysAgo;
    });
$compTasks15 =
    array_filter($compTasks, function ($task) {
        $fiftenDayAgo =  date('Y-m-d', strtotime(date('Y-m-d') . ' - 15 days'));
        return $task['replydate'] <= $fiftenDayAgo;
    });

// tasks categories into vars
$categoriesDaysCount = [];
$categoryTasksCountarr = [];
for ($i = 1; $i <= 24; $i++) {
    $tCatNumber = "tCat" . $i;
    $$tCatNumber = array_filter($tasks, function ($cat) use ($i) {
        return $cat['category'] === (string)$i;
    });
    // Calculate the sum of dayscount for the current category
    $categoriesDaysCount[$i] = array_sum(array_column($$tCatNumber, 'dayscount'));

    // Calculate the average dayscount for the current category
    $categoryTasksCount = count($$tCatNumber);
    $categoryTasksCountarr[$i] = $categoryTasksCount;
    $categoriesAverageDaysCount[$i] = $categoryTasksCount > 0 ? $categoriesDaysCount[$i] / $categoryTasksCount : 0;
}
//function to call category name 

require 'views/dashboard/dashboard.view.php';

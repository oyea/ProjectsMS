 <!-- Bootstrap CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <link rel="stylesheet" type="" href="views/css/style.css">
 <?php require("auth.php"); ?>
 <?php require("functions.php"); ?>
 <?php

    use Core\Db;
    use Core\validate;

    date_default_timezone_set("Asia/Riyadh");
    $currdt = date("Y-m-d H:i:s");
    $val = new validate();
    $tid = array($_POST['tid']);
    $pid = array($_POST['pid']);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $db = new Db('localhost', 'root1', 'root', 'projectsms');

        //calculate days diff between received date and reply date if available
        $dayscount = NULL;
        if (!empty($_POST['recedate']) && !empty($_POST['replydate'])) {
            $dayscount = daysDiff($_POST['recedate'], $_POST['replydate']);
        }

        $data = array(
            'title' => $val->str($_POST['title']),
            'category' => $val->str($_POST['category']),
            'subcat' => $val->str($_POST['subcat'] ?? ""),
            'revno' => $val->str($_POST['revno']),
            'letterno' => $val->str($_POST['letterno']),
            'letterdate' => $val->str($_POST['letterdate']),
            'recedate' => $val->str($_POST['recedate']),
            'replyno' => $val->str($_POST['replyno']),
            'replydate' => ($_POST['replydate'] !== '') ? $val->str($_POST['replydate']) : NULL,
            'conshrs' => $val->str($_POST['conshrs']),
            'progress' => $val->str($_POST['progress']),
            'dayscount' => ($dayscount) ? $dayscount : NULL,
            'assignuser' => $val->str($_POST['assignuser']),
        );
        $inserted = $db->update('tasks', $data, 'id=?', $tid);

        if ($inserted) {
            echo "<div class='centerdiv text-center shadow w-25 mt-5 rounded-pill h6'>
        Task Updated Successfully <img src='/views/imgs/icons/verified.gif' width='50' height='50'> 
        </div>";
            // send notifications, for multi users you can put userids in array instead of assigned user like [$uid.$authr..etc]
            $message = "Modified/Exisiting Task assigned to you:{$_POST['title']}";
            $link = "task?id=" . $tid[0];
            createNotification($db, $_POST['assignuser'], $message, $link);

            //update weight
            if (!empty($_POST['category'])) {
                updateTaskWeight($_POST['category'], $tid[0]);
            }
            header("Refresh: 2; URL=/task?id=$tid[0]");
        } else {
            echo "<div class='container shadow w-50 mt-5 rounded-pill'> 
         <h1>Failed to Update Task. <img src='/views/imgs/icons/animatedX.gif' width='50' height='50'></h1> "
                .
                "<br><div class='text-center'><a class='btn btn-primary btn-sm mt-1 mb-2' href='#' onclick='history.go(-1);'>Go Back</a> </div></div>";
        }
    } else {
        header('location:404.php');
    }

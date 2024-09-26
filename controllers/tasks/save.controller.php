 <!-- Bootstrap CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <link rel="stylesheet" type="" href="views/css/style.css">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">

 <?php
    require("auth.php");
    require("functions.php");
    require("emailSender.php");
    ?>

 <?php

    use Core\Db;
    use Core\validate;

    date_default_timezone_set("Asia/Riyadh");
    $currdt = date("Y-m-d H:i:s");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $db = new Db('localhost', 'root1', 'root', 'projectsms');
        $val = new validate();
        $pid = $_POST['pid'];


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
            'author' => $_SESSION["uid"],
            'project' => $pid,
            'cdate' => $currdt,
            'progress' => $val->str($_POST['progress']),
            'dayscount' => $dayscount ? $dayscount : NULL,
            'assignuser' => $val->str($_POST['assignuser']),
        );
        $inserted = $db->create('tasks', $data);

        if ($inserted) {
            echo "<div class='centerdiv text-center shadow w-25 mt-5 rounded-pill'>
        <h5> New Task created Successfully</h5> <img src='/views/imgs/icons/verified.gif' width='80' height='80'> 
        </div>";
            if (!empty($_POST['category'])) {
                updateTaskWeight($_POST['category'], $inserted);
            }

            // send notifications, for multi users you can put userids in array instead of assigned user like [$uid.$authr..etc]
            $message = "New task assigned to you:{$_POST['title']}";
            $link = "task?id=" . $inserted;

            createNotification($db, $_POST['assignuser'], $message, $link);

            // send email 
            $recipient = "user@example.com";
            $emailSubject = "New Task Assignment";
            $emailMessage = "New task assigned:{$_POST['title']}";
            $emailSent = sendEmail($recipient, $emailSubject, $emailMessage);

            if ($emailSent) {
                echo "Email sent successfully.";
            } else {
                echo "Email sending failed.";
            }

            header("Refresh: 2.3; URL=project?id=$pid");
        } else {
            echo "<div class='centerdiv text-center shadow w-50 mt-5 rounded-pill'> 
         <h1>Failed to create Task. <img src='views/imgs/icons/animatedX.gif' width='50' height='50'></h1> "
                . $db->error .
                "<br><a class='btn btn-primary btn-sm mt-1' href='#' onclick='history.go(-1);'>Go Back</a>  </div>";
        }
    } else {
        header('location:404.php');
    }
    ?>

 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
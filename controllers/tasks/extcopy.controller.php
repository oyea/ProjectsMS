 <!-- Bootstrap CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <link rel="stylesheet" type="" href="views/css/style.css">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
 <?php require("auth.php"); ?>
 <?php

    use Core\Db;
    use Core\validate;

    $val = new validate();
    date_default_timezone_set("Asia/Riyadh");
    $currdt = date("Y-m-d H:i:s");

    if (isset($_POST['tid'])) {

        $tid = $val->str($_POST['tid']);
        $newpid = $val->str($_POST['pid']);

        $author = $_SESSION['uid'];
        // Get the author from the user session
        $assignuser = ""; //$_SESSION['uid']; // Replace with actual session variable later

        $db = new Db('localhost', 'root1', 'root', 'projectsms');
        // Retrieve the task data
        $taskData = $db->read('tasks', 'id = ?', [$tid]);


        if (!empty($taskData)) {
            // Create a copy of the task
            $newtaskData = $taskData[0];
            // get the task's project to redirect to it after copying
            $pid = $newtaskData['project'];
            // Add a copy suffix to the title and change the project
            $newtaskData['title'] = 'Copy of_ ' . $newtaskData['title'];
            $newtaskData['project'] = $newpid;
            $newtaskData['assignuser'] = $assignuser;
            $newtaskData['author'] = $author;
            $newtaskData['cdate'] = $currdt;

            // Remove the ID to ensure a new record is created
            unset($newtaskData['id']);

            // Insert the new task into the database
            $newtaskId = $db->create('tasks', $newtaskData);

            if ($newtaskId) {
                echo "<div class='centerdiv text-center shadow w-50 mt-5 rounded-pill'>
        <h4>task copied Successfully</h4> <img src='/views/imgs/icons/verified.gif' width='80' height='80'> 
        </div>";
            } else {
                echo "Error copying the task";
            }
        } else {
            echo "task not found";
        }
    }
    ?>
 <script>
     setTimeout(function() {
         window.close();
     }, 2300); // Close the window after 2.3 seconds (2300 milliseconds)
 </script>
 <!-- Bootstrap CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <link rel="stylesheet" type="" href="views/css/style.css">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>

 <?php require("auth.php"); ?>
 <?php
    date_default_timezone_set("Asia/Riyadh");
    $currdt = date("Y-m-d H:i:s");
    $validate = new validate();
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $validate->str($_POST['title']) != "") {
        $db = new Db('localhost', 'root1', 'root', 'projectsms');
        $data = array(
            'title' => $validate->str($_POST['title']),
            'cdate' => $currdt,
            'category' => $validate->str($_POST['category']),
            'tol' => $validate->str($_POST['tol']),
            'pts' => $validate->str($_POST['pts']),
            'contractor' => $validate->str($_POST['contractor']),
            'contractno' => $validate->str($_POST['contractno']),
            'primaryassigneng' => $validate->str($_POST['primaryassigneng']),
            'archived' => '0',
            'author' => $_SESSION["uid"],
        );
        $inserted = $db->create('projects', $data);
        if ($inserted) {
            $userIds = $_POST['user_ids'];
            foreach ($userIds as $userId) {
                $userData = [
                    'project_id' => $inserted,
                    'userid' => $userId,
                ];

                $db->create('projects_users', $userData);
            }
            echo "<div class='rounded-3 centerdiv h4 text-center shadow w-50 mt-5 rounded-pill'>
        New Project created Successfully <img src='/views/imgs/icons/verified.gif' width='80' height='80'> 
        </div>";
            header("Refresh: 2.0; URL=/");
        } else {
            echo "<div class='centerdiv text-center shadow w-50 mt-5 rounded-pill'> 
         <h1>Failed to create Project. <img src='views/imgs/icons/animatedX.gif' width='50' height='50'></h1> "
                . $db->titleError['titerr']  .
                "<br><a class='btn btn-primary btn-sm mt-1' href='#' onclick='history.go(-1);'>Go Back</a>  </div>";
        }
    } else {
        header('location:404.php');
    }

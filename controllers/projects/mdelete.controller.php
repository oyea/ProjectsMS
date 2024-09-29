 <!-- Bootstrap CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <link rel="stylesheet" type="" href="views/css/style.css">

 <?php require("auth.php"); ?>
 <?php

    use Core\Db;
    use Core\validate;
    ?>
 <?php
    if (empty($_POST['chkbox'])) {

        header("location: /");
    }

    $db = new Db('localhost', 'root1', 'root', 'projectsms');

    $datas = $_POST['chkbox'];

    foreach ($datas as $data) {
        $delete = $db->delete('projects', 'id=?', array($data));
        $delete = $db->delete('projects_users', 'project_id=?', array($data));
        $delete = $db->delete('tasks', 'project=?', array($data));
    }
    if ($delete) {
        echo "<div class='rounded-5 centerdiv h5 text-center shadow w-50 rounded-pill'> <br>
         Projects and its realted tasks/users were Deleted Successfully <br>
         <img src='/views/imgs/icons/Gifdelete.gif' width='50' height='50'> </div>";
        header("Refresh: 2; URL=/");
    } else {
        echo "Error";
    }

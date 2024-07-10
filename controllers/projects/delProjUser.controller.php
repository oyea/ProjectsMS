 <!-- Bootstrap CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <link rel="stylesheet" type="" href="views/css/style.css">
 <?php require("auth.php"); ?>
 <?php
    $val = new validate();
    if (isset($_GET["uid"]) && !empty($_GET["uid"]) && isset($_GET["pid"]) && !empty($_GET["pid"])) {
        $db = new Db('localhost', 'root1', 'root', 'projectsms');
        $pid = $val->str($_GET['pid']);
        $deleted = $db->delete('projects_users', 'project_id=? AND userid=?', array($val->str($_GET['pid']), $val->str($_GET['uid'])));

        if ($deleted) {
            echo "<div class='centerdiv text-center shadow w-25 mt-5 rounded-pill'>
        User Removed from the Project Successfully <img src='/views/imgs/icons/Gifdelete.gif' width='50' height='50'> 
        </div>";
            header("Refresh: 2; URL=/project?id=$pid");
        } else {
            echo "Error";
        }
    }
    ?>
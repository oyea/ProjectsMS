 <!-- Bootstrap CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <link rel="stylesheet" type="" href="views/css/style.css">
 <?php require("auth.php"); ?>
 <?php
    date_default_timezone_set("Asia/Riyadh");
    $currdt = date("Y-m-d H:i:s");
    if (empty($_GET['id'])) {

        header("location: users");
    }

    $db = new Db('localhost', 'root1', 'root', 'projectsms');

    $id = htmlspecialchars(trim($_GET['id']));
    $params = array($id);

    $blocked = $db->update('users', array('approved' => '0'), 'id=?', $params);
    if ($blocked) {
        echo "<div class='centerdiv text-center shadow w-25 mt-5 rounded-pill'>
        User Blocked Successfully <img src='/views/imgs/icons/banuser.png' width='50' height='50'> 
        </div>";
        header("Refresh: 1.5; URL=users");
    } else {
        echo "Error " . $db->error;
    }

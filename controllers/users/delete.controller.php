 <!-- Bootstrap CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <link rel="stylesheet" type="" href="views/css/style.css">
 <?php require("auth.php"); ?>
 <?php

    use Core\Db;
    use Core\validate;

    $validate = new validate();
    if (isset($_GET["id"]) && !empty($_GET["id"]) && hash_equals($_SESSION["csrf_token"], $_POST['csrf_token'])) {
        $db = new Db('localhost', 'root1', 'root', 'projectsms');

        $id = array($validate->str($_GET["id"]));

        $deleted = $db->delete('users', 'id=?', $id);
        if ($deleted) {
            echo "<div class='centerdiv text-center shadow w-25 mt-5'>
     User Deleted Successfully <img src='/views/imgs/icons/Gifdelete.gif' width='50' height='50'>
 </div>";
            header("Refresh: 1; URL=users");
        } else {
            echo "Error";
        }
    }
    ?>
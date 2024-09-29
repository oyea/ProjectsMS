 <!-- Bootstrap CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <link rel="stylesheet" type="" href="views/css/style.css">

 <?php require("auth.php"); ?>
 <?php

    use Core\Db;
    use Core\validate;
    ?>
 <?php
    require(__DIR__ . '/../datetime.php');
    if (empty($_POST['chkbox'])) {

        header("location: /");
    }
    $db = new Db('localhost', 'root1', 'root', 'projectsms');
    $ids = $_POST['chkbox'];
    foreach ($ids as $id) {
        $archive = $db->update("projects", array("archived" => "1", "archivedate" => "$currdt"), "id=$id");
    }


    if ($archive !== false) {
        header("Refresh: 1.5; URL=/");
        echo "<div class='centerdiv text-center shadow w-25 mt-5 rounded-pill'>Projects Archived Successfully <img src='/views/imgs/icons/archive.gif' width='50' height='50'></div>";
    } else {
        echo "Error: " . $db->connection->error; // Display the database error message
        echo "SQL: " . $db->connection->error; // Display the SQL statement for debugging purposes
    }

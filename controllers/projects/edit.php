 <!-- Bootstrap CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <link rel="stylesheet" type="" href="views/css/style.css">
 <?php require("auth.php"); ?>
 <?php
    date_default_timezone_set("Asia/Riyadh");
    $currdt = date("Y-m-d H:i:s");
    $val = new validate();
    $id = array($_POST['id']);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $db = new Db('localhost', 'root', 'root', 'projectsms');
        $archiveDT = ($_POST['archive'] == 1) ? $currdt : NULL;
        $data = array(
            'title' => $val->str($_POST['title']),
            'category' => $val->str($_POST['category']),
            'tol' => $val->str($_POST['tol']),
            'pts' => $val->str($_POST['pts']),
            'contractor' => $val->str($_POST['contractor']),
            'contractno' => $val->str($_POST['contractno']),
            'archived' => $val->str($_POST['archive']),
            'archivedate' => $archiveDT,
            'primaryassigneng' => $val->str($_POST['primaryassigneng'])
        );
        $inserted = $db->update('projects', $data, 'id=?', $id);

        if ($inserted) {
            //Delete from project users to insert the updated users first
            $db->delete('projects_users', 'project_id=?', array($id[0]));

            // update the users after Selected
            $userIds = $_POST['user_ids'];
            foreach ($userIds as $userId) {
                $userData = [
                    'project_id' => $id[0],
                    'userid' => $userId,
                ];

                $db->create('projects_users', $userData);
            }
            echo "<div class='centerdiv text-center shadow w-25 mt-5'>
        Project Updated Successfully <img src='/views/imgs/icons/verified.gif' width='50' height='50'> 
        </div>";
            header("Refresh: 2; URL=/project?id=$id[0]");
        } else {
            echo "<div class='container shadow w-50 mt-5 rounded-pill'> 
         <h1>Failed to Update Project. <img src='/views/imgs/icons/animatedX.gif' width='50' height='50'></h1> "
                . $db->titleError['titerr'] ?? '',
            "<br><div class='text-center'><a class='btn btn-primary btn-sm mt-1 mb-2' href='#' onclick='history.go(-1);'>Go Back</a> </div></div>";
        }
    } else {
        header('location:404.php');
    }
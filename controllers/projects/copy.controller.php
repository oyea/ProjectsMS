 <!-- Bootstrap CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <link rel="stylesheet" type="" href="views/css/style.css">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>

 <?php require("auth.php"); ?>
 <?php
    date_default_timezone_set("Asia/Riyadh");
    $currdt = date("Y-m-d H:i:s");
    $val = new validate();
    if (isset($_GET['pid'])) {

        $pid = $val->str($_GET['pid']);

        // Get the author from the user session
        $author = $_SESSION['uid']; //$_SESSION['user_id']; // Replace with actual session variable later

        $db = new Db('localhost', 'root1', 'root', 'projectsms');
        // Retrieve the project data
        $projectData = $db->read('projects', 'id = ?', [$pid]);

        if (!empty($projectData)) {
            // Create a copy of the project
            $newProjectData = $projectData[0];

            // Add a copy suffix to the title
            $newProjectData['title'] = 'Copy of_ ' . $newProjectData['title'];

            $newProjectData['author'] = $author;
            $newProjectData['cdate'] = $currdt;

            // Remove the ID to ensure a new record is created
            unset($newProjectData['id']);

            // Insert the new project into the database
            $newProjectId = $db->create('projects', $newProjectData);

            if ($newProjectId) {
                echo "<div class='centerdiv text-center shadow w-50 mt-5 rounded-pill'>
        <h4>Project copied Successfully</h4> <img src='/views/imgs/icons/verified.gif' width='80' height='80'> 
        </div>";
                header("Refresh: 2.3; URL=/project?id=$newProjectId");
            } else {
                echo "<div class='centerdiv text-center shadow w-50 mt-5 rounded-pill'>
        <h4><img src='/views/imgs/icons/animatedX.gif' width='50' height='50'>
        Error copying the project </h4><br>" . $db->titleError['titerr'] . " or this is a second copy change the second copy's name
        <br> <a class='btn btn-primary btn-sm mt-1 mb-2' href='#' onclick='history.go(-1);'>Go Back</a></div>";
            }
        } else {
            echo "Project not found";
        }
    }

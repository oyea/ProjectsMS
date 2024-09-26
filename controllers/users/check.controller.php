 <!-- Bootstrap CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <link rel="stylesheet" type="" href="views/css/style.css">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">

 <?php

    use Core\Db;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve the form input values
        $username = $_POST["user"];
        $password = $_POST["password"];
        $loggedin = false;

        // Validate the form inputs (you can add more validation as needed)
        if (empty($username) || empty($password)) {
            // Handle validation errors, e.g., display error message or redirect back to the login page
            echo "Username and password are required!";
            exit;
        }

        // Connect to the database
        $db = new Db('localhost', 'root1', 'root', 'projectsms');

        // Prepare the SQL statement
        $users = $db->read('users', 'user = ?', array($username));

        // Check if the user exists
        if ($db->count > 0) {
            foreach ($users as $user) {
                $hashedPassword = $user["password"];

                // Verify the password
                if (password_verify($password, $hashedPassword)) {
                    // Password is correct, login successful

                    // Start a new session or resume the existing session
                    session_start();

                    // Store user information in session variables
                    $_SESSION["uid"] = $user["id"];
                    $_SESSION["user"] = $user["user"];
                    $_SESSION["name"] = $user["name"];
                    $_SESSION["email"] = $user["email"];
                    $_SESSION["division"] = $user["division"];
                    $_SESSION["role"] = $user["role"];
                    $_SESSION["image"] = $user["image"];

                    //set logget in to true
                    $loggedin = true;
                    $_SESSION["loggedin"] = $loggedin;
                    //set user online in the db
                    $db->update('users', array('online' => '1'), 'id=?', array($user["id"]));

                    // Set session timeout to 15 minutes (900 seconds)
                    $_SESSION["timeout"] = time() + 900; // 15 minutes * 60 seconds = 900 seconds

                    // You can redirect the user to the dashboard or another page here
                    echo "<div class='centerdiv text-center shadow w-25 mt-5 rounded-pill'>
        <h4 class='mt-2'>Welcome, " . explode(" ", $user["name"])['0'] . "
        <img class='userimg' src ='" . (($user["image"]) ? $user['image'] : "/views/imgs/guest.png") . "'> <br>
        <img src='/views/imgs/icons/success2.gif' width='50' height='50'> 
        </h4></div>";
                    header("Refresh: 1.0; URL=/");
                } else {
                    // Incorrect password
                    echo "<div class='centerdiv text-center shadow w-25 mt-5 rounded-pill'>
        <h4 class='mt-2'> Incorrect password! <img src='/views/imgs/icons/animatedX.gif' width='50' height='50'>
            </h4></div>";
                }
            }
        } else {
            // User does not exist
            echo "<div class='centerdiv text-center shadow w-50 mt-5'>
        <h4 class='mt-2'>Sorry, Wrong user<img src='/views/imgs/icons/animatedx.gif' width='50' height='50'></h4>
        <br><a class='btn btn-primary btn-sm mt-1 mb-2' href='#' onclick='history.go(-1);'>Go Back</a>
        </div>";
        }

        // Close the database connection
        $db->close();
    }
    ?>

 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
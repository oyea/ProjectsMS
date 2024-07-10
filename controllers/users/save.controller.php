 <!-- Bootstrap CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <link rel="stylesheet" type="" href="views/css/style.css">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">

 <?php require("auth.php"); ?>
 <?php
    date_default_timezone_set("Asia/Riyadh");
    $currdt = date("Y-m-d H:i:s");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $errors = array();
        // Instantiate the validate class
        $validator = new validate();
        // Instantiate the Db class (assuming your autoloader is set up properly)
        $db = new Db('localhost', 'root1', 'root', 'projectsms');

        // Retrieve the form input values and validate them
        $username = $validator->str($_POST["username"]);
        $name = $validator->str($_POST["name"]);
        $password = $validator->str($_POST["password"]);
        $confirmPassword = $validator->str($_POST["confirmPassword"]);
        $role = $validator->str($_POST["role"]);
        $email = $validator->str($_POST["email"]);
        $division = $validator->str($_POST["division"]);
        $emptype = $validator->str($_POST["emptype"]);
        $approved = isset($_POST["approved"]) ? '1' : '0';
        $nationality = $validator->str($_POST["nationality"]);
        $joiningdate = $_POST["joiningdate"];
        $gradyear = $_POST["gradyear"];
        $vacbalance = $_POST["vacbalance"];

        $gradyear = !empty($gradyear) ? $gradyear : null;

        // Validate the form inputs (you can add more validation as needed)
        if (empty($username)) {
            $errors['username'] = "Username is required!";
        }

        if (empty($name) || strlen($name) <= 15) {
            $errors['name'] = "Full Name is empty or short";
        }

        if (empty($password)) {
            $errors['password'] = "Password is required!";
        }

        if (empty($confirmPassword)) {
            $errors['confirmPassword'] = "Confirm Password is required!";
        }

        if ($password !== $confirmPassword) {
            $errors['confirmPassword'] = "Password and Confirm Password do not match!";
        }

        if (empty($role)) {
            $errors['role'] = "role is required!";
        }

        if (empty($email)) {
            $errors['email'] = "Email is required!";
        }
        if (empty($division)) {
            $errors['division'] = "Select a Division";
        }
        if (empty($joiningdate)) {
            $errors['joiningdate'] = "joining Date can not be empty";
        }

        // Check if the username already exists in the database
        $existingUser = $db->read('users', 'user = ?', array($username));
        if (!empty($existingUser)) {
            $errors['username'] = "Username already exists. Please choose a different username.";
        }

        // Handle image upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // Check the size of the uploaded file
            $maxSize = 2097152; // 2 MB in bytes
            if ($_FILES['image']['size'] > $maxSize) {
                $errors['image'] = "Error: The uploaded image size exceeds the maximum allowed size (2MB).";
            } elseif (!in_array($_FILES['image']['type'], array("image/jpeg", "image/png", "image/gif"))) {
                // Check if the uploaded file is an image (JPEG, PNG, or GIF)
                $errors['image'] = "Error: Only JPEG, PNG, and GIF images are allowed.";
            } else {
                // Define the upload directory
                $uploadDir = 'views/imgs/emps_imgs/';

                // Generate a unique filename for the uploaded image
                $uploadedFilename = $username . '_' . $_FILES['image']['name'];

                // Create the full path where the image will be stored
                $targetPath = $uploadDir . $uploadedFilename;

                // Move the uploaded image to the target location
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                    // Image upload successful, store the image path in the database
                    $data['image'] = $targetPath;
                } else {
                    // Image upload failed, handle the error (you can display an error message)
                    $errors['image'] = "Error uploading image.";
                    $data['image'] = null;
                }
            }
        } else {
            // If no image is uploaded, set the 'image' field to null or a default value
            $data['image'] = null;
        }

        // If there are any errors, display them and do not proceed with user creation
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo "div class='centerdiv text-center shadow w-50 mt-5 rounded-pill'>" . $error .
                    "<br><a class='btn btn-primary btn-sm mt-1 mb-2' href='#' onclick='history.go(-1);'>Go Back</a>
        </div>";
            }
            exit;
        }

        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);



        // Prepare the data for insertion into the database
        $data = array(
            'user' => $username,
            'name' => $name,
            'password' => $hashedPassword,
            'image' => $data['image'],
            'email' => $email,
            'role' => $role,
            'division' => $division,
            'emptype' => $emptype,
            'approved' => $approved,
            'nationality' => $nationality,
            'joiningdate' => $joiningdate,
            'gradyear' => $gradyear,
            'vacbalance' => $vacbalance,
            'cdate' => $currdt
        );

        // Insert the data into the database
        $insertedUserId = $db->create('users', $data);

        if ($insertedUserId) {
            echo "<div class='centerdiv text-center shadow w-50 mt-5'>
        <h4> New Users created Successfully</h4> <img src='/views/imgs/icons/verified.gif' width='80' height='80'> 
        </div>";
            header("Refresh: 2.0; URL=users");
            // You can redirect the user to a success page or another page here
        } else {
            // Handle the error, e.g., display error message or redirect back to the form
            echo "Error creating user! " . $db->error;
        }

        // Close the database connection
        $db->close();
    }
    ?>

 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
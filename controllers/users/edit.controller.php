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
        $userID = $validator->str($_POST["id"]);
        $username = $validator->str($_POST["username"]);
        $name = $validator->str($_POST["name"]);
        $password = $validator->str($_POST["password"]);
        $confirmPassword = $validator->str($_POST["confirmPassword"]);
        $role = $validator->str($_POST["role"]);
        $dbimage = $_POST['dbimage'];
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

        if ($password !== $confirmPassword) {
            $errors['confirmPassword'] = "Password and Confirm Password do not match!";
        }

        if (empty($role)) {
            $errors['role'] = "role is required!";
        }

        if (empty($email)) {
            $errors['email'] = "Email is required!";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "This is not a proper Email";
        }
        if (empty($division)) {
            $errors['division'] = "Select a Division";
        }
        if (empty($joiningdate)) {
            $errors['joiningdate'] = "joining Date can not be empty";
        }
        // Check if the username already exists in the database (excluding the current user)
        $existingUser = $db->read('users', 'user = ? AND id <> ?', array($username, $userID));
        if (!empty($existingUser)) {
            echo "Username already exists. Please choose a different username.";
            exit;
        }

        // Retrieve the existing image path from the database
        $existingImagePath = $dbimage;

        // Handle image upload and update
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // Perform image validation (size, type)
            // ... (existing code for image validation)

            if (empty($errors)) {
                // Define the upload directory
                $uploadDir = 'views/imgs/emps_imgs/';

                // Generate a unique filename for the uploaded image
                $uploadedFilename = $username . '_' . $_FILES['image']['name'];

                // Create the full path where the image will be stored
                $targetPath = $uploadDir . $uploadedFilename;

                // Move the uploaded image to the target location
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                    // Image upload successful, store the new image path in the user data array
                    $data['image'] = $targetPath;

                    // If a new image is uploaded, delete the existing image file from the server
                    if (file_exists($existingImagePath)) {
                        // Get the absolute path to the existing image and then delete it
                        $absolutePath = realpath($existingImagePath);
                        if (unlink($absolutePath)) {
                            echo "Old image deleted successfully. <br>";
                        } else {
                            echo "Error deleting the existing image.";
                        }
                    }
                } else {
                    // Image upload failed, handle the error (you can display an error message)
                    $errors['image'] = "Error uploading image.";
                    $data['image'] = null;
                }
            }
        } else {
            // If no new image is uploaded, retain the existing image path in the user data array
            $data['image'] = ($existingImagePath) ? $existingImagePath : null;
        }

        // If there are any errors, display them and do not proceed with user creation
        if (!empty($errors)) {
            echo "<div class='centerdiv text-center shadow w-50 mt-5 rounded-pill h4'>
            <img src='views/imgs/icons/animatedX.gif' width='50' height='50'><br>";
            foreach ($errors as $error) {
                echo "-" . $error . "<br>";
            }
            echo "</div>";
            exit;
        }

        // Retrieve the user data from the database
        $user = $db->read('users', 'id = ?', array($userID));

        // If user not found, redirect back to the user list page or show an error message
        if (empty($user)) {
            echo "User not found!";
            exit;
        }

        $user = $user[0]; // Fetch the first user (assuming user ID is unique)

        // Use the existing hashed password if the new password is empty
        if (empty($password)) {
            $hashedPassword = $user['password'];
        } else {
            // Hash the new password for security
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        }

        // Prepare the data for update in the database
        $data = array(
            'user' => $username,
            'name' => $name,
            'password' => $hashedPassword,
            'role' => $role,
            'image' => $data['image'],
            'email' => $email,
            'division' => $division,
            'emptype' => $emptype,
            'approved' => $approved,
            'nationality' => $nationality,
            'joiningdate' => $joiningdate,
            'gradyear' => $gradyear,
            'vacbalance' => $vacbalance,
            'cdate' => $currdt
        );

        // Update the data in the database
        $updated = $db->update('users', $data, 'id = ?', array($userID));

        if ($updated) {
            echo "<div class='centerdiv text-center shadow w-50 mt-5 rounded-pill'>
        <h4> Users updated Successfully</h4> <img src='/views/imgs/icons/verified.gif' width='80' height='80'> 
        </div>";
            header("Refresh: 2.0; URL=users");
            // You can redirect the user to a success page or another page here
        } else {
            // Handle the error, e.g., display error message or redirect back to the form
            echo "Error updating user!" . $db->error;
        }

        // Close the database connection
        $db->close();
    }

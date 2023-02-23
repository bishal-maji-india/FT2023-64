<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">
     <!-- link to global stylesheet -->
<link href="../styles.css" rel="stylesheet" />
<head>
    <title>Assignment 2</title>
</head>
<?php
require('../user.php');
$user =new User();

$first_name_err = $last_name_err = $img_upload_err = "";
$first_name = $last_name = "";

// user form validation methods
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["first_name"])) {
        $first_name_err = "First Name is required";
    }
    if (is_numeric($_POST["first_name"])) {
        $first_name_err = "Must be an alphaber";
    }
    if (empty($_POST["last_name"])) {
        $last_name_err = "Last Name is required";
    }
    if (is_numeric($_POST["last_name"])) {
        $last_name_err = "Must be an alphaber";
    }
}
if (array_key_exists('submit', $_POST)) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    if ($first_name_err == "" && $last_name_err == "") {
        $user->setFirstName(test_input($_POST['first_name']));
        $user->setLastName(test_input($_POST['last_name']));
        $_SESSION["first_name"] = $user->getFirstName();
        $_SESSION["last_name"] = $user->getLastName();
        $upload_directory = "images/";
        $destination_path = $upload_directory . basename($_FILES['user_image']['name']);
        $ready_to_upload = 1;
        $image_type = strtolower(pathinfo($destination_path, PATHINFO_EXTENSION));
        //check if file already exist
        if (file_exists($destination_path)) {
            // $upload_err= "file already exixt";
            // deleting the file
            unlink($destination_path);
            // $ready_to_upload = 0;
        }
        //uploading only the specific formate
        if (
            $image_type != "jpg" && $image_type != "png" && $image_type != "jpeg"
            && $image_type != "gif"
        ) {
            $img_upload_err = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";

            $ready_to_upload = 0;
        }
        //finally upload the image if everything is good
        if ($ready_to_upload == 1) {


            if (move_uploaded_file($_FILES['user_image']['tmp_name'], $destination_path)) {
                $_SESSION["user_image"] = basename($_FILES['user_image']['name']);
                header("Location: welcome.php");
                exit;
            }
        }
    }
}



?>

<body>
    <div class="container">
        <form name="task_two_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" enctype="multipart/form-data">
            <h4>First Name : <input type="text" class="f_name" name="first_name"><span class="error">* <?php echo $first_name_err; ?></span></h4>
            <h4>Last Name : <input type="text" class="l_name" name="last_name"><span class="error">* <?php echo $last_name_err; ?></span></h4>
            <h4>Full Name : <input type="text" class="fu_name" disabled name="full_name"></h4>
            <input type="file" name="user_image" id="user_image" />*<span class="error"> <?php echo $img_upload_err; ?></span>

            <div><button type="submit" name="submit">Submit Data</button></div>
        </form>
</body>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("input").keyup(function() {
            $(".fu_name").val("");
            $(".fu_name").val($(".f_name").val() + " " + $(".l_name").val());
        });
    });
</script>

</html>
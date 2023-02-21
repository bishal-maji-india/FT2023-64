<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- link to global stylesheet -->
    <link href="../styles.css" rel="stylesheet" />
    <title>User Detail Page</title>
</head>


<?php
$first_name_err = $last_name_err = "";


// validating the user
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


/*method to be runned on
 submit button click*/
if (array_key_exists('submit', $_POST)) {
    if ($first_name_err == "" && $last_name_err == "") {
        $_SESSION["first_name"] = test_input($_POST['first_name']);
        $_SESSION["last_name"] = test_input($_POST['last_name']);
        header("Location: welcome.php");
        exit;
    }
}


/* to avoid sql injection
 we use this method*/
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>



<body>
    <div class="container">
        <form name="task_one_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" enctype="multipart/form-data">
            <h4>First Name : <input type="text" class="f_name" name="first_name"><span class="error">* <?php echo $first_name_err; ?></span></h4>
            <h4>Last Name : <input type="text" class="l_name" name="last_name"><span class="error">* <?php echo $last_name_err; ?></span></h4>
            <h4>Full Name : <input type="text" class="fu_name" disabled name="full_name"></h4>
            <div class="text-align-end"><button type="submit" name="submit">Submit Data</button></div>
        </form>
</body>
</div>


<!-- using this script to fill the full_name feild live -->
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
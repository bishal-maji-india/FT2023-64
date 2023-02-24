<?php session_start();
?>

<!DOCTYPE html>
<html lang="en">
<!-- link to global stylesheet -->
<link href="../styles.css" rel="stylesheet" />

<head>
  <title>Document</title>
</head>

<?php

$first_name_err = $last_name_err = $img_upload_err = $mark_err = $phone_err = $mail_err = "";
$first_name = $last_name = "";


// user form validation
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
  if (empty($_POST["marks"])) {
    $mark_error = "marks field is required";
  }
  if (empty($_POST["phone"])) {
    $phone_error = "Phone Number is required";
  }
  if (!is_numeric($_POST["phone"])) {
    $phone_error = "Must be an number";
  }
  if (strlen($_POST["phone"]) != 10) {
    $phone_error = "Number Must be of 10 digits";
  }

  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $mail_err = "Invalid email format";
  }
}


//this method runs when user submit the form
if (array_key_exists('submit', $_POST)) {
  if ($first_name_err == "" && $last_name_err == "" && $mark_err == "" && $phone_err == "" && $mail_err == "") {
    //store the value in user class
    $user = new User();
    $user->test_inputsetFirstName(test_input($_POST['first_name']));
    $user->setLastName(test_input($_POST['last_name']));
    $user->setMarks(test_input($_POST['marks']));
    $user->setPhone(test_input($_POST['phone']));
    $user->setMail(test_input($_POST['email']));

    $mail_id = $user->getMail();

    //api call for email validation
    $curlObj = curl_init();
    curl_setopt_array($curlObj, array(
      CURLOPT_URL => "https://api.apilayer.com/email_verification/check?email=" . $mail_id,
      CURLOPT_HTTPHEADER => array(
        "Content-Type: text/plain",
        "apikey: kG3IBcX6qqFzwvOXaJnVRPq3luu9TL4O"
      ),
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_FOLLOWLOCATION => true,
    ));

    $response = curl_exec($curlObj);
    curl_close($curlObj);
    $decoded_result = json_decode($response, true);

    // check the email format is valid or not
    if (!$decoded_result["format_valid"]) {
      $mail_err = "email format is not valid";
      return;
    }

    $_SESSION["first_name"] = user->getFirstName();
    $_SESSION["last_name"] = user->getLastName();
    $_SESSION["marks"] = user->getMarks();
    $_SESSION["phone"] = user->getPhone();
    $_SESSION["email"] = user->getMail();

    $upload_directory = "../assignment_2/images/";
    $destination_path = $upload_directory . basename($_FILES['user_image']['name']);
    $ready_to_upload = 1;
    $image_type = strtolower(pathinfo($destination_path, PATHINFO_EXTENSION));


    // check if file already exist
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


//to avoid sql injection we use this method
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<body>
  <div class="container">
    <form name="task_five_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" enctype="multipart/form-data">
      <h4>First Name : <input type="text" class="f_name" name="first_name"><span class="error">* <?php echo $first_name_err; ?></span></h4>
      <h4>Last Name : <input type="text" class="l_name" name="last_name"><span class="error">* <?php echo $last_name_err; ?></span></h4>
      <h4>Full Name : <input type="text" class="fu_name" disabled name="full_name"></h4>
      <input type="file" name="user_image" id="user_image" />*<span class="error"> <?php echo $img_upload_err; ?></span>
      <h4>Subject Marks : <textarea type="text" class="sub-marks" name="marks"></textarea><span class="error">* <?php echo $mark_err; ?></span></h4><br>
      <h4>Phone Number : <input type="number" name="phone"> <br><span class="error">* <?php echo $phone_err; ?></span></h4>
      <h4>User Email : <input type="text" name="email"><br><span class="error">* <?php echo $mail_err; ?></span></h4>
      <div><button type="submit" name="submit">Submit Data</button></div>
    </form>
  </div>
</body>

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
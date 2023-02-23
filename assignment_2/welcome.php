<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- link to global stylesheet -->
    <link href="../styles.css" rel="stylesheet" />
    <title>User Detail Page</title>
</head>

<body>
    <?php
    $first_name_v = $_SESSION["first_name"];
    $last_name_v = $_SESSION["last_name"];
    $user_img_v = $_SESSION["user_image"];

    $destination_path = "http://localhost/assignment_2/images/";
    $file_path = $destination_path . $user_img_v;
    echo "<img src='" . $file_path . "' width='150px' height=auto'>";
    echo "<br>";
    echo '<div class="container">
    <h1>Hello [' . $first_name_v . ' ' . $last_name_v . ']</h1>
    </div>';
    ?>
</body>

</html>
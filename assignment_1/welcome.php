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
    //accessing the stored session variables
    $first_name_v = $_SESSION["first_name"];
    $last_name_v = $_SESSION["last_name"];
    echo '<div class="container">
    <h1>Hello [' . $first_name_v . ' ' . $last_name_v . ']</h1>
    </div>';
    ?>
</body>
</html>
<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="../styles.css" rel="stylesheet" />
    <script src="../assignment_3/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
    <title>Document</title>
</head>

<body>
    <?php
    $first_name_v = $_SESSION["first_name"];
    $last_name_v = $_SESSION["last_name"];
    $full_name_v = $first_name_v . ' ' . $last_name_v;
    $user_img_v = $_SESSION["user_image"];
    $marks_v = $_SESSION["marks"];
    $destination_path = "http://localhost/assignment_2/images/";
    $file_path = $destination_path . $user_img_v;
    echo "<div class='container' id='container'>
    <img src='" . $file_path . "' width='150px' height=auto'>
    <h2>" .
        $full_name_v .
        "</h2>
    <h4>Marks Obtained</h4>
    <table id='table_my'>
     <tr>
     <th>Subjects</th>
     <th>Marks</th>
     </tr>
    </table>
    ";
    echo "<script>fillUserMarks('$marks_v');</script></div>";
    ?>
</body>

</html>
<?php session_start();
//first to check if the user is already loged in or not- if not, send to auth.php page
if (!isset($_SESSION["login"])) {
    header("location: ../assignment_7/auth.php");
}else{
    if (isset($_GET['q'])) {
        // if query is set in the address bar
        $page = $_GET['q'];
        $page_filename = "../basic_php/assignment_{$page}/index.php";
        if (file_exists($page_filename)) {
            session_abort();

            include($page_filename);
          }else{
                print("no file exist {$page_filename}");
          }

      } else {

        $page_filename = "/index.php";
        if (file_exists($page_filename)) {
            session_abort();
            include($page_filename);
          }
      }


}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title></title>

</head>

<?php
//to logout the user this method is runned
if (array_key_exists('button_logout', $_POST)) {
    unset($_SESSION["login"]);
    header("location: ../assignment_7/auth.php");
}
?>

<body>
    <ul>
        <li><a href="/assignment_1/index.php">Assignment 1</a></li>
        <li><a href="/assignment_2/index.php">Assignment 2</a></li>
        <li><a href="/assignment_3/index.php">Assignment 3</a></li>
        <li><a href="/assignment_4/index.php">Assignment 4</a></li>
        <li><a href="/assignment_5/index.php">Assignment 5</a></li>
        <li><a href="/assignment_6/index.php">Assignment 6</a></li>
        <li><a href="/assignment_7/auth.php">Assignment 7</a></li>
    </ul>

 <?php echo "<form method='post' >
        <input type='submit' name='button_logout'
        class='button' value='Logout' /></form>";
    ?>
</body>
</html>
<?php
session_start();
if (isset($_REQUEST['sub'])) {
	$user_name = $_REQUEST['uname'];
	$password_key = $_REQUEST['upassword'];
	$_SESSION["login"] = "1";
	header("location: ../index.php");
}

<?php 
session_start();
require 'php-includes/connect.php';
extract($_POST);
$query = "SELECT * FROM user WHERE email= ? AND password = ?";
$stmt = $db->prepare($query);
$stmt->execute(array($email, $password));
$rows = $stmt->fetchAll();
if ($stmt->rowCount()>0) {
	$_SESSION['userid'] = $email;
	$_SESSION['id'] = session_id();
	$_SESSION['login_type'] = "user";

	echo "<script>alert('You Are Logged In');window.location.assign('home.php')</script>";
}else{
	echo "<script>alert('Your ID and Password is Wrong');window.location.assign('index.php')</script>";
}


 ?>
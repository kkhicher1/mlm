<?php 
session_start();
if (isset($_SESSION['id']) && $_SESSION['login_type']=='admin') {
	
}else{
	echo "<script>alert('Access Denied');window.location.assign('index.php')</script>";
}



 ?>
<?php 
session_start();
session_destroy();
echo "<script>alert('You Are Logged Out');window.location.assign('index.php')</script>";



 ?>
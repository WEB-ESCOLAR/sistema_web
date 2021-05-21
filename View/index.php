<?php 

	session_start();
	require_once("layouts/Navbar.php");
	if(!isset($_SESSION["newsession"])){
		require_once("auth/login.php");
	}else{	
		require_once 'Screens/Home.php';
	}

	require_once("layouts/footer.php");
 ?>


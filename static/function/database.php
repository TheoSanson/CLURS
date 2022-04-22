<?php
	date_default_timezone_set("Asia/Singapore");
	$error_message="";
	$link=mysqli_connect("localhost","root","","clurs");
	if($link===false)
	{
		die("Error: Could not connect." .mysqli_connect_error());
	}
	session_start();
?>
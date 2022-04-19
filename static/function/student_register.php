<?php
    include 'database.php';
    $school_id = $_REQUEST['school_id'];
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $firstname = $_REQUEST['firstname'];
    $lastname = $_REQUEST['lastname'];
    $email = $_REQUEST['email'];
    $contactno = $_REQUEST['contactno'];
    $access_level = '0';
    $sql = "INSERT INTO user(username, password, firstname, lastname, school_id, access_level, contactno, email) VALUES ('$username','$password','$firstname','$lastname','$school_id',$access_level,'$contactno','$email')";
    if(mysqli_query($link,$sql)){
        session_start();
        $_SESSION["user"] = $username;
        $_SESSION["pass"] = $password;
        echo "	<script type='text/javascript'>
            window.location='login.php?';
        </script>";
    }
	else
	{
		echo "Error: Could not be able to execute $sql. " .mysqli_error($link);
	}
?>
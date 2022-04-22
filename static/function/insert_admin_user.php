<?php
    include 'database.php';
    $school_id = $_POST['school_id'];
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $contactno = $_POST['contactno'];
    $access_level = '1';
    $password = '';
    $length = 5;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    $password = $randomString; #DALE Email password to email given

    $sql = "INSERT INTO user(username, password, firstname, lastname, school_id, access_level, contactno, email) VALUES ('$username','$password','$firstname','$lastname','$school_id',$access_level,'$contactno','$email')";
    if(mysqli_query($link,$sql)){
        echo "	<script type='text/javascript'>
            console.log('$password');
            window.location='/clurs/admin-staff.php';
        </script>";
    }
	else
	{
		echo "Error: Could not be able to execute $sql. " .mysqli_error($link);
	}
?>
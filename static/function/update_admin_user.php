<?php
    include 'database.php';
    $user_id = $_POST['user_id'];
    $school_id = $_POST['school_id'];
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $contactno = $_POST['contactno'];

    $sql = "UPDATE user SET school_id='$school_id', username='$username', firstname='$firstname', lastname='$lastname', email='$email', contactno='$contactno' WHERE id=$user_id";
    
    $password = '';
    if(isset($_POST['reset'])){
        $length = 5;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $password = $randomString; #DALE Email password to email given
        $sql = "UPDATE user SET school_id='$school_id', username='$username', firstname='$firstname', lastname='$lastname', email='$email', contactno='$contactno', password='$password' WHERE id=$user_id";
    }

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
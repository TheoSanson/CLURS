<?php
    include 'database.php';
    // When form submitted, check and create user session.
    if (isset($_POST['username'])) {
        $username = $_REQUEST['username'];    // removes backslashes
        $password = $_REQUEST['password'];
        // Check user is exist in the database
        $query    = "SELECT * FROM `user` WHERE username='$username'
                     AND password='$password'";
        $result = mysqli_query($link, $query) or die(mysql_error());
        $count = mysqli_num_rows($result);
        if($count == 0){
            echo "	<script type='text/javascript'>
                        alert('No Record of Given Username');
                        window.location='/clurs/login.php';
                    </script>";
        }	
        else {
			$user = mysqli_fetch_array($result);
			$_SESSION["type"] = $user['access_level'];
			$_SESSION["id"] = $user['id'];
			$_SESSION["schoolid"] = $user['school_id'];
            $_SESSION['user'] = $username;
            $_SESSION['pass'] = $password;
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION['lastname'] = $user['lastname'];
            echo "	<script type='text/javascript'>
                        window.location='/clurs/index.php';
                    </script>";
        }
    } elseif (isset($_SESSION['user'])){
        $username = $_SESSION['user'];
        $password = $_SESSION['pass'];
        // Check user is exist in the database
        $query    = "SELECT * FROM `user` WHERE username='$username'
                     AND password='$password'";
        $result = mysqli_query($link, $query) or die(mysql_error());
        $count = mysqli_num_rows($result);
        if($count == 0){
            echo "	<script type='text/javascript'>
                       alert('No Record of Given Username');
                       window.location='/clurs/login.php';
                   </script>";
        }	
        else {
            session_start();
			$user = mysqli_fetch_array($result);
			$_SESSION["type"] = $user['access_level'];
			$_SESSION["id"] = $user['id'];
			$_SESSION["schoolid"] = $user['school_id'];
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION['lastname'] = $user['lastname'];
            echo "	<script type='text/javascript'>
                       window.location='/clurs/index.php';
                    </script>";
        }
    }
?>
<?php
    $username="";
    $password="";
    if(isset($_SESSION['user'])){
        $username = $_SESSION['user'];
        $password = $_SESSION['pass'];
    }
    $sql=mysqli_query($link,"SELECT * FROM user WHERE username='$username' and password='$password' and access_level > 0");
    $count = mysqli_num_rows($sql);
    if($count == 0){
        echo "	<script type='text/javascript'>
                    alert('You do not have permission to view this page');
                    window.location='student-reservation.php';
                </script>";
    }
?>
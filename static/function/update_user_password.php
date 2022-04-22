<?php
    include "database.php";
    $user_id = $_POST['user_id'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];

    $record = mysqli_query($link,"SELECT * FROM user WHERE password='$current_password' AND id=".$_SESSION['id']);
    $user=mysqli_fetch_array($record);

    if(isset($user)){
        mysqli_query($link,"UPDATE user SET password='$new_password' WHERE id=$user_id");
        echo "<script>
            alert('Password Changed Successfully');
            window.location.href = '/clurs/account.php';
        </script>";
    }
    else{
        echo "<script>
            alert('Current Password Input is Incorrect');
            window.location.href = '/clurs/account.php';
        </script>";
    }
?>
<?php
    include "database.php";
    $user_id = $_POST['user_id'];
    mysqli_query($link,"DELETE FROM user WHERE id=$user_id");
    echo "	<script type='text/javascript'>
       window.location='/clurs/admin-staff.php';
    </script>";
?>
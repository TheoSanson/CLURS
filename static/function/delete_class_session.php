<?php
    include "database.php";
    $lab_id = $_POST['lab_id'];
    $session_id = $_POST['session-id'];
    mysqli_query($link,"DELETE FROM class_session WHERE id=$session_id");
    echo "	<script type='text/javascript'>
       window.location='../../admin-class.php?id=$lab_id';
    </script>";
?>
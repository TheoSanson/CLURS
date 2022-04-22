<?php
    include "database.php";
    $lab_id = $_POST['lab_id'];
    $time_open = $_POST['time_open'];
    $time_close = $_POST['time_close'];
    mysqli_query($link,"UPDATE laboratory SET time_open='$time_open', time_close='$time_close' WHERE id=$lab_id");
    echo "<script>
        window.location.href = '/CLURS/admin-class.php?id='+$lab_id;
    </script>";
?>
<?php
    include "database.php";
    $session_id = $_POST['session-id'];
    $computer_id = $_POST['computer-id'];
    $date =  $_POST['edit-date'];
    $time_start =  $_POST['time_start'];
    $duration = $_POST['duration'];
    $time_end = date('H:i:s',strtotime($time_start." +$duration mins"));
    mysqli_query($link,"UPDATE session SET date = '$date', time_start='$time_start', time_end='$time_end', duration=$duration WHERE id=$session_id");
    echo "<script>
        window.location.href = '../../admin-computer-view.php?id='+$computer_id;
    </script>";
?>
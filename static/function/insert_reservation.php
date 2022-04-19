<?php
    include 'database.php';
    $user =  $_REQUEST['user_id'];
    $specific_boole = $_REQUEST['specific'];
    $laboratory =  $_REQUEST['laboratory'];
    $computer =  $_REQUEST['computer'];
    $date =  $_REQUEST['date'];
    $time_start =  $_REQUEST['time_start'];
    $duration = $_REQUEST['duration'];
    $time_end = date('H:i:s',strtotime($time_start." +$duration mins"));
    $sql = "INSERT INTO `session`(`time_start`, `time_end`, `duration`, `date`, `user`, `computer`, `date_set`) VALUES ('$time_start','$time_end','$duration','$date',$user,$computer,NOW())";
    if(mysqli_query($link,$sql)){
        echo "	<script type='text/javascript'>
            window.location='/clurs/student-reservation.php';
        </script>";
    }
	else
	{
		echo "Error: Could not be able to execute $sql. " .mysqli_error($link);
	}
?>
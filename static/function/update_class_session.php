<?php 
    include 'database.php';
    $lab_id = $_POST['lab_id'];
    $session_id =  $_POST['session_id'];
    $time_start = $_POST['time_start'];
    $time_end = $_POST['time_end'];
    $time1 = new DateTime($time_start);
    $time2 = new DateTime($time_end);
    $interval = $time1->diff($time2);
    $seconds = date_create('@0')->add($interval)->getTimestamp();
    $minutes = $seconds/60;
    $sql = "UPDATE class_session SET time_start='$time_start', time_end='$time_end',duration=$minutes WHERE id=$session_id";
    if(mysqli_query($link,$sql)){

        $r_sessions = mysqli_query($link,"SELECT * FROM class_session WHERE repeat_id=$session_id");
        if ($r_sessions->num_rows > 0) {
            while($r_session=mysqli_fetch_array($r_sessions)):
                $r_sql = "UPDATE class_session SET time_start='$time_start', time_end='$time_end',duration=$minutes WHERE id=".$r_session['id'];
                mysqli_query($link,$r_sql);
            endwhile;
        }

        echo "	<script type='text/javascript'>
           window.location='/clurs/admin-class.php?id=$lab_id';
        </script>";
    }
	else
	{
		echo "Error: Could not be able to execute $sql. " .mysqli_error($link);
	}
?>
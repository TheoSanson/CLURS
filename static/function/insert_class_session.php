<?php 
    include 'database.php';
    $lab =  $_REQUEST['lab_id'];
    $desc = $_REQUEST['session_desc'];
    $date = $_REQUEST['date'];
    $time_start = $_REQUEST['time_start'];
    $time_end = $_REQUEST['time_end'];
    $time1 = new DateTime($time_start);
    $time2 = new DateTime($time_end);
    $interval = $time1->diff($time2);
    $seconds = date_create('@0')->add($interval)->getTimestamp();
    $minutes = $seconds/60;
    if(isset($_REQUEST['repeat'])){
        $frequency = $_REQUEST['occurrence'];
        $repeat_end = $_REQUEST['repeat-end'];
    }
    $sql = "INSERT INTO class_session(description,lab,date,time_start,time_end,duration,date_set,repeat_id) VALUES('$desc',$lab,'$date','$time_start','$time_end',$minutes,NOW(),NULL)";
    if(mysqli_query($link,$sql)){
        if(isset($_REQUEST['repeat'])){
            $class_session_id = $link->insert_id;
            $newDate = strtotime($date);
            $endDate = strtotime($repeat_end);
            $repeat_desc = $desc.' REPEATING';
            if($frequency=='weekly'){
                while (strtotime("+7 days", $newDate) <= $endDate){
                    $newDate = strtotime("+7 days", $newDate);
                    $newDateStr = date('Y-m-d', $newDate);
                    $repeat_sql = "INSERT INTO class_session(description,lab,date,time_start,time_end,duration,date_set,repeat_id) VALUES('$repeat_desc',$lab,'$newDateStr','$time_start','$time_end',$minutes,NOW(),$class_session_id)";
                    mysqli_query($link,$repeat_sql);
                }
            }
            else{
                while (strtotime("+1 days", $newDate) <= $endDate){
                    $newDate = strtotime("+1 days", $newDate);
                    $newDateStr = date('Y-m-d', $newDate);
                    $day = date('l',$newDate);
                    if($day != "Saturday" && $day != "Sunday"){
                        $repeat_sql = "INSERT INTO class_session(description,lab,date,time_start,time_end,duration,date_set,repeat_id) VALUES('$repeat_desc',$lab,'$newDateStr','$time_start','$time_end',$minutes,NOW(),$class_session_id)";
                        mysqli_query($link,$repeat_sql);
                    }
                }
            }
        }
        #echo "	<script type='text/javascript'>
        #   window.location='/clurs/admin-class.php?id=$lab';
        #</script>";
    }
	else
	{
		echo "Error: Could not be able to execute $sql. " .mysqli_error($link);
	}
?>
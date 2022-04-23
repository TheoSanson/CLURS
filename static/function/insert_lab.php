<?php
    include 'database.php';
    $labname = $_REQUEST['labname'];
    $computers = $_REQUEST['pc-qty'];
    $time_opened = $_REQUEST['time_open'];
    $time_closed = $_REQUEST['time_close'];
    $sql = "INSERT INTO laboratory(name,total_seats,status,time_open,time_close) VALUES('$labname',$computers,'Available','$time_opened','$time_closed')";
    if(mysqli_query($link,$sql)){
        $lab_id = $link->insert_id;
        for($i = 0; $i < $computers; $i++){
            mysqli_query($link,"INSERT INTO computer(vacancy,status,remarks,lab) VALUES('Vacant','Available','',$lab_id)");
        }
        
        echo "	<script type='text/javascript'>
            window.location='/clurs/admin-lab.php';
        </script>";
    }
	else
	{
		echo "Error: Could not be able to execute $sql. " .mysqli_error($link);
	}
?>
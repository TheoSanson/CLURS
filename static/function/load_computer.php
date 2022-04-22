<?php

    include "database.php";
    $lab_id = $_POST['lab_id'];
    $computer_id = $_POST['computer_id'];

    $record = mysqli_query($link,"SELECT * FROM computer WHERE id=$computer_id");
    $computer=mysqli_fetch_array($record);
    if(isset($computer)){

        $sessions = mysqli_query($link,"SELECT * FROM session WHERE date = CURDATE() AND computer=$computer_id");
        $sessions_no = mysqli_num_rows($sessions);

        $class_sessions = mysqli_query($link,"SELECT * FROM class_session WHERE date = CURDATE() AND lab=$lab_id");
        $class_sessions_no = mysqli_num_rows($class_sessions);

        $remaining_sessions = mysqli_query($link,"SELECT * FROM session WHERE date = CURDATE() AND computer=$computer_id AND time_start > NOW()");
        $remaining_sessions_no = mysqli_num_rows($remaining_sessions);

        echo "<div class='row' style='padding-left:20px; padding-top: 15px;'>
            <h3>PC-".$computer['id']."</h3>
        </div>
        <div class='row'>
            <div class='col-md-10 offset-md-1 p-0' style='font-size:23px;'>Status</div>
            <div class='col-md-10 offset-md-1 p-0' style='font-size:20px; font-weight:bold;'>
                ".$computer['status']."
            </div>
        </div>
        <div class='row'>
            <div class='col-md-10 offset-md-1 p-0' style='font-size:23px;'>Reservations Today</div>
            <div class='col-md-10 offset-md-1 p-0' style='font-size:20px; font-weight:bold;'>
                $sessions_no
            </div>
        </div>
        <div class='row'>
            <div class='col-md-10 offset-md-1 p-0' style='font-size:23px;'>Class Sessions Today</div>
            <div class='col-md-10 offset-md-1 p-0' style='font-size:20px; font-weight:bold;'>
                $class_sessions_no
            </div>
        </div>
        <div class='row'>
            <div class='col-md-10 offset-md-1 p-0' style='font-size:23px;'>Remaining Reservations Today</div>
            <div class='col-md-10 offset-md-1 p-0' style='font-size:20px; font-weight:bold;'>
                $remaining_sessions_no
            </div>
        </div>
        <div class='row'>
            <div class='col-md-10 offset-md-1 p-0' style='display:flex; margin-top:20px;'><button type='button' class='btn btn-secondary close-modal-2' style='flex:0.8;'>Return</button><button type='button' class='btn btn-primary manage-pc-btn' style='margin-left:20px;flex:1;' id='".$computer['id']."'>Manage</button></div>
        </div>";
    }

?>
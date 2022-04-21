<?php 
    include 'database.php';
    $lab_id = $_POST['lab'];
    $computer_id = $_POST['computer_id'];
    $computer_status = $_POST['status'];
    $date = $_POST['date'];
    $time = date('H:i:s');
    $time_open = $_POST['time_open'];
    $time_close = $_POST['time_close'];

    
    $sessionsExists_boole = false;
    $classSessionExists_boole = false;
    
    $sessions = mysqli_query($link,"SELECT * FROM session WHERE computer=$computer_id AND date = CURDATE() AND time_start <= NOW() AND time_end > NOW()");
    while($session=mysqli_fetch_array($sessions)):
        $sessionsExists_boole = true;
        break;
    endwhile;
        
    $class_sessions = mysqli_query($link,"SELECT * FROM class_session WHERE lab=$lab_id AND date = CURDATE() AND time_start <= NOW() AND time_end > NOW()");
    while($class_session=mysqli_fetch_array($class_sessions)):
        $classSessionExists_boole = true;
        break;
    endwhile;

    $sessions = mysqli_query($link,"SELECT * FROM session WHERE date = '$date' AND computer=$computer_id");
    $sessions_no = mysqli_num_rows($sessions);

    $class_sessions = mysqli_query($link,"SELECT * FROM class_session WHERE date = '$date' AND lab=$lab_id");
    $class_sessions_no = mysqli_num_rows($class_sessions);

    $remaining_sessions = mysqli_query($link,"SELECT * FROM session WHERE date = '$date' AND computer = $computer_id AND time_start > NOW() OR date = '$date' AND computer = $computer_id AND '$date' > CURDATE()");
    $remaining_sessions_no = mysqli_num_rows($remaining_sessions);

    $status = '';
    $color = 'black';

    if($computer_status == 'Unavailable'){
        $color = 'red';
        $status = 'Unavailable';
    }
    else if ($time < $time_open || $time > $time_close){
        $status = 'Lab Closed';
    }
    else if ($classSessionExists_boole){
        $color = 'blue';
        $status = 'In Class Session';
    }
    else if($sessionsExists_boole = false){
        $color = 'orange';
        $status = 'Reserved';
    }
    else{
        $color = 'green';
        $status = 'Vacant';
    }

    echo "<div class='col-md-6'>
            <h5 style='color:$color'>Status: $status</h5>
        </div>
        <div class='col-md-6'>
            <h5>Reservations of Date: $sessions_no</h5>
        </div>
        <div class='col-md-6'>
            <h5>Class Sessions of Date: $class_sessions_no</h5>
        </div>
        <div class='col-md-6'>
            <h5>Remaining Reservations of Date: $remaining_sessions_no</h5>
        </div>";
<?php
    
    include "database.php";
    $lab_id = $_POST['lab_id'];
    $time_open = $_POST['time_open'];
    $time_close = $_POST['time_close'];
    $time = date('H:i:s');
    
    $computers = mysqli_query($link,"SELECT * FROM computer WHERE lab=$lab_id");
    $computerLength = $computers->num_rows;

    if ($computerLength > 0) {

        $sessionsExists_id = [];
        $classSessionExists_boole = false;
        $sessions = mysqli_query($link,"SELECT * FROM session WHERE date = CURDATE() AND time_start <= NOW() AND time_end > NOW()");
        while($session=mysqli_fetch_array($sessions)):
            $sessionsExists_id[] = $session['computer'];
        endwhile;
        
        $class_sessions = mysqli_query($link,"SELECT * FROM class_session WHERE lab=$lab_id AND date = CURDATE() AND time_start <= NOW() AND time_end > NOW()");
        while($class_session=mysqli_fetch_array($class_sessions)):
            $classSessionExists_boole = true;
            break;
        endwhile;

        $status = '';

        while($computer=mysqli_fetch_array($computers)):
            echo "
            <div class='card computer-card'>
                <div class='card-body pc-card-body'>
                    <h6 class='card-title' style='margin:auto; margin:0px 0px 2px 0px;'>PC-".$computer['id']."</h6>
                    <img src='static/assets/img/";
                    #Insert Code to Use Image
                    if($computer['status'] == 'Unavailable'){
                        $status = 'Unavailable';
                        echo "pc-unavailable.png";
                    }
                    else if ($time < $time_open || $time > $time_close){
                        $status = 'Lab Closed';
                        echo "pc-off.png";
                    }
                    else if ($classSessionExists_boole){
                        $status = 'In Class Session';
                        echo "pc-used.png";
                    }
                    else if(in_array($computer['id'], $sessionsExists_id)){
                        $status = 'Reserved';
                        echo "pc-reserved.png";
                    }
                    else{
                        $status = 'Vacant';
                        echo "pc-vacant.png";
                    }
                    echo "' class='pc-icon'>
                    <button class='btn btn-generic computer-btn open-modal-2' id='".$computer['id']."' name='$status'>View</button>
                </div>
            </div>";
        endwhile;
    }
?>
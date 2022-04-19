<?php
    include "database.php";
    $computer_id = $_POST['computer_id'];
    $lab = $_POST['lab'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $time_start = $_POST['time_start'];
    $time_end = $_POST['time_end'];

    $latest_session_time = 180;

    $sessions = mysqli_query($link,"SELECT * FROM session WHERE computer=$computer_id AND date='$date' AND time_start>'$time'");
    while($session=mysqli_fetch_array($sessions)):
        $latest_session_time = $session['time_start'];
        break;
    endwhile;

    $class_sessions = mysqli_query($link,"SELECT * FROM class_session WHERE lab=$lab AND date='$date' AND time_start>'$time'");
    while($class_session=mysqli_fetch_array($class_sessions)):
        if($latest_session_time > $class_session['time_start']){
            $latest_session_time = $class_session['time_start'];
            break;
        }
    endwhile;

    $start = strtotime($time);
    $end = strtotime($latest_session_time);
    $minutes = ($end - $start) / 60 / 30;

    if($minutes > 6){
        $minutes = 6;
    }

    $array_name = [
        '30 Mins',
        '1 Hour',
        '1 Hr 30 Mins',
        '2 Hours',
        '2 Hrs 30 Mins',
        '3 Hours'
    ];

    $array_value = [
        '30',
        '60',
        '90',
        '120',
        '150',
        '180'
    ];

    echo "<option value=''>-----</option>";
    for ($i = 0; $i < $minutes; $i++){
        echo "<option value='".$array_value[$i]."'>";
        echo $array_name[$i];
        echo '</option>';
    }
?>
<?php
    include "database.php";
    $computer_id = $_POST['computer_id'];
    $lab = $_POST['lab'];
    $date = $_POST['date'];
    $time_start = $_POST['time_start'];
    $time_end = $_POST['time_end'];
    $timeIntervalArray = [];
    $timeBoole = date('h:i a',strtotime($time_start));
    
    while(date('H:i:s',strtotime($timeBoole)) <= $time_end){
        $timeIntervalArray[] = $timeBoole;
        $timeBoole = date('h:i a',strtotime($timeBoole. " +30 mins"));
    }

    $session_td = [];
    $session_duration = [];
    $session_td = array_fill(0, count($timeIntervalArray), '');
    $session_duration = array_fill(0, count($timeIntervalArray), 0);

    $sessions = mysqli_query($link,"SELECT * FROM session WHERE computer=$computer_id AND date='$date'");
    while($session=mysqli_fetch_array($sessions)):
        $key = array_search(date('h:i a',strtotime($session['time_start'])), $timeIntervalArray);
        $duration = $session['duration']/30;
        $session_td[$key] = "<td colspan='4' rowspan='$duration' class='stage-saturn'>Session Reserved</td>";
        $session_duration[$key] = $duration;
    endwhile;

    $class_sessions = mysqli_query($link,"SELECT * FROM class_session WHERE lab=$lab AND date='$date'");
    while($class_session=mysqli_fetch_array($class_sessions)):
        $key = array_search(date('h:i a',strtotime($class_session['time_start'])), $timeIntervalArray);
        $duration = $class_session['duration']/30;
        $session_td[$key] = "<td colspan='4' rowspan='$duration' class='stage-mars'>".$class_session['description']."</td>";
        $session_duration[$key] = $duration;
    endwhile;

    $timeIntervalArrayCount = count($timeIntervalArray);
    $temp_duration = 0;
    for ($i = 0; $i < $timeIntervalArrayCount; $i++){
        $time = $timeIntervalArray[$i];
        if($session_duration[$i] > 0){
            $temp_duration = $session_duration[$i];
        }
        $time_24 = date('H:i:s',strtotime($time));
        echo "
        <tr name='session-tr' id='$time_24' class='";
        if($temp_duration > 0){
            echo 'occupied';
            $temp_duration--;
        }
        echo "'>
            <th>$time</th>";
            echo $session_td[$i];
            echo "</tr>";
    }
?>
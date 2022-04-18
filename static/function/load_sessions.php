<?php
    include "database.php";
    $computer_id = $_POST['computer_id'];
    $lab = $_POST['lab'];
    $date = $_POST['date'];
    $time_start = $_POST['time_start'];
    $time_end = $_POST['time_end'];
    $timeIntervalArray = [];
    $timeBoole = date('H:i',strtotime($time_start));
    
    while(date('H:i:s',strtotime($timeBoole)) <= $time_end){
        $timeIntervalArray[] = $timeBoole;
        $timeBoole = date('H:i',strtotime($timeBoole. " +30 mins"));
    }

    $session_td = [];
    $session_td = array_fill(0, count($timeIntervalArray), '');

    $sessions = mysqli_query($link,"SELECT * FROM session WHERE computer=$computer_id AND date='$date'");
    while($session=mysqli_fetch_array($sessions)):
        $key = array_search(date('H:i',strtotime($session['time_start'])), $timeIntervalArray);
        $session_td[$key] = "<td colspan='4' rowspan='".($session['duration']/30)."' class='stage-saturn'>Session Reserved</td>";
    endwhile;

    $class_sessions = mysqli_query($link,"SELECT * FROM class_session WHERE lab=$lab AND date='$date'");
    while($class_session=mysqli_fetch_array($class_sessions)):
        $key = array_search(date('H:i',strtotime($class_session['time_start'])), $timeIntervalArray);
        $session_td[$key] = "<td colspan='4' rowspan='".($class_session['duration']/30)."' class='stage-mars'>".$class_session['description']."</td>";
    endwhile;

    $timeIntervalArrayCount = count($timeIntervalArray);
    for ($i = 0; $i < $timeIntervalArrayCount; $i++){
        $time = $timeIntervalArray[$i];
        echo "
        <tr>
            <th>$time</th>";
            echo $session_td[$i];
            echo "</tr>";
    }
?>
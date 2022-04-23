<?php
    include "database.php";
    $lab_id = $_POST['lab_id'];
    $time_open = $_POST['time_open'];
    $time_close = $_POST['time_close'];
    mysqli_query($link,"UPDATE laboratory SET time_open='$time_open', time_close='$time_close' WHERE id=$lab_id");

    #CODE FOR DELETE SESSION
    $sessions_to_delete = mysqli_query($link,"SELECT session.id, session.user FROM session INNER JOIN computer ON session.computer = computer.id WHERE computer.lab=$lab_id AND date>=CURDATE() AND (time_start<'$time_open' OR time_end>'$time_close')");
    while($session_to_delete = mysqli_fetch_array($sessions_to_delete)):
        $user_id = $session_to_delete['user'];
        $record = mysqli_query($link,"SELECT * FROM user WHERE id=$user_id");
        $user=mysqli_fetch_array($record);
        if(isset($user)){
            echo $user['email']; #DALE Email User that their Session Was Overlapped by a Class Schedule!
            #PASTE EMAIL CODE HERE
        }
        mysqli_query($link,"DELETE FROM session WHERE id=".$session_to_delete['id']);
    endwhile;

    echo "<script>
        window.location.href = '/CLURS/admin-class.php?id='+$lab_id;
    </script>";
?>
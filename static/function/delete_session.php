<?php
    include "database.php";
    $session_id = $_POST['session-id'];
    $computer_id = $_POST['computer-id'];
    #mysqli_query($link,"DELETE FROM session WHERE id=$session_id");

    $sessions = mysqli_query($link,"SELECT * FROM session WHERE id=$session_id");
    $session=mysqli_fetch_array($sessions);
    if(isset($session)){
        $user_id = $session['user'];
        $session_date = $session['date'];
        $session_start = $session['time_start'];
        $session_duration = $session['duration']/60;
        $session_computer = 'PC-'.$computer_id;
        $users = mysqli_query($link,"SELECT email FROM user WHERE id=$user_id");
        $user=mysqli_fetch_array($users);
        if(isset($user)){
            $email = $user['email']; #DALE Notify Users that their session was deleted. Use Session Details starting with $session_... to clarify which session was deleted
        }
    }

    echo "<script>
        window.location.href = '/clurs/admin-computer-view.php?id='+$computer_id;
    </script>";
?>
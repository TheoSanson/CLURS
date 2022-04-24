<?php 
    include 'database.php';
    $lab_id = $_POST['lab_id'];
    $session_id =  $_POST['session_id'];
    $time_start = $_POST['time_start'];
    $time_end = $_POST['time_end'];
    $time1 = new DateTime($time_start);
    $time2 = new DateTime($time_end);
    $interval = $time1->diff($time2);
    $seconds = date_create('@0')->add($interval)->getTimestamp();
    $minutes = $seconds/60;
    $sql = "UPDATE class_session SET time_start='$time_start', time_end='$time_end',duration=$minutes WHERE id=$session_id";
    if(mysqli_query($link,$sql)){

        $r_sessions = mysqli_query($link,"SELECT session.id, session.user FROM class_session WHERE repeat_id=$session_id");
        if ($r_sessions->num_rows > 0) {
            while($r_session=mysqli_fetch_array($r_sessions)):
                $r_sql = "UPDATE class_session SET time_start='$time_start', time_end='$time_end',duration=$minutes WHERE id=".$r_session['id'];
                mysqli_query($link,$r_sql);

                #CODE FOR DELETE SESSION
                $sessions_to_delete = mysqli_query($link,"SELECT session.id, session.user FROM session INNER JOIN computer ON session.computer = computer.id WHERE computer.lab=$lab_id AND date='".$r_session['date']."' AND (time_start<='$time_start' AND time_end>'$time_start' OR time_start<'$time_end' AND time_end>='$time_end')");
                while($session_to_delete = mysqli_fetch_array($sessions_to_delete)):
                    $user_id = $session_to_delete['user'];
                    $record = mysqli_query($link,"SELECT * FROM user WHERE id=$user_id");
                    $user=mysqli_fetch_array($record);
                    if(isset($user)){
                        $user['email'];
                        
                        
                        #DALE Email User that their Session Was Overlapped by a Class Schedule!
                        #PASTE EMAIL CODE HERE
                    }
                    mysqli_query($link,"DELETE FROM session WHERE id=".$session_to_delete['id']);
                endwhile;

            endwhile;
        }
        else{
            $record = mysqli_query($link,"SELECT * FROM class_session WHERE id=$session_id");
            $class_session=mysqli_fetch_array($record);
            if(isset($class_session)){
                #CODE FOR DELETE SESSION
                $sessions_to_delete = mysqli_query($link,"SELECT session.id, session.user FROM session INNER JOIN computer ON session.computer = computer.id WHERE computer.lab=$lab_id AND date='".$class_session['date']."' AND (time_start<='$time_start' AND time_end>'$time_start' OR time_start<'$time_end' AND time_end>='$time_end')");
                while($session_to_delete = mysqli_fetch_array($sessions_to_delete)):
                    $user_id = $session_to_delete['user'];
                    $record = mysqli_query($link,"SELECT * FROM user WHERE id=$user_id");
                    $user=mysqli_fetch_array($record);
                    if(isset($user)){
                        $user['email']; #DALE Email User that their Session Was Overlapped by a Class Schedule!
                        #PASTE EMAIL CODE HERE
                    }
                    mysqli_query($link,"DELETE FROM session WHERE id=".$session_to_delete['id']);
                endwhile;
            }
        }

        echo "	<script type='text/javascript'>
           window.location='/clurs/admin-class.php?id=$lab_id';
        </script>";
    }
	else
	{
		echo "Error: Could not be able to execute $sql. " .mysqli_error($link);
	}
?>
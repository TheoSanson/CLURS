<?php
    require "PHPMailer/PHPMailerAutoload.php";
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
            $email = $user['email'];
            
            
            #DALE Notify Users that their session was deleted. Use Session Details starting with $session_... to clarify which session was deleted
             // PHP MAILER START
             $phpmailer = new PHPMailer();

             try {
                 //Server settings
 
                 $phpmailer->isSMTP();
                 $phpmailer->Host = 'smtp.gmail.com';
                 $phpmailer->SMTPAuth = true;
                 $phpmailer->Port = 587;
                 $phpmailer->Username = 'notificationemailtest30@gmail.com';
                 $phpmailer->Password = 'temporaryemail1999';
 
 
                 $phpmailer->setFrom('testemailrandomidk@gmail.com', 'ICS COMLAB');
                 $phpmailer->addAddress($email);
 
 
                 //Content
                 $phpmailer->isHTML(true);                                  //Set email format to HTML
                 $phpmailer->Subject = 'Notification |ICS COMLAB'; 
                 $phpmailer->Body    = "
                     <center>
                     <img src='' alt='header' border='0'>
                         <h1>Your Session was Deleted</h2>
                     </center>
                     <br>
                     <hr>
                     <table>
                         <tr>
                             <th>Date</th>
                             <th>Computer</th>
                             <th>Start</th>
                             <th>Duration</th>
                         </tr>
                         <tr>
                             <td>$session_date</td>
                             <td>$session_computer</td>
                             <td>$session_start</td>
                             <td>$session_duration</td>
                         </tr>
 
                     </table>
 
                     </p>
                 <hr>
       
                 
             ";
 
                 $phpmailer->send();
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
                }
      
 
             // END EMAIL
        }
    }

    echo "<script>
        window.location.href = '../../admin-computer-view.php?id='+$computer_id;
    </script>";
?>
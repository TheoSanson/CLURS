<?php
    include "database.php";
    require "PHPMailer/PHPMailerAutoload.php";
    $computer_id = $_POST['computer_id'];
    $computer_status = $_POST['status'];
    
    $userlist = ' ';
    $subject = '';
    $message = '';

    $users = mysqli_query($link,"SELECT user FROM session WHERE computer=$computer_id AND date >= CURDATE()");
    while($user=mysqli_fetch_array($users)):
        $userlist = $userlist.$user['user']." OR ";
    endwhile;



    if($computer_status == 'Available'){
        mysqli_query($link,"UPDATE computer SET status='Unavailable' WHERE id=$computer_id");
        mysqli_query($link,"UPDATE session SET remarks='Computer Unavailable' WHERE computer=$computer_id AND date >= CURDATE()");
        $subject = '[ICS COMLABS] Computer with your Reservation is Unavailable';
        $message = "If you are seeing this message, a computer (PC-$computer_id) you have reserved a session in has just been marked as unavailable.<br>Contact our support at ics-comlabs@wmsu.edu.ph if you want to reschedule or cancel your reservation.";
    }

    else {
        mysqli_query($link,"UPDATE computer SET status='Available' WHERE id=$computer_id");
        mysqli_query($link,"UPDATE session SET remarks='' WHERE computer=$computer_id AND date >= CURDATE()");
        $subject = '[ICS COMLABS] Computer with your Reservation is Now Available';
        $message = 'A computer with your reservation has been marked as available for use.<br>No Further Action is required.<br>Feel free to contact our support at ics-comlabs@wmsu.edu.ph for any questions.';
    }


    
    $user_sql = "SELECT email FROM user WHERE id =".$userlist." 0 AND 1";
    $emails = mysqli_query($link,$user_sql);
    while($user=mysqli_fetch_array($emails)):
        $email = $user['email'];
        
        #DALE email $subject and $message to email returned in each iteration of this list.
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
                $phpmailer->Subject = $subject; 
                $phpmailer->Body    =$message;

                $phpmailer->send();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
            }
  
    endwhile;
?>
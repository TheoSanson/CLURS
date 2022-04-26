<?php
    require "PHPMailer/PHPMailerAutoload.php";
    include 'database.php';
    $email = $_REQUEST['email'];
    $user =  $_REQUEST['user_id'];
    $specific_boole = $_REQUEST['specific'];
    $laboratory =  $_REQUEST['laboratory'];
    $computer =  $_REQUEST['computer'];
    $date =  $_REQUEST['date'];
    $time_start =  $_REQUEST['time_start'];
    $duration = $_REQUEST['duration'];
    $time_end = date('H:i:s',strtotime($time_start." +$duration mins"));
    $sql = "INSERT INTO `session`(`time_start`, `time_end`, `duration`, `date`, `user`, `computer`, `date_set`) VALUES ('$time_start','$time_end','$duration','$date',$user,$computer,NOW())";
    if(mysqli_query($link,$sql)){

#PASTE EMAIL CODE HERE
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
                $phpmailer->Subject = 'Reservation Successful |ICS COMLAB'; 
                $phpmailer->Body    = "
                    <center>
                    <img src='' alt='header' border='0'>
                        <h1>Computer Lab Reservation </h2>
                    </center>
                    <br>
                    <hr>
                    <table>
                        <tr>
                            <th>Laboratory</th>
                            <th>Computer</th>
                            <th>Date</th>
                            <th>Time Start</th>
                            <th>Duration</th>
                            <th>Time End</th>
                        </tr>
                        <tr>
                            <td>$laboratory</td>
                            <td>$computer</td>
                            <td>$date</td>
                            <td>$time_start</td>
                            <td>$duration</td>
                            <td>$time_end</td>
                        </tr>

                    </table>

                    </p>
                <hr>
     
            ";

                 $phpmailer->send();
                  echo "	<script type='text/javascript'>
            window.location='../../student-reservation.php';
        </script>";
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
            }
  



      



    }
	else
	{
		echo "Error: Could not be able to execute $sql. " .mysqli_error($link);
	}
?>
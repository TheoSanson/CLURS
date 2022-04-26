<?php
    include 'database.php';
    require "PHPMailer/PHPMailerAutoload.php";
    $school_id = $_REQUEST['school_id'];
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $firstname = $_REQUEST['firstname'];
    $lastname = $_REQUEST['lastname'];
    $email = $_REQUEST['email'];
    $contactno = $_REQUEST['contactno'];
    $access_level = '0';
    $sql = "INSERT INTO user(username, password, firstname, lastname, school_id, access_level, contactno, email) VALUES ('$username','$password','$firstname','$lastname','$school_id',$access_level,'$contactno','$email')";
    if(mysqli_query($link,$sql)){
        session_start();
        $_SESSION["user"] = $username;
        $_SESSION["pass"] = $password;


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
            $phpmailer->Subject = 'Registration Successful |ICS COMLAB'; 
            $phpmailer->Body    = "
                <center>
                <img src='' alt='header' border='0'>
                    <h1>Hello $firstname !, Your Account has been Created Successfully </h2>
                </center>
                <br>
                <hr>
                <p> Your account credentials </p>
                <table>
                    <tr>
                        <th>Username</th>
                        <th>Password</th>
                    </tr>
                    <tr>
                        <td>$username</td>
                        <td>$password</td>
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
        echo "	<script type='text/javascript'>
            window.location='../../index.php?';
        </script>";

    }
	else
	{
		echo "Error: Could not be able to execute $sql. " .mysqli_error($link);
	}
?>
<?php
    require "PHPMailer/PHPMailerAutoload.php";
    include 'database.php';
    $user_id = $_POST['user_id'];
    $school_id = $_POST['school_id'];
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $contactno = $_POST['contactno'];
    $access = $_POST['access_level'];

    $sql = "UPDATE user SET school_id='$school_id', username='$username', firstname='$firstname', lastname='$lastname', email='$email', contactno='$contactno' WHERE id=$user_id";
    
    $password = '';
    if(isset($_POST['reset'])){
        $length = 5;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $password = $randomString;      
        #DALE Email password to email given: $email
        
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
                    <h1>Your Account has been Created Successfully </h2>
                </center>
                <br>
                <hr>
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


        $sql = "UPDATE user SET school_id='$school_id', username='$username', firstname='$firstname', lastname='$lastname', email='$email', contactno='$contactno', password='$password' WHERE id=$user_id";
    }

    if(mysqli_query($link,$sql)){
        if(isset($_POST['edit-account'])){
            echo "	<script type='text/javascript'>
                window.location='/clurs/account.php';
            </script>";
        }
        if($access > 0){
            echo "	<script type='text/javascript'>
                console.log('$password');
                window.location='/clurs/admin-staff.php';
            </script>";
        }
        else{
            echo "	<script type='text/javascript'>
                window.location='/clurs/admin-student.php';
            </script>";
        }
    }
	else
	{
		echo "Error: Could not be able to execute $sql. " .mysqli_error($link);
	}
?>
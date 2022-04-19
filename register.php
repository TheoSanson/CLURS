<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "static/include/head.php"; ?>
    <link rel="stylesheet" href="static/assets/css/login.css">
    <title>Document</title>
</head>
<body id='login-body'>
    <div class="login-box">
        <div id='header' style='margin-bottom:20px; font-size:20px;'>
            <h3>ICS ComLabs</h3>
            Register
        </div>
        <form method='POST' onsubmit="return validateForm()"  action='static/function/student_register.php'>
            <div class="user-box">
                <input type="text" name="school_id" required>
                <label>School ID*</label>
            </div>
            <div class="user-box">
                <input type="text" name="username" required>
                <label>Username*</label>
            </div>
            <div class="user-box">
                <input type="password" id="password" name="password" required>
                <label>Password*</label>
            </div>
            <div class="user-box">
                <input type="password" id="confirm_password" name="confirm_password" required>
                <label>Confirm Password*</label>
            </div>
            <div class="user-box">
                <input type="text" name="firstname" required>
                <label>First Name*</label>
            </div>
            <div class="user-box">
                <input type="text" name="lastname" required>
                <label>Last Name*</label>
            </div>
            <div class="user-box">
                <input type="text" name="email" required>
                <label>Confirmation Email*</label>
            </div>
            <div class="user-box">
                <input type="text" name="contactno" required>
                <label>Contact No.*</label>
            </div>
            <div class='btn-box' style='position:relative; display:flex; flex-direction:column; align-items:center;'>
                <input class='btn btn-primary' type="submit" value="Submit" style='width:200px;'>
            </div>
            <div class='btn-box' style='position:relative; display:flex; flex-direction:column; align-items:center;'>
                <a href='login.php' id='register-btn'>Back to Login</a>
            </div>
        </form>
    </div>
    <script>
        let validateForm = function(){
            if(document.getElementById("password").value != document.getElementById("confirm_password").value){
                var element =  document.getElementById('noPass');
                if (element == null){
                    var tag = document.createElement("div");
                    var text = document.createTextNode("Passwords do not match");
                    tag.appendChild(text);
                    tag.id = 'noPass';
                    var element = document.getElementById("header");
                    element.appendChild(tag);
                    return false;
                }
                return false;
            }
            else{
                return true;
            }
        }
    </script>
</body>
</html>
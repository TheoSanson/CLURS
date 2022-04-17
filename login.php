<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "static/include/head.php"; ?>
    <link rel="stylesheet" href="static/assets/css/login.css">
    <title>Document</title>
</head>
<body id='login-body'>
    <div class="login-box">
        <div style='margin-bottom:20px; font-size:20px;'>
            <h3>ICS ComLabs</h3>
            Login
        </div>
        <form method='POST' action='static/function/login.php'>
            <div class="user-box">
                <input type="text" name="username" required="">
                <label>Username</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required="">
                <label>Password</label>
            </div>
            <div class='btn-box' style='position:relative; display:flex; flex-direction:column; align-items:center;'>
                <input class='btn btn-primary' type="submit" value="Submit" style='width:200px;'>
            </div>
            <div class='btn-box' style='position:relative; display:flex; flex-direction:column; align-items:center;'>
                <a href='register.php' id='register-btn'>Register</a>
            </div>
        </form>
    </div>
</body>
</html>
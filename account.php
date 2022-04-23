<?php # include "static/function/authenticate.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "static/include/head.php"; ?>
    <title>Document</title>
</head>
<body>
    <?php include "static/include/navbar.php"; ?>
    <div class="p-1 my-container active-cont">
        <div class="center-container container" style='width:50%;'>
            
            <h2>Account Details</h2>
            <h4>
                <?php 
                    $record = mysqli_query($link,"SELECT * FROM user WHERE id=".$_SESSION['id']);
                    $user=mysqli_fetch_array($record);
                ?>
            </h4>
            <div>
                <button class="btn btn-secondary open-edit-modal">
                    Edit User Details
                </button>
                <button class="btn btn-secondary open-password-modal">
                    Change Password
                </button>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-6">
                    <h5 style='margin-bottom:2px; color:grey;'> First Name </h5>
                    <h4 style='margin-bottom:20px;'> <?php echo $user['firstname']; ?> </h4>
                </div>
                <div class="col-lg-6">
                    <h5 style='margin-bottom:2px; color:grey;'> Last Name </h5>
                    <h4 style='margin-bottom:20px;'> <?php echo $user['lastname']; ?> </h4>
                </div>
                <div class="col-lg-6">
                    <h5 style='margin-bottom:2px; color:grey;'> School ID </h5>
                    <h4 style='margin-bottom:20px;'> <?php echo $user['school_id']; ?> </h4>
                </div>
                <div class="col-lg-6">
                    <h5 style='margin-bottom:2px; color:grey;'> User Type</h5>
                    <h4 style='margin-bottom:20px;'> <?php 
                        if($user['access_level'] > 0){
                            echo 'Student';
                        } 
                        else{
                            echo "Admin"; 
                        }
                    ?> </h4>
                </div>
                <div class="col-lg-6">
                    <h5 style='margin-bottom:2px; color:grey;'> Username </h5>
                    <h4 style='margin-bottom:20px;'> <?php echo $user['username']; ?> </h4>
                </div>
                <div class="col-lg-6">
                    <h5 style='margin-bottom:2px; color:grey;'> Email </h5>
                    <h4 style='margin-bottom:20px;'> <?php echo $user['email']; ?> </h4>
                </div>
            </div>
        </div>
    </div>
    <div class="page-modal" id='0'>
        <div class="page-modal-container" style='width:500px; height:auto;'>
            <form class='modal-form container' method="post" action="static/function/update_admin_user.php">
                <div class="row">
                    <h3>Edit Admin User</h3>
                </div>
                <input type='hidden' id='user_id' name='user_id' value='<?php echo $user['id']; ?>'>
                <input type='hidden' id='access_level' name='access_level' value='<?php echo $user['access_level']; ?>'>
                <div class="row">
                    <div class='col-md-10 offset-md-1 p-0'>User Name</div>
                    <input type='text' id='edit-username' name='username' class='col-md-10 offset-md-1 p-1' value='<?php echo $user['username']; ?>' required>
                </div>
                <div class="row">
                    <div class='col-md-10 offset-md-1 p-0'>School ID</div>
                    <input type='text' id='edit-school_id' name='school_id' class='col-md-10 offset-md-1 p-1' value='<?php echo $user['school_id']; ?>' required>
                </div>
                <div class="row">
                    <div class='col-md-10 offset-md-1 p-0'>First Name</div>
                    <input type='text' id='edit-firstname' name='firstname' class='col-md-10 offset-md-1 p-1' value='<?php echo $user['firstname']; ?>' required>
                </div>
                <div class="row">
                    <div class='col-md-10 offset-md-1 p-0'>Last Name</div>
                    <input type='text' id='edit-lastname' name='lastname' class='col-md-10 offset-md-1 p-1' value='<?php echo $user['lastname']; ?>' required>
                </div>
                <div class="row">
                    <div class='col-md-10 offset-md-1 p-0'>Email</div>
                    <input type='text' id='edit-email' name='email' class='col-md-10 offset-md-1 p-1' value='<?php echo $user['email']; ?>' required>
                </div>
                <div class="row">
                    <div class='col-md-10 offset-md-1 p-0'>Contact No.</div>
                    <input type='text' id='edit-contactno' name='contactno' class='col-md-10 offset-md-1 p-1' value='<?php echo $user['contactno']; ?>' required>
                </div>
                <input type='hidden' id='edit-account' name='edit-account' value='true'>
                <div class="row">
                    <div class='col-md-10 offset-md-1 p-0' style='display:flex; margin-top:20px;'><button type='button' class='btn btn-secondary close-edit-modal' style='flex:0.8;'>Cancel</button><input type='submit' class='btn btn-primary' style='margin-left:20px;flex:1;' value='Update'></div>
                </div>
            </form>
        </div>
    </div>
    <div class="page-modal" id='1'>
        <div class="page-modal-container" style='width:500px; height:auto;'>
            <form class='modal-form container' method="post" action="static/function/update_user_password.php" onsubmit="return validatePassword()">
                <div class="row">
                    <h3>Change Password</h3>
                </div>
                <input type='hidden' id='user_id' name='user_id' value='<?php echo $user['id']; ?>'>
                <div class="row">
                    <div class='col-md-10 offset-md-1 p-0'>Current Password</div>
                    <input type='password' name='current_password' class='col-md-10 offset-md-1 p-1' required>
                </div>
                <div class="row">
                    <div class='col-md-10 offset-md-1 p-0'>New Password</div>
                    <input type='password' id='new_password' name='new_password' class='col-md-10 offset-md-1 p-1' required>
                </div>
                <div class="row">
                    <div class='col-md-10 offset-md-1 p-0'>Confirm New Password</div>
                    <input type='password' id='confirm_password' name='confirm_password' class='col-md-10 offset-md-1 p-1' required>
                </div>
                <div class="row">
                    <div class='col-md-10 offset-md-1 p-0' style='display:flex; margin-top:20px;'><button type='button' class='btn btn-secondary close-password-modal' style='flex:0.8;'>Cancel</button><input type='submit' class='btn btn-primary' style='margin-left:20px;flex:1;' value='Update'></div>
                </div>
            </form>
        </div>
    </div>
    <?php include "static/include/scripts.php"; ?>
    <script src="static/assets/js/modal.js"></script>
    <script>
        $(document).on('click', '.open-edit-modal', function() {
            openModal(0);
            return 0;
        });

        $(document).on('click', '.close-edit-modal', function() {
            closeModal(0);
            return 0;
        });
        $(document).on('click', '.open-password-modal', function() {
            openModal(1);
            return 0;
        });

        $(document).on('click', '.close-password-modal', function() {
            closeModal(1);
            return 0;
        });

        function validatePassword(){
            new_password = document.getElementById('new_password').value;
            confirm_password = document.getElementById('confirm_password').value;
            if(new_password != confirm_password){
                if(document.getElementById('password-mismatch') == null){
                    $("#confirm_password").after( "<p id='password-mismatch' class='col-md-10 offset-md-1 p-0' style='color:red; font-size:15px; margin-top:3px; margin-bottom:3px;'>Passwords do not Match!</p>" );
                }
                return false;
            }
            else{
                $('#password-mismatch').remove();
                return true;
            }
        };
    </script>
</body>
</html>
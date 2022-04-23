<!DOCTYPE html>
<html lang="en">
    <head>
        <?php 
            include "static/include/head.php";
            include "static/include/table-plugin.php";
            include "static/function/authenticateAdmin.php"; 
        ?>
        <link href="static/assets/css/list.css" rel="stylesheet">
        <title>Laboratories</title>
    </head>
    <body>
        <?php
            include "static/include/navbar.php";
        ?>
        <div class="p-1 my-container active-cont">
            <div class="center-container">
                <h2>System Admin Management</h2>
                <hr>
                <div class='add-btn-container'>
                    <button class='btn btn-success open-modal'>Create New User</button>
                </div>
                <table id='lab-table' class='table table-striped table-hover' style='width:100%; margin-top:30px !important;'>
                    <thead class='table-dark'>
                        <tr>
                            <td class='hidden'>
                                id
                            </td>
                            <td style='width:15%;'>
                                School ID
                            </td>
                            <td style='width:15%;'>
                                Login Username
                            </td>
                            <td style='width:30%;'>
                                Full Name
                            </td>
                            <td style='width:20%;'>
                                Email
                            </td>
                            <td style='width:20%;'>
                                Contact No.
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $users = mysqli_query($link,"SELECT * FROM user WHERE access_level > 0");
                            if ($users->num_rows > 0) {
                                while($user=mysqli_fetch_array($users)):
                        ?>
                        <tr name='<?php echo $user['id']; ?>'>
                            <td class='hidden'>
                                <?php echo $user['id']; ?>
                            </td>
                            <td style='width:15%;' id='td-school_id-<?php echo $user['id']; ?>'>
                                <?php echo $user['school_id']; ?>
                            </td>
                            <td style='width:15%;' id='td-username-<?php echo $user['id']; ?>'>
                                <?php echo $user['username']; ?>
                            </td>
                            <td style='width:30%;'>
                                    <div class="hidden" id='td-firstname-<?php echo $user['id']; ?>'><?php echo $user['firstname']; ?></div>
                                    <div class="hidden" id='td-lastname-<?php echo $user['id']; ?>'><?php echo $user['lastname']; ?></div>
                            <?php echo $user['firstname']." ".$user['lastname']; ?>
                            </td>
                            <td style='width:20%;' id='td-email-<?php echo $user['id']; ?>'>
                            <?php echo $user['email']; ?>
                            </td>
                            <td style='width:20%; position:relative;' id='td-contactno-<?php echo $user['id']; ?>'>
                            <?php echo $user['contactno']; ?>
                                <div class='row-btn-containers' style='align-items:center; position:absolute; right:0px;'>
                                    <button class='btn btn-primary row-edit-btn open-edit-modal' name='<?php echo $user['id']; ?>' style='margin-right:2px'><i class='bx bx-clipboard'></i></button>
                                    <button class='btn btn-danger row-edit-btn open-delete-modal' name='<?php echo $user['id']; ?>'><i class='bx bx-trash-alt'></i></button>
                                </div>
                            </td>
                        </tr>
                        <?php
                                endwhile;
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="page-modal" id='0'>
            <div class="page-modal-container" style='width:500px; height:auto;'>
                <form class='modal-form container' method="post" action="static/function/insert_admin_user.php">
                    <div class="row">
                        <h3>Create New Admin User</h3>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0'>User Name</div>
                        <input type='text' name='username' class='col-md-10 offset-md-1 p-1' required>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0'>School ID</div>
                        <input type='text' name='school_id' class='col-md-10 offset-md-1 p-1' required>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0'>First Name</div>
                        <input type='text' name='firstname' class='col-md-10 offset-md-1 p-1' required>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0'>Last Name</div>
                        <input type='text' name='lastname' class='col-md-10 offset-md-1 p-1' required>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0'>Email</div>
                        <input type='text' name='email' class='col-md-10 offset-md-1 p-1' required>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0'>Contact No.</div>
                        <input type='text' name='contactno' class='col-md-10 offset-md-1 p-1' required>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0' style='display:flex; margin-top:20px;'><button type='button' class='btn btn-secondary close-modal' style='flex:0.8;'>Cancel</button><input type='submit' class='btn btn-success' style='margin-left:20px;flex:1;' value='Add'></div>
                    </div>
                </form>
            </div>
        </div>
        <div class="page-modal" id='1'>
            <div class="page-modal-container" style='width:500px; height:auto;'>
                <form class='modal-form container' method="post" action="static/function/update_admin_user.php">
                    <div class="row">
                        <h3>Edit Admin User</h3>
                    </div>
                    <input type='hidden' id='user_id' name='user_id' value=''>
                    <input type='hidden' id='access_level' name='access_level' value='1'>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0'>User Name</div>
                        <input type='text' id='edit-username' name='username' class='col-md-10 offset-md-1 p-1' required>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0'>School ID</div>
                        <input type='text' id='edit-school_id' name='school_id' class='col-md-10 offset-md-1 p-1' required>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0'>First Name</div>
                        <input type='text' id='edit-firstname' name='firstname' class='col-md-10 offset-md-1 p-1' required>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0'>Last Name</div>
                        <input type='text' id='edit-lastname' name='lastname' class='col-md-10 offset-md-1 p-1' required>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0'>Email</div>
                        <input type='text' id='edit-email' name='email' class='col-md-10 offset-md-1 p-1' required>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0'>Contact No.</div>
                        <input type='text' id='edit-contactno' name='contactno' class='col-md-10 offset-md-1 p-1' required>
                    </div>
                    <div class="row">
                        <div class="col-md-10 offset-md-1 p-0" style='display:flex; align-items:center;'>
                            <input type="checkbox" id="reset" name="reset" value="true" style='margin-right:10px;'>
                            <label for="repeat" style='font-size:20px;'>Reset Password</label><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0' style='display:flex; margin-top:20px;'><button type='button' class='btn btn-secondary close-edit-modal' style='flex:0.8;'>Cancel</button><input type='submit' class='btn btn-primary' style='margin-left:20px;flex:1;' value='Update'></div>
                    </div>
                </form>
            </div>
        </div>
        <div class="page-modal" id='2'>
            <div id="page-modal-container" class="page-modal-container" style='width:500px; height:auto; margin-bottom:80px; margin-top:40px; display:flex; align-items:center;'>
                <form class='modal-form container' method="post" action="static/function/delete_admin_user.php" style='flex:60%;'>
                    <input type='hidden' id='delete-user-id' name='user_id' value=''>
                    <input type='hidden' id='access_level' name='access_level' value='0'>
                    <div class="row" style='margin-bottom:10px;'>
                        <h3 style='color:red;'>This will Delete the User!</h3>
                        <h4>Are you sure?</h4>
                    </div>
                    <hr>
                    <div class="row">
                        <h5 class='col-md-10 offset-md-1 p-0'>ID</h5>
                        <h6 class='col-md-10 offset-md-1 p-0' id='delete-id'></h6>
                    </div>
                    <div class="row">
                        <h5 class='col-md-10 offset-md-1 p-0'>Username</h5>
                        <h6 class='col-md-10 offset-md-1 p-0' id='delete-username'></h6>
                    </div>
                    <div class="row">
                        <h5 class='col-md-10 offset-md-1 p-0'>Email</h5>
                        <h6 class='col-md-10 offset-md-1 p-0' id='delete-email'></h6>
                    </div>
                    <div class="row">
                        <h5 class='col-md-10 offset-md-1 p-0'>Name</h5>
                        <h6 class='col-md-10 offset-md-1 p-0' id='delete-name'></h6>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0' style='display:flex; margin-top:20px;'>
                        <button type='button' class='btn btn-secondary close-delete-modal' style='flex:0.8;'>Cancel</button><input type='submit' class='btn btn-danger' style='margin-left:20px;flex:1;' value='Delete'></div>
                    </div>
                </form>
            </div>
        </div>
        <?php 
            include "static/include/scripts.php";
            include "static/include/table-scripts.php";
        ?>
        <script src="static/assets/js/modal.js"></script>
        <script>
            $(document).on('click', '.open-edit-modal', function() {
                var user_id = $(this).attr('name');
                document.getElementById('user_id').value = user_id;
                document.getElementById('edit-school_id').value = document.getElementById('td-school_id-'+user_id).innerText;
                document.getElementById('edit-username').value = document.getElementById('td-username-'+user_id).innerText;
                document.getElementById('edit-firstname').value = document.getElementById('td-firstname-'+user_id).innerText;
                document.getElementById('edit-lastname').value = document.getElementById('td-lastname-'+user_id).innerText;
                document.getElementById('edit-contactno').value = document.getElementById('td-contactno-'+user_id).innerText;
                document.getElementById('edit-email').value = document.getElementById('td-email-'+user_id).innerText;
                openModal(1);
                return 0;
            });

            $(document).on('click', '.close-edit-modal', function() {
                closeModal(1);
                return 0;
            });

            $(document).on('click', '.open-delete-modal', function() {
                var user_id = $(this).attr('name');
                document.getElementById('delete-user-id').value = user_id;
                document.getElementById('delete-id').innerText = document.getElementById('td-school_id-'+user_id).innerText;
                document.getElementById('delete-username').innerText = document.getElementById('td-username-'+user_id).innerText;
                document.getElementById('delete-name').innerText = document.getElementById('td-firstname-'+user_id).innerText + " " + document.getElementById('td-lastname-'+user_id).innerText;
                document.getElementById('delete-email').innerText = document.getElementById('td-email-'+user_id).innerText;
                openModal(2);
                return 0;
            });

            $(document).on('click', '.close-delete-modal', function() {
                closeModal(2);
                return 0;
            });
        </script>
    </body>
</html>
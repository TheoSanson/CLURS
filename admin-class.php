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
    <?php
        $lab_id = $_REQUEST['id'];
    ?>
    <body>
        <?php
            include "static/include/navbar.php";
        ?>
        <div class="p-1 my-container active-cont">
            <div class="center-container">
                <h2>Class Sessions Management</h2>
                <h4>
                    <?php 
                        $record = mysqli_query($link,"SELECT * FROM laboratory WHERE id=$lab_id");
                        $lab=mysqli_fetch_array($record);
                        if(isset($lab)){
                            echo $lab['name'];
                        }
                    ?>
                </h4>
                <h5>
                    <?php 
                        echo date('h:i a',strtotime($lab['time_open']))." - ".date('h:i a',strtotime($lab['time_close']));
                    ?>
                </h5>
                <hr>
                <div class='add-btn-container'>
                    <button class='btn btn-success open-modal'>Add New Class Schedule</button>
                    <button class='btn btn-primary open-modal-2'>Edit Laboratory Opening/Closing Times</button>
                    <button class='btn btn-secondary' id='manage-session-btn' name='<?php echo $lab_id; ?>'>Manage Computers</button>
                </div>
                <table id='lab-table' class='table table-striped table-hover' style='width:100%; margin-top:30px !important;'>
                    <thead class='table-dark'>
                        <tr>
                            <td class='hidden' style='width:10%;'>
                                id
                            </td>
                            <td style='width:35%;'>
                                Schedule Description
                            </td>
                            <td style='width:15%;'>
                                Time Start
                            </td>
                            <td style='width:15%;'>
                                Time End
                            </td>
                            <td style='width:15%;'>
                                Date
                            </td>
                            <td style='width:15%;'>
                                End Date
                            </td>
                            <td style='width:15%;'>
                                Duration
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sessions = mysqli_query($link,"SELECT * FROM class_session WHERE lab=$lab_id AND repeat_id IS NULL");
                            if ($sessions->num_rows > 0) {
                                while($session=mysqli_fetch_array($sessions)):
                        ?>
                        <tr name='<?php echo $session['id']; ?>'>
                            <td class='hidden' style='width:10%;'>
                                id
                            </td>
                            <td style='width:35%;' id='td-desc-<?php echo $session['id']; ?>'>
                                <?php echo $session['description']; ?>
                            </td>
                            <td style='width:15%;' id='<?php echo $session['id'] ?>-time_start' name='<?php echo $time_start = date('h:i a',strtotime($session['time_start'])); ?>'>
                                <?php echo $time_start; ?>
                            </td>
                            <td style='width:15%;' id='<?php echo $session['id'] ?>-time_end' name='<?php echo $time_end = date('h:i a',strtotime($session['time_end'])); ?>'>
                                <?php echo $time_end; ?>
                            </td>
                            <td style='width:15%;'>
                                <?php echo $session['date']; ?>
                            </td>
                            <td style='width:15%;'>
                                <?php 
                                    $r_sessions = mysqli_query($link,"SELECT * FROM class_session WHERE repeat_id=".$session['id']." ORDER BY date DESC");
                                    if ($r_sessions->num_rows > 0) {
                                        while($r_session=mysqli_fetch_array($r_sessions)):
                                            echo $r_session['date'];
                                            break;
                                        endwhile;
                                    }
                                ?>
                            </td>
                            <td style='width:15%; position:relative;' id='td-duration-<?php echo $session['id']; ?>'>
                                <?php echo $session['duration']; ?>
                                <div class='row-btn-containers' style='align-items:center; position:absolute; right:0px;'>
                                    <button class='btn btn-primary row-edit-btn open-edit-modal' name='<?php echo $session['id']; ?>' style='margin-right:2px'><i class='bx bx-clipboard'></i></button>
                                    <button class='btn btn-danger row-edit-btn open-delete-modal' name='<?php echo $session['id']; ?>'><i class='bx bx-trash-alt'></i></button>
                                </div>
                            </td>
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
            <div class="page-modal-container" style='width:500px; height:660px;'>
                <form class='modal-form container' method="post" action="static/function/insert_class_session.php">
                    <input type='hidden' name='lab_id' value='<?php echo $lab_id; ?>'>
                    <div class="row">
                        <h3>Create Laboratory</h3>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0'>Session Description</div>
                        <input type='text' name='session_desc' class='col-md-10 offset-md-1 p-1' required>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0'>Date</div>
                        <input type='date' id='repeat-start' name='date' class='col-md-10 offset-md-1 p-1' required>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0'>Time Start</div>
                        <input type='time' id='add_time_start' name='time_start' class='col-md-10 offset-md-1 p-1' step='1800' required>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0'>Time End</div>
                        <input type='time' id='add_time_end' name='time_end' class='col-md-10 offset-md-1 p-1' step='1800' required>
                    </div>
                    <div class="row">
                        <div class="col-md-10 offset-md-1 p-0">
                            <input type="checkbox" id="repeat" name="repeat" value="true" onclick="handleClick(this)">
                            <label for="repeat">Repeat</label><br>
                        </div>
                        <div class="col-md-10 offset-md-1 p-0" style='margin-bottom:15px;'>
                            <select name='occurrence' id='occurrence' class='col-md-12' disabled>
                                <option value='daily'>Daily</option>
                                <option value='weekly'>Weekly</option>
                            </select>
                        </div>
                        <div class="col-md-10 offset-md-1 p-0">
                            <div class='col-md-12 p-0'>Until</div>
                            <input type='date' name='repeat-end' id='repeat-end' class='col-md-12' disabled required> 
                        </div>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0' style='display:flex; margin-top:20px;'>
                        <button type='button' class='btn btn-secondary close-modal' style='flex:0.8;'>Cancel</button><input type='submit' class='btn btn-primary' style='margin-left:20px;flex:1;' value='Add'></div>
                    </div>
                </form>
            </div>
        </div>
        <div class="page-modal" id='1'>
            <div class="page-modal-container" style='width:500px; height:auto;'>
                <form class='modal-form container' method="post" action="static/function/update_lab_times.php">
                    <input type='hidden' name='lab_id' value='<?php echo $lab_id; ?>'>
                    <div class="row">
                        <h3>Set Open and Close Times</h3>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0'>Time Start</div>
                        <input type='time' id='labsched_edit_time_start' name='time_open' class='col-md-10 offset-md-1 p-1' step='1800' value='<?php echo $lab['time_open']; ?>' required>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0'>Time End</div>
                        <input type='time' id='labsched_edit_time_end' name='time_close' class='col-md-10 offset-md-1 p-1' step='1800' value='<?php echo $lab['time_close']; ?>' required>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0' style='display:flex; margin-top:20px;'>
                        <button type='button' class='btn btn-secondary close-modal-2' style='flex:0.8;'>Cancel</button><input type='submit' class='btn btn-primary' style='margin-left:20px;flex:1;' value='Edit Time'></div>
                    </div>
                </form>
            </div>
        </div>
        <div class="page-modal" id='2'>
            <div class="page-modal-container" style='width:500px; height:auto;'>
                <form class='modal-form container' method="post" action="static/function/update_class_session.php">
                    <input type='hidden' id='session_id' name='session_id' value=''>
                    <input type='hidden' name='lab_id' value='<?php echo $lab_id; ?>'>
                    <div class="row">
                        <h3>Set Session Time</h3>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0'>Time Start</div>
                        <input type='time' id='edit_time_start' name='time_start' class='col-md-10 offset-md-1 p-1' step='1800' value='' required>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0'>Time End</div>
                        <input type='time' id='edit_time_end' name='time_end' class='col-md-10 offset-md-1 p-1' step='1800' value='' required>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0' style='display:flex; margin-top:20px;'>
                        <button type='button' class='btn btn-secondary close-edit-modal' style='flex:0.8;'>Cancel</button><input type='submit' class='btn btn-primary' style='margin-left:20px;flex:1;' value='Edit Time'></div>
                    </div>
                </form>
            </div>
        </div>
        <div class="page-modal" id='3'>
            <div id="page-modal-container" class="page-modal-container" style='width:500px; height:auto; margin-bottom:80px; margin-top:40px; display:flex; align-items:center;'>
                <form class='modal-form container' method="post" action="static/function/delete_class_session.php" style='flex:60%;'>
                    <input type='hidden' name='lab_id' value='<?php echo $lab_id; ?>'>
                    <input type='hidden' id='delete-session-id' name='session-id' value=''>
                    <div class="row" style='margin-bottom:10px;'>
                        <h3 style='color:red;'>This will Delete the session!</h3>
                        <h4>Are you sure?</h4>
                    </div>
                    <hr>
                    <div class="row">
                        <h5 class='col-md-10 offset-md-1 p-0'>Description</h5>
                        <h6 class='col-md-10 offset-md-1 p-0' id='delete-desc'></h6>
                    </div>
                    <div class="row">
                        <h5 class='col-md-10 offset-md-1 p-0'>Time Start</h5>
                        <h6 class='col-md-10 offset-md-1 p-0' id='delete-start'></h6>
                    </div>
                    <div class="row">
                        <h5 class='col-md-10 offset-md-1 p-0'>Time End</h5>
                        <h6 class='col-md-10 offset-md-1 p-0' id='delete-end'></h6>
                    </div>
                    <div class="row">
                        <h5 class='col-md-10 offset-md-1 p-0'>Duration</h5>
                        <h6 class='col-md-10 offset-md-1 p-0' id='delete-duration'></h6>
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
            $(document).on('click', '.open-modal-2', function() {
                openModal(1);
                return 0;
            });

            $(document).on('click', '.close-modal-2', function() {
                closeModal(1);
                return 0;
            });
            
            $(document).on('click', '.open-edit-modal', function() {
                var session_id = $(this).attr('name');
                document.getElementById('session_id').value = session_id;
                document.getElementById('edit_time_start').value = convertTime12to24($('#'+session_id+'-time_start').attr('name'));
                document.getElementById('edit_time_end').value = convertTime12to24($('#'+session_id+'-time_end').attr('name'));
                openModal(2);
                return 0;
            });

            $(document).on('click', '.close-edit-modal', function() {
                closeModal(2);
                return 0;
            });
            
            $(document).on('click', '.open-delete-modal', function() {
                var session_id = $(this).attr('name');
                document.getElementById('delete-session-id').value = session_id;
                document.getElementById('delete-desc').innerText = document.getElementById('td-desc-'+$(this).attr('name')).innerText;
                document.getElementById('delete-start').innerText = $('#'+session_id+'-time_start').attr('name');
                document.getElementById('delete-end').innerText = $('#'+session_id+'-time_end').attr('name');
                var duration = parseInt(document.getElementById('td-duration-'+$(this).attr('name')).innerText)/60;
                var duration_text = ' Hours';
                if(duration==1){
                    duration_text = ' Hour';
                }
                document.getElementById('delete-duration').innerText = duration + duration_text;
                openModal(3);
                return 0;
            });
            
            $(document).on('click', '.close-delete-modal', function() {
                closeModal(3);
                return 0;
            });

            $(document).on('click', '#manage-session-btn', function() {
                var id = $(this).attr('name');
                window.location.href = "admin-lab-view.php?id="+id;
            });
            
            function handleClick(cb) {
                if(cb.checked){
                    document.getElementById('occurrence').disabled = false;
                    document.getElementById('repeat-end').disabled = false;
                }
                else{
                    document.getElementById('occurrence').disabled = true;
                    document.getElementById('repeat-end').disabled = true;
                }
            };

            $(document).on('change', '#add_time_start', function() {
                validate30Minutes('add_time_start');
                return validateTime('add');
            });

            $(document).on('change', '#add_time_end', function() {
                validate30Minutes('add_time_end');
                return validateTime('add');
            });

            $(document).on('change', '#labsched_edit_time_start', function() {
                validate30Minutes('labsched_edit_time_start');
                return validateTime('labsched_edit');
            });

            $(document).on('change', '#labsched_edit_time_end', function() {
                validate30Minutes('labsched_edit_time_end');
                return validateTime('labsched_edit');
            });

            $(document).on('change', '#edit_time_start', function() {
                validate30Minutes('edit_time_start');
                return validateTime('edit');
            });
            $(document).on('change', '#edit_time_end', function() {
                validate30Minutes('edit_time_end');
                return validateTime('edit');
            });
            $(document).on('change', '#repeat-start', function() {
                return validateDate();
            });
            $(document).on('change', '#repeat-end', function() {
                return validateDate();
            });


            function validateTime(type){
                time_start = document.getElementById(type+'_time_start');
                time_end = document.getElementById(type+'_time_end');
                if(time_start.value != '' && time_end.value != ''){
                    if(time_start.value>time_end.value){
                        alert('Time-End cannot be before Time-Start!');
                        time_end.value = '';
                        return false;
                    }
                    else{
                        return true;
                    }
                }
            };

            function validateDate(){
                date_start = document.getElementById('repeat-start');
                date_end = document.getElementById('repeat-end');
                if(date_start.value != '' && date_end.value != ''){
                    if(date_start.value>date_end.value){
                        alert('Date End cannot be before Date Start!');
                        date_end.value = '';
                        return false;
                    }
                    else{
                        return true;
                    }
                }
            }

            const convertTime12to24 = (time12h) => {
                const [time, modifier] = time12h.split(' ');

                let [hours, minutes] = time.split(':');

                if (hours === '12') {
                    hours = '00';
                }

                if (modifier === 'pm') {
                    hours = parseInt(hours, 10) + 12;
                }

                return `${hours}:${minutes}`;
            };
        </script>
    </body>
</html>
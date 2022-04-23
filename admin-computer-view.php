<?php # include "static/function/authenticate.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        include "static/include/head.php";
        include "static/include/table-plugin.php"; 
        include "static/function/authenticateAdmin.php";
    ?>
    <link href="static/assets/css/list.css" rel="stylesheet">
    <link href="static/assets/css/schedule.css" rel="stylesheet">
    <title>Document</title>
</head>
<?php
    $computer_id = $_REQUEST['id'];
?>
<body>
    <?php include "static/include/navbar.php"; ?>
    <div class="p-1 my-container active-cont">
        <div class="center-container">
            <h2>Computer Manager</h2>
            <?php 
                $record = mysqli_query($link,"SELECT * FROM computer WHERE id=$computer_id");
                $computer=mysqli_fetch_array($record);
                if(isset($computer)){
                    $computer_id = $computer['id'];
                    $lab_id = $computer['lab'];
                }
                $lab_record = mysqli_query($link,"SELECT * FROM laboratory WHERE id=$lab_id");
                $lab=mysqli_fetch_array($lab_record);
                if(isset($lab)){
                    $lab_id = $lab['id'];
                    $time_open = $lab['time_open'];
                    $time_close = $lab['time_close'];
                }
            ?>
            <div class="d-flex">
                <div style='flex:60%;'>
                    <div class='container' style='margin-top:10px; margin-bottom:10px;'>
                        <div class='row' style='margin-bottom:10px;'>
                            <h3 class='col-md-12' style='display:flex; align-items:center;' id='computer-status-container'>
                                <?php echo "PC-".$computer_id; ?>
                                <button class='btn <?php
                                    $button_label = '';
                                    if($computer['status'] == 'Available'){
                                        $button_label = "Mark as Unavailable";
                                        echo "btn-danger";
                                    }
                                    else{
                                        $button_label = "Mark as Available";
                                        echo "btn-success";
                                    }
                                ?>' style='margin-left:10px;' id='togglePC'><?php echo $button_label; ?></button>
                                <button class='btn btn-secondary' style='margin-left:10px;' id='return-lab-btn'>Return to Laboratory</button>
                            </h3>
                        </div>
                        <div style='margin-bottom:10px;'>
                            <div class="row" id='computer-info-container'>
                                <!-- Output Computer Statuses -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <h4>Select Date:</h4>
                            </div>
                            <input type='date' id='date' class="col-md-3 p-0" value='<?php echo $today = date('Y-m-d'); ?>'>
                        </div>
                    </div>
                    <hr>
                    <table id='lab-table' class='table table-striped table-hover' style='width:100%; margin-top:30px !important;'>
                        <thead class='table-dark'>
                            <tr>
                                <td class='hidden' style='width:10%;'>
                                    id
                                </td>
                                <td style='width:40%;'>
                                    User
                                </td>
                                <td style='width:20%;'>
                                    Time Start
                                </td>
                                <td style='width:20%;'>
                                    Time End
                                </td>
                                <td style='width:10%;'>
                                    Duration
                                </td>
                            </tr>
                        </thead>
                        <tbody id='session-list-body'>
                            <!-- Output Session List -->
                        </tbody>
                    </table>
                </div>
                <div id='schedule-table-container' class="row" style='flex:40%;'>
                    <table id='schedule-table'>
                        <tbody id='schedule-table-id'>
                            <!-- Output Session Schedule -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="page-modal" id='0'>
        <div id="page-modal-container" class="page-modal-container" style='width:500px; height:auto; margin-bottom:80px; margin-top:40px; display:flex; align-items:center;'>
            <form class='modal-form container' method="post" action="static/function/update_reservation.php" style='flex:60%;'>
                <input type='hidden' id='computer-id' name='computer-id' value='<?php echo $computer_id; ?>'>
                <input type='hidden' id='session-id' name='session-id' value=''>
                <div class="row" style='margin-bottom:10px;'>
                    <h3>Edit Reservation</h3>
                </div>
                <div class="row">
                    <div class='col-md-10 offset-md-1 p-0'>Select Date</div>
                    <input id='edit-date' type='date' name='edit-date' class='col-md-10 offset-md-1' style='padding-left:0px;'>
                </div>
                <div class="row">
                    <div class='col-md-10 offset-md-1 p-0' style='margin-bottom:0px;'>Time Start</div>
                    <div class='col-md-10 offset-md-1 p-0' style='font-size:13px;'>Please Select 30 Minute Intervals (7:00, 7:30, 8:00, etc..)</div>
                    <input type='time' name='time_start' id='time_start' class='col-md-10 offset-md-1' style='padding-left:0px;' step='1800'>
                </div>
                <div class="row" style='margin-bottom:10px;'>
                    <div class='col-md-10 offset-md-1 p-0'>Duration</div>
                    <div class="col-md-10 offset-md-1 p-0" style='margin-bottom:15px;'>
                        <select name='duration' id='duration' class='col-md-12'>
                            <option value=''>-----</option>
                            <option value='30'>30 Minutes</option>
                            <option value='60'>1 Hour</option>
                            <option value='90'>1 Hr, 30 Mins</option>
                            <option value='120'>2 Hours</option>
                            <option value='150'>2 Hrs, 30 Mins</option>
                            <option value='180'>3 Hours</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class='col-md-10 offset-md-1 p-0' style='display:flex; margin-top:20px;'>
                    <button type='button' class='btn btn-secondary close-modal' style='flex:0.8;'>Cancel</button><input type='submit' class='btn btn-primary' style='margin-left:20px;flex:1;' value='Edit'></div>
                </div>
            </form>
            <div id='edit-schedule-table-container' class="row hidden" style='flex:40%;'>
                <table id='schedule-table' >
                    <tbody id='edit-schedule-table-id'>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="page-modal" id='1'>
        <div id="page-modal-container" class="page-modal-container" style='width:500px; height:auto; margin-bottom:80px; margin-top:40px; display:flex; align-items:center;'>
            <form class='modal-form container' method="post" action="static/function/delete_session.php" style='flex:60%;'>
                <input type='hidden' name='computer-id' value='<?php echo $computer_id; ?>'>
                <input type='hidden' id='delete-session-id' name='session-id' value=''>
                <div class="row" style='margin-bottom:10px;'>
                    <h3 style='color:red;'>This will Delete the session!</h3>
                    <h4>Are you sure?</h4>
                </div>
                <hr>
                <div class="row">
                    <h5 class='col-md-10 offset-md-1 p-0'>User</h5>
                    <h6 class='col-md-10 offset-md-1 p-0' id='delete-user'></h6>
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
        $(document).ready(function (){
            loadSessions();
            $(document).on('click', '.open-edit-modal', function() {
                document.getElementById('session-id').value = $(this).attr('name');
                document.getElementById('edit-date').value = document.getElementById('date').value;
                getSession();
                document.getElementById('time_start').value = document.getElementById('td-start-'+$(this).attr('name')).innerText;
                openModal(0);
                return 0;
            });
            
            $(document).on('click', '.open-delete-modal', function() {
                document.getElementById('delete-session-id').value = $(this).attr('name');
                document.getElementById('delete-user').innerText = document.getElementById('td-user-'+$(this).attr('name')).innerText;
                document.getElementById('delete-start').innerText = document.getElementById('td-start-'+$(this).attr('name')).innerText;
                document.getElementById('delete-end').innerText = document.getElementById('td-end-'+$(this).attr('name')).innerText;
                var duration = parseInt(document.getElementById('td-duration-'+$(this).attr('name')).innerText)/60;
                var duration_text = ' Hours';
                if(duration==1){
                    duration_text = ' Hour';
                }
                document.getElementById('delete-duration').innerText = duration + duration_text;
                openModal(1);
                return 0;
            });
            
            $(document).on('click', '.close-delete-modal', function() {
                closeModal(1);
                return 0;
            });

            $(document).on('change', '#date', function() {
                loadSessions();
            });

            $(document).on('click', '#togglePC', function() {
                var computer_id = <?php echo $computer_id; ?>;
                $.ajax({
                    url:"static/function/toggle_computer_availability.php",
                    method:"POST",
                    data:{computer_id:computer_id,status:'<?php echo $computer['status']; ?>'},
                    dataType:"html",
                    success:function(data){
                        window.location.href = "admin-computer-view.php?id="+computer_id;
                    },
                    error:function(){
                        alert("Something went wrong");
                    }
                });
            });

            $(document).on('click', '#return-lab-btn', function() {
                var lab_id = <?php echo $lab_id; ?>;
                window.location.href = "admin-lab-view.php?id="+lab_id;
            });

            $(document).on('change', '#edit-date', getSession);

            $(document).on('change', '#time_start', getDuration);
        });

        function getSession(){
            var session_id = document.getElementById('session-id').value;
            var computer_id = <?php echo $computer_id; ?>;
            var lab_id = <?php echo $lab_id; ?>;
            var dateInput = document.getElementById('edit-date').value;
            var date = new Date(dateInput);
            var day = date.getDay();
            if(day==0 || day == 6){
                alert('Please Select a Weekday');
                document.getElementById('date').value = '';
                return;
            }
            var time_start = '<?php echo $time_open; ?>';
            var time_end = '<?php echo $time_close; ?>';
            $.ajax({
                url:"static/function/load_sessions.php",
                method:"POST",
                data:{computer_id:computer_id,date:dateInput,lab:lab_id,time_start:time_start,time_end:time_end,session_id:session_id},
                dataType:"html",
                success:function(data){
                    $("#edit-schedule-table-id").html(data);
                    document.getElementById('time_start').value = '';
                    document.getElementById("page-modal-container").style.width = '800px';
                    document.getElementById("edit-schedule-table-container").classList.remove("hidden");
                },
                error:function(){
                    alert("Something went wrong");
                }
            });
        };

        function getDuration(){
            var session_id = document.getElementById('session-id').value;
            var computer_id = <?php echo $computer_id; ?>;
            var lab_id = <?php echo $lab_id; ?>;
            var timeInput = document.getElementById('time_start').value;
            var dateInput = document.getElementById('edit-date').value;
            var time_start = '<?php echo $time_open; ?>';
            var time_end = '<?php echo $time_close; ?>';
            if(timeInput+":00" < time_start || timeInput+":00" >= time_end){
                alert('Please Select a Valid time');
                document.getElementById('time_start').value = '';
                return;
            }
            if(document.getElementById("edit-"+timeInput+":00").classList.contains('occupied')){
                alert('This time is occupied');
                document.getElementById('time_start').value = '';
                return;
            }
            timeInput+=":00";
            $.ajax({
                url:"static/function/load_reservation_durations.php",
                method:"POST",
                data:{computer_id:computer_id,date:dateInput,lab:lab_id,time_start:time_start,time_end:time_end,time:timeInput,session_id:session_id},
                dataType:"html",
                success:function(data){
                    $("#duration").html(data);
                },
                error:function(){
                    alert("Something went wrong");
                }
            });
        };

        function loadSessions(){
            var session_id = <?php echo $computer['id']; ?>;
            var computer_id = <?php echo $computer['id']; ?>;
            var lab_id = <?php echo $computer['lab']; ?>;
            var dateInput = document.getElementById('date').value;
            var date = new Date(dateInput);
            var curdate = new Date();
            console.log(curdate);
            console.log(date);
            if(curdate.getDate()==date.getDate()){
                console.log('Current Date is Weekend!');
            }
            else{
                var day = date.getDay();
                if(day==0 || day == 6){
                    alert('Please Select a Weekday');
                    document.getElementById('date').value = '';
                    return;
                }
            }
            var time_start = '<?php echo $time_open; ?>';
            var time_end = '<?php echo $time_close; ?>';
            if(dateInput != ''){
                $.ajax({
                    url:"static/function/load_sessions.php",
                    method:"POST",
                    data:{computer_id:computer_id,date:dateInput,lab:lab_id,time_start:time_start,time_end:time_end},
                    dataType:"html",
                    success:function(data){
                        $("#schedule-table-id").html(data);
                    },
                    error:function(){
                        alert("Something went wrong");
                    }
                });
                
                $.ajax({
                    url:"static/function/load_session_list.php",
                    method:"POST",
                    data:{computer_id:computer_id,date:dateInput},
                    dataType:"html",
                    success:function(data){
                        $('#lab-table').DataTable().destroy();
                        $("#session-list-body").html(data);
                        $('#lab-table').DataTable(
                            {
                                dom: 'Bfrtip',
                                buttons: [
                                    'copyHtml5',
                                    'excelHtml5',
                                    'csvHtml5',
                                    'pdfHtml5',
                                    'print',
                                ]
                            }
                        );
                    },
                    error:function(){
                        alert("Something went wrong");
                    }
                });

                $.ajax({
                    url:"static/function/load_computer_data.php",
                    method:"POST",
                    data:{computer_id:computer_id,lab:lab_id,date:dateInput,status:'<?php echo $computer['status']; ?>',time_open:time_start,time_close:time_end},
                    dataType:"html",
                    success:function(data){
                        $("#computer-info-container").html(data);
                    },
                    error:function(){
                        alert("Something went wrong");
                    }
                });
            }
        };
        
        $(document).on('change', '#time_start', function() {
            validate30Minutes('time_start');
        });
    </script>
</body>
</html>
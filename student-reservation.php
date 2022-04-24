<!DOCTYPE html>
<html lang="en">
    <head>
        <?php 
            include "static/include/head.php";
            include "static/include/table-plugin.php"; 
        ?>
        <link href="static/assets/css/list.css" rel="stylesheet">
        <link href="static/assets/css/schedule.css" rel="stylesheet">
        <title>Laboratories</title>
    </head>
    <?php
        $student_id = $_SESSION['id'];
    ?>
    <body>
        <?php
            include "static/include/navbar.php";
        ?>
        <div class="p-1 my-container active-cont">
            <div class="center-container">
                <h2>Student Reservation Management</h2>
                <h4>
                    <?php 
                        echo $_SESSION['firstname'].' '.$_SESSION['lastname'];
                    ?>
                </h4>
                <hr>
                <div class='add-btn-container'>
                    <button class='btn btn-success open-modal'>Reserve a Session</button>
                </div>
                <table id='lab-table' class='table table-striped table-hover' style='width:100%; margin-top:30px !important;'>
                    <thead class='table-dark'>
                        <tr>
                            <td class='hidden' style='width:10%;'>
                                id
                            </td>
                            <td style='width:20%;'>
                                Computer No.
                            </td>
                            <td style='width:20%;'>
                                Lab
                            </td>
                            <td style='width:20%;'>
                                Time Start
                            </td>
                            <td style='width:20%;'>
                                Time End
                            </td>
                            <td style='width:10%;'>
                                Date
                            </td>
                            <td style='width:10%;'>
                                Duration
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sessions = mysqli_query($link,"SELECT * FROM session WHERE user=$student_id");
                            if ($sessions->num_rows > 0) {
                                while($session=mysqli_fetch_array($sessions)):
                        ?>
                        <tr class='datatable-row' name='<?php echo $session['id']; ?>'>
                            <td class='hidden' style='width:10%;'>
                                id
                            </td>
                            <td style='width:20%;'>
                                <?php 
                                    $computer = $session['computer'];
                                    echo $computer;
                                 ?>
                            </td>
                            <td style='width:20%;'>
                                <?php 
                                    $record = mysqli_query($link,"SELECT * FROM computer WHERE id=$computer");
                                    $pc=mysqli_fetch_array($record);
                                    if(isset($pc)){
                                        $lab_id = $pc['lab'];
                                        $record = mysqli_query($link,"SELECT * FROM laboratory WHERE id=$lab_id");
                                        $lab = mysqli_fetch_array($record);
                                        if(isset($lab)){
                                            echo $lab['name'];
                                        }
                                    }
                                ?>
                            </td>
                            <td style='width:20%;'>
                                <?php echo $session['time_start']; ?>
                            </td>
                            <td style='width:20%;'>
                                <?php echo $session['time_end']; ?>
                            </td>
                            <td style='width:10%;'>
                                <?php echo $session['date']; ?>
                            </td>
                            <td style='width:20%;'>
                                <?php echo $session['duration']; ?>
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
            <div id="page-modal-container" class="page-modal-container" style='width:500px; height:auto; margin-bottom:80px; margin-top:40px; display:flex; align-items:center;'>
                <form class='modal-form container' method="post" action="static/function/insert_reservation.php" style='flex:60%;'>
                    <input type='hidden' name='user_id' value='<?php echo $_SESSION['id']; ?>'>
                    <input type='hidden' name='email' value='<?php echo $_SESSION['email']; ?>'>
                    <div class="row" style='margin-bottom:10px;'>
                        <h3>Create Reservation</h3>
                        <h6>You are only allowed 3 Hours Per Day</h6>
                    </div>
                    <div class="row" style='margin-bottom:10px; display:none;'>
                        <div class='col-md-10 offset-md-1 p-0'>Do you need to reserve a specific Computer?</div>
                        <div class="col-md-10 offset-md-1 p-0" style='margin-bottom:0px;'>
                            <input type="radio" id="specific-yes" name="specific" value="yes" onclick="#" checked>
                            <label for="specific-yes">Yes</label><br>
                            <input type="radio" id="specific-no" name="specific" value="no" onclick="#">
                            <label for="specific-no">No</label><br>
                        </div>
                    </div>
                    <input type='hidden' name="specific" value="yes">
                    <div class="row" style='margin-bottom:10px;' id='select-laboratory-div'>
                        <div class='col-md-10 offset-md-1 p-0'>Select Laboratory</div>
                        <div class="col-md-10 offset-md-1 p-0">
                            <select name='laboratory' id='laboratory' class='col-md-12' required>
                            </select>
                        </div>
                    </div>
                    <div class="row hidden" style='margin-bottom:10px;' id='select-computer-div'>
                        <div class='col-md-10 offset-md-1 p-0'>Select Computer</div>
                        <div class="col-md-10 offset-md-1 p-0" style='margin-bottom:5px;' id='select-computer'>
                            <select name='computer' id='computer' class='col-md-12' required>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0'>Select Date</div>
                        <input id='date' type='date' name='date' class='col-md-10 offset-md-1' style='padding-left:0px;' required>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0' style='margin-bottom:0px;'>Time Start</div>
                        <div class='col-md-10 offset-md-1 p-0' style='font-size:13px;'>Please Select 30 Minute Intervals (7:00, 7:30, 8:00, etc..)</div>
                        <input type='time' name='time_start' id='time_start' class='col-md-10 offset-md-1' style='padding-left:0px;' step='1800' required>
                    </div>
                    <div class="row" style='margin-bottom:10px;'>
                        <div class='col-md-10 offset-md-1 p-0'>Duration</div>
                        <div class="col-md-10 offset-md-1 p-0" style='margin-bottom:15px;'>
                            <select name='duration' id='duration' class='col-md-12' required>
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
                        <button type='button' class='btn btn-secondary close-modal' style='flex:0.8;'>Cancel</button><input type='submit' class='btn btn-primary' style='margin-left:20px;flex:1;' value='Add'></div>
                    </div>
                </form>
                <div id='schedule-table-container' class="row hidden" style='flex:40%;'>
                    <table id='schedule-table' >
                        <tbody id='schedule-table-id'>
                            <!-- <tr>
                                    <th>08:00</th>
                                    <td colspan="4" rowspan="2" class="stage-saturn">Welcome</td>
                                </tr>
                                <tr>
                                    <th>08:30</th>
                                </tr>
                                <tr>
                                    <th>09:00</th>
                                    <td colspan="4" class="stage-earth">Speaker One <span>Earth Stage</span></td>
                                </tr>
                                <tr>
                                    <th>09:30</th>
                                    <td colspan="4" class="stage-earth">Speaker Two <span>Earth Stage</span></td>
                                </tr>
                                <tr>
                                    <th>10:00</th>
                                    <td colspan="4" class="stage-earth">Speaker Three <span>Earth Stage</span></td>
                                </tr>
                                <tr>
                                    <th>10:30</th>
                                    <td colspan="4" class="stage-earth">Speaker Four <span>Earth Stage</span></td>
                                </tr>
                                <tr>
                                    <th>11:00</th>
                                    <td rowspan="5" class="stage-mercury">Speaker Five <span>Mercury Stage</span></td>
                                    <td rowspan="5" class="stage-venus">Speaker Six <span>Venus Stage</span></td>
                                    <td rowspan="5" class="stage-mars">Speaker Seven <span>Mars Stage</span></td>v
                                    <td rowspan="2" class="stage-saturn">Lunch</td>
                                </tr>
                                <tr>
                                    <th>11:30</th>
                                </tr>
                                <tr>
                                    <th>12:00</th>
                                    <td rowspan="3" class="stage-saturn">Break</td>
                                </tr>
                                <tr>
                                    <th>12:30</th>
                                </tr>
                                <tr>
                                    <th>13:00</th>
                                </tr>
                                <tr>
                                    <th>13:30</th>
                                    <td colspan="4" rowspan="2" class="stage-earth">Speaker Eight <span>Earth Stage</span></td>
                                </tr>
                                <tr>
                                    <th>14:00</th>
                                </tr>
                                <tr>
                                    <th>14:30</th>
                                    <td colspan="4" rowspan="8" class="stage-saturn">Break</td>
                                </tr>
                                <tr>
                                    <th>15:00</th>
                                </tr>
                                <tr>
                                    <th>15:30</th>
                                </tr>
                                <tr>
                                    <th>16:00</th>
                                </tr>
                                <tr>
                                    <th>16:30</th>
                                </tr>
                                <tr>
                                    <th>17:00</th>
                                </tr>
                                <tr>
                                    <th>17:30</th>
                                </tr>
                                <tr>
                                    <th>18:00</th>
                                </tr>
                                <tr>
                                    <th>18:30</th>
                                    <td colspan="4" class="stage-earth">Speaker Nine <span>Earth Stage</span></td>
                                </tr>
                                <tr>
                                    <th>19:00</th>
                                    <td colspan="2" rowspan="2" class="stage-earth">Speaker Ten <span>Earth Stage</span></td>
                                    <td colspan="2" rowspan="2" class="stage-jupiter">Speaker Eleven <span>Jupiter Stage</span></td>
                                </tr>
                                <tr>
                                    <th>19:30</th>
                                </tr>
                                <tr>
                                    <th>20:00</th>
                                    <td colspan="2" class="stage-mars">Speaker Twelve <span>Mars Stage</span></td>
                                    <td class="stage-jupiter">Speaker Thirteen <span>Jupiter Stage</span></td>
                                    <td class="stage-jupiter">Speaker Fourteen <span>Jupiter Stage</span></td>
                                </tr>
                                <tr>
                                    <th>20:30</th>
                                    <td colspan="4" rowspan="2" class="stage-saturn">Drinks</td>
                                </tr>
                                    <tr>
                                    <th>21:00</th>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php 
            include "static/include/scripts.php";
            include "static/include/table-scripts.php";
        ?>
        <script src="static/assets/js/modal.js"></script>
        <script>
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
            }
        </script>
        <script>
            $(document).ready(function (){
                $.ajax({
                    url:"static/function/load_labs.php",
                    method:"POST",
                    data:{},
                    dataType:"html",
                    success:function(data){
                        document.getElementById('select-laboratory-div').classList.remove('hidden');
                        $("#laboratory").html(data);
                        resetForm();
                    },
                    error:function(){
                        alert("Something went wrong");
                    }
                });
                $(document).on('click', '#specific-yes', function() {
                    return;
                });

                
                $(document).on('click', '#specific-no', function() {
                    document.getElementById('select-laboratory-div').classList.add('hidden');
                    document.getElementById('select-computer-div').classList.add('hidden');
                    resetForm();
                });

                $(document).on('change', '#laboratory', function() {
                    var lab_id = document.getElementById('laboratory').value;
                    if(lab_id!=''){
                        $.ajax({
                            url:"static/function/load_computers.php",
                            method:"POST",
                            data:{lab_id:lab_id,},
                            dataType:"html",
                            success:function(data){
                                document.getElementById('select-computer-div').classList.remove('hidden');
                                $("#select-computer").html(data);
                            },
                            error:function(){
                                alert("Something went wrong");
                            }
                        });
                    }
                    else{
                        document.getElementById('select-computer-div').classList.add('hidden');
                        $("#computer").empty();
                    }
                    resetForm();
                });

                $(document).on('change', '#computer', function() {
                    resetForm();
                });

                $(document).on('change', '#date', function() {
                    if ($('input[id=specific-yes]:checked').length == 0) {
                        return;
                    }
                    var computer_id = document.getElementById('computer').value;
                    if(computer_id != ''){
                        var lab_id = document.getElementById('laboratory').value;
                        var dateInput = document.getElementById('date').value;
                        var date = new Date(dateInput);
                        var day = date.getDay();
                        if(day==0 || day == 6){
                            alert('Please Select a Weekday');
                            document.getElementById('date').value = '';
                            return;
                        }
                        var time_start = document.getElementById('lab_time_start').value;
                        var time_end = document.getElementById('lab_time_end').value;
                        $.ajax({
                            url:"static/function/load_sessions.php",
                            method:"POST",
                            data:{computer_id:computer_id,date:dateInput,lab:lab_id,time_start:time_start,time_end:time_end},
                            dataType:"html",
                            success:function(data){
                                $("#schedule-table-id").html(data);
                                document.getElementById('time_start').value = '';
                                document.getElementById("page-modal-container").style.width = '800px';
                                document.getElementById("schedule-table-container").classList.remove("hidden");
                            },
                            error:function(){
                                alert("Something went wrong");
                            }
                        });
                    }
                    else{
                        alert('Please Select A Computer');
                        document.getElementById('date').value = '';
                    }
                });

                $(document).on('change', '#time_start', function() {
                    if ($('input[id=specific-yes]:checked').length == 0) {
                        return;
                    }
                    var computer_id = document.getElementById('computer').value;
                    if(computer_id != ''){
                        var lab_id = document.getElementById('laboratory').value;
                        var timeInput = document.getElementById('time_start').value;
                        var dateInput = document.getElementById('date').value;
                        var time_start = document.getElementById('lab_time_start').value;
                        var time_end = document.getElementById('lab_time_end').value;
                        if(timeInput+":00" < time_start || timeInput+":00" >= time_end){
                            alert('Please Select a Valid time');
                            document.getElementById('time_start').value = '';
                            return;
                        }
                        if(document.getElementById(timeInput+":00").classList.contains('occupied')){
                            alert('This time is occupied');
                            document.getElementById('time_start').value = '';
                            return;
                        }
                        timeInput+=":00";
                        $.ajax({
                            url:"static/function/load_reservation_durations.php",
                            method:"POST",
                            data:{computer_id:computer_id,date:dateInput,lab:lab_id,time_start:time_start,time_end:time_end,time:timeInput,student_id:<?php echo $student_id; ?>},
                            dataType:"html",
                            success:function(data){
                                $("#duration").html(data);
                            },
                            error:function(){
                                alert("Something went wrong");
                            }
                        });
                    }
                    else{
                        alert('Please Select A Computer');
                        document.getElementById('time_start').value = '';
                    }
                });

                function resetForm(){
                    document.getElementById('date').value = '';
                    document.getElementById('time_start').value = '';
                    document.getElementById("schedule-table-container").classList.add("hidden");
                    document.getElementById("page-modal-container").style.width = '500px';
                }
            });
        </script>
    </body>
</html>
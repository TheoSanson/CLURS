<!DOCTYPE html>
<html lang="en">
    <head>
        <?php 
            include "static/include/head.php";
            include "static/include/table-plugin.php"; 
        ?>
        <link href="static/assets/css/list.css" rel="stylesheet">
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
        <div class="page-modal">
            <div class="page-modal-container" style='width:500px; height:auto;'>
                <form class='modal-form container' method="post" action="static/function/insert_class_session.php">
                    <input type='hidden' name='user_id' value='<?php echo $_SESSION['id']; ?>'>
                    <div class="row" style='margin-bottom:10px;'>
                        <h3>Create Reservation</h3>
                    </div>
                    <div class="row" style='margin-bottom:10px;'>
                        <div class='col-md-10 offset-md-1 p-0'>Do you need to reserve a specific Computer?</div>
                        <div class="col-md-10 offset-md-1 p-0" style='margin-bottom:0px;'>
                            <input type="radio" id="specific-yes" name="specific" value="yes" onclick="#">
                            <label for="specific-yes">Yes</label><br>
                            <input type="radio" id="specific-no" name="specific" value="no" onclick="#">
                            <label for="specific-no">No</label><br>
                        </div>
                    </div>
                    <div class="row" style='margin-bottom:10px;'>
                        <div class='col-md-10 offset-md-1 p-0'>Select Laboratory</div>
                        <div class="col-md-10 offset-md-1 p-0">
                            <select name='occurrence' id='occurrence' class='col-md-12'>
                                <option value='daily'>Daily</option>
                                <option value='weekly'>Weekly</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" style='margin-bottom:10px;'>
                        <div class='col-md-10 offset-md-1 p-0'>Select Computer</div>
                        <div class="col-md-10 offset-md-1 p-0" style='margin-bottom:5px;'>
                            <select name='occurrence' id='occurrence' class='col-md-12'>
                                <option value='daily'>Daily</option>
                                <option value='weekly'>Weekly</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0'>Select Date</div>
                        <input type='date' name='date' class='col-md-10 offset-md-1' style='padding-left:0px;'>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0'>Time Start</div>
                        <input type='time' name='time_start' class='col-md-10 offset-md-1' style='padding-left:0px;'>
                    </div>
                    <div class="row" style='margin-bottom:10px;'>
                        <div class='col-md-10 offset-md-1 p-0'>Duration</div>
                        <div class="col-md-10 offset-md-1 p-0" style='margin-bottom:15px;'>
                            <select name='occurrence' id='occurrence' class='col-md-12' disabled>
                                <option value='daily'>Daily</option>
                                <option value='weekly'>Weekly</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0' style='display:flex; margin-top:20px;'>
                        <button type='button' class='btn btn-secondary close-modal' style='flex:0.8;'>Cancel</button><input type='submit' class='btn btn-primary' style='margin-left:20px;flex:1;' value='Add'></div>
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
                alert('Hello World');
            });
        </script>
    </body>
</html>
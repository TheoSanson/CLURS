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
                <hr>
                <div class='add-btn-container'>
                    <button class='btn btn-success open-modal'>Add New Class Schedule</button>
                    <button class='btn btn-secondary' id='manage-session-btn' name='<?php echo $lab_id; ?>'>Manage Computers</button>
                </div>
                <table id='lab-table' class='table table-striped table-hover' style='width:100%; margin-top:30px !important;'>
                    <thead class='table-dark'>
                        <tr>
                            <td class='hidden' style='width:10%;'>
                                id
                            </td>
                            <td style='width:40%;'>
                                Schedule Description
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
                            $sessions = mysqli_query($link,"SELECT * FROM class_session WHERE lab=$lab_id AND repeat_id IS NULL");
                            if ($sessions->num_rows > 0) {
                                while($session=mysqli_fetch_array($sessions)):
                        ?>
                        <tr class='datatable-row' name='<?php echo $session['id']; ?>'>
                            <td class='hidden' style='width:10%;'>
                                id
                            </td>
                            <td style='width:40%;'>
                                <?php echo $session['description']; ?>
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
            <div class="page-modal-container" style='width:500px; height:660px;'>
                <form class='modal-form container' method="post" action="static/function/insert_class_session.php">
                    <input type='hidden' name='lab_id' value='<?php echo $lab_id; ?>'>
                    <div class="row">
                        <h3>Create Laboratory</h3>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0'>Session Description</div>
                        <input type='text' name='session_desc' class='col-md-10 offset-md-1' style='padding-left:0px;'>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0'>Date</div>
                        <input type='date' name='date' class='col-md-10 offset-md-1' style='padding-left:0px;'>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0'>Time Start</div>
                        <input type='time' name='time_start' class='col-md-10 offset-md-1' style='padding-left:0px;'>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0'>Time End</div>
                        <input type='time' name='time_end' class='col-md-10 offset-md-1' style='padding-left:0px;'>
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
                            <input type='date' name='repeat-end' id='repeat-end' class='col-md-12' disabled>
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
    </body>
</html>
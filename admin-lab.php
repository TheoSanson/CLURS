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
    <body>
        <?php
            include "static/include/navbar.php";
        ?>
        <div class="p-1 my-container active-cont">
            <div class="center-container">
                <h2>Laboratory Management</h2>
                <hr>
                <div class='add-btn-container'>
                    <button class='btn btn-success open-modal'>Add New Laboratory</button>
                </div>
                <table id='lab-table' class='table table-striped table-hover' style='width:100%; margin-top:30px !important;'>
                    <thead class='table-dark'>
                        <tr>
                            <td class='hidden' style='width:10%;'>
                                id
                            </td>
                            <td style='width:20%;'>
                                Room Name
                            </td>
                            <td style='width:10%;'>
                                Total Seats
                            </td>
                            <td style='width:30%;'>
                                Status
                            </td>
                            <td style='width:35%;'>
                                Remarks
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <tr>
                            <td class='hidden' style='width:10%;'>
                                id
                            </td>
                            <td style='width:20%;'>
                                Room Name
                            </td>
                            <td style='width:15%;'>
                                Total Seats
                            </td>
                            <td style='width:30%;'>
                                Status
                            </td>
                            <td style='width:35%; position:relative !important;'>
                                Remarks
                                <div class="row-btn-containers">
                                    <button class='btn btn-success'>Manage</button>
                                </div>
                            </td>
                        </tr> -->
                        <?php
                            $labs = mysqli_query($link,"SELECT * FROM laboratory");
                            if ($labs->num_rows > 0) {
                                while($lab=mysqli_fetch_array($labs)):
                        ?>
                        <tr class='datatable-row' name='<?php echo $lab['id']; ?>'>
                            <td class='hidden' style='width:10%;'>
                                <?php echo $lab['id']; ?>
                            </td>
                            <td style='width:20%;'>
                            <?php echo $lab['name']; ?>
                            </td>
                            <td style='width:15%;'>
                                <?php echo $lab['total_seats']; ?>
                            </td>
                            <td style='width:30%;'>
                            <?php 
                                $status = '';
                                $time = date('H:i:s');
                                if($lab['time_open'] < $time || $lab['time_close'] > $time){
                                    echo 'Closed';
                                }
                                else{
                                    echo 'Open';
                                } 
                            ?>
                            </td>
                            <td style='width:35%; position:relative !important;'>
                                <?php echo $lab['remarks']; ?>
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
            <div class="page-modal-container" style='width:500px; height:520px;'>
                <form class='modal-form container' method="post" action="static/function/insert_lab.php">
                    <div class="row">
                        <h3>Create Laboratory</h3>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0'>Lab Room Name</div>
                        <input type='text' name='labname' class='col-md-10 offset-md-1 p-1'>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0'>Time Opened</div>
                        <input type='time' name='time_open' class='col-md-10 offset-md-1 p-1'>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0'>Time Closed</div>
                        <input type='time' name='time_close' class='col-md-10 offset-md-1 p-1'>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0'>Initial No. of PCs</div>
                        <input type='number' name='pc-qty' class='col-md-10 offset-md-1 p-1'>
                    </div>
                    <div class="row">
                        <div class='col-md-10 offset-md-1 p-0' style='display:flex; margin-top:20px;'><button type='button' class='btn btn-secondary close-modal' style='flex:0.8;'>Cancel</button><input type='submit' class='btn btn-primary' style='margin-left:20px;flex:1;' value='Add'></div>
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
            $(document).on('click', '.datatable-row', function() {
                var id = $(this).attr('name');
                window.location.href = "admin-lab-view.php?id="+id;
            });
        </script>
    </body>
</html>
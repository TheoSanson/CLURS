<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "static/include/head.php"; ?>
    <link href="static/assets/css/computers.css" rel="stylesheet">
    <title>Document</title>
</head>
<?php
    $lab_id = $_REQUEST['id'];
?>
<body>
    <?php include "static/include/navbar.php"; ?>
    <div class="p-1 my-container active-cont">
        <div class="center-container">
            <h2>Laboratory Manager</h2>
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
            <h4 style='margin-bottom:10px;'> Computers </h4>
            <div class='add-btn-container' style='margin-bottom:10px;'>
                <button class='btn btn-success open-modal'>Add New Computer</button>
                <button class='btn btn-secondary' id='manage-session-btn' name='<?php echo $lab_id; ?>'>Manage Sessions</button>
            </div>
            <div class="computers-container">
                <div class="card-group" id='computer-card-group'>
                    <!-- Computers Displayed Here -->
                </div>
            </div>
        </div>
    </div>
    <div class="page-modal" id='0'>
        <div class="page-modal-container" style='width:500px;'>
            <form class='modal-form container' method="post" action="static/function/insert_computers.php">
                <input type='hidden' name='lab_id' value='<?php echo $lab_id; ?>'>
                <div class="row">
                    <h3>Add Computers</h3>
                </div>
                <div class="row">
                    <div class='col-md-10 offset-md-1 p-0'>No. of PCs to Add</div>
                    <input type='number' name='pc-qty' class='col-md-10 offset-md-1 p-1'>
                </div>
                <div class="row">
                    <div class='col-md-10 offset-md-1 p-0' style='display:flex; margin-top:20px;'><button type='button' class='btn btn-secondary close-modal' style='flex:0.8;'>Cancel</button><input type='submit' class='btn btn-primary' style='margin-left:20px;flex:1;' value='Add'></div>
                </div>
            </form>
        </div>
    </div>
    <div class="page-modal" id='1'>
        <div class="page-modal-container" style='width:500px;'>
            <div class='modal-form container' id='computer-info-container'>
                <!-- Load Computer Info here -->
            </div>
        </div>
    </div>
    <?php include "static/include/scripts.php"; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script>
        $(document).ready(function (){
            loadComputers();
            nextTime();

            $(document).on('click', '#manage-session-btn', function() {
                var id = $(this).attr('name');
                window.location.href = "admin-class.php?id="+id;
            });

            var now = new Date();
            var millisTill10 = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 10, 0, 0, 0) - now;
            if (millisTill10 < 0) {
                millisTill10 += 86400000; // it's after 10am, try 10am tomorrow.
            }
            setTimeout(function(){alert("It's 10am!")}, millisTill10);

            
            $(document).on('click', '.open-modal-2', function() {
                let computer_id = $(this).attr('id');
                let computer_status = $(this).attr('name');
                $.ajax({
                    url:"static/function/load_computer.php",
                    method:"POST",
                    data:{computer_id:computer_id,lab_id:'<?php echo $lab_id; ?>',status:computer_status}, //CHANGE REMARKS TO VARIABLE STATUS SIMILAR/BASED ON IMAGE
                    dataType:"html",
                    success:function(data){
                        $("#computer-info-container").html(data);
                    },
                    error:function(){
                        alert("Something went wrong");
                    }
                });
                openModal(1);
                return 0;
            });

            $(document).on('click', '.close-modal-2', function() {
                closeModal(1);
                return 0;
            });

            $(document).on('click', '.manage-pc-btn', function() {
                let computer_id = $(this).attr('id');
                window.location.href = "admin-computer-view.php?id="+computer_id;
            });

        });

        function loadComputers(){
            console.log('computersLoaded!');
            $.ajax({
                url:"static/function/load_lab_computers.php",
                method:"POST",
                data:{lab_id:<?php echo $lab_id; ?>,time_open:'<?php echo $lab['time_open']; ?>',time_close:'<?php echo $lab['time_close']; ?>',},
                dataType:"html",
                success:function(data){
                    $("#computer-card-group").html(data);
                },
                error:function(){
                    alert("Something went wrong");
                }
            });
        };

        function nextTime(){
            const start = moment();
            const remainder = 30 - (start.minute() % 30);
            const dateTime = moment(start).add(remainder, "minutes").format("DD.MM.YYYY, h:mm:ss a");
            console.log(remainder);
            milliseconds = (remainder*60)*1000;
            console.log(milliseconds);
            setTimeout(function(){
                loadComputers();
                setInterval(() => {
                    loadComputers();
                }, 30 * 60 * 1000);
            }, milliseconds);
        };
    </script>
    <script src="static/assets/js/modal.js"></script>
    <script>
    </script>
</body>
</html>
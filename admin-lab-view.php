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
                <div class="card-group">
                    <?php
                        $computers = mysqli_query($link,"SELECT * FROM computer WHERE lab=$lab_id");
                        if ($computers->num_rows > 0) {
                            while($computer=mysqli_fetch_array($computers)):
                    ?>
                    <div class="card computer-card">
                        <div class="card-body pc-card-body">
                            <h6 class="card-title" style='margin:auto; margin:0px 0px 2px 0px;'>PC-<?php echo $computer['id']; ?></h6>
                            <img src="static/assets/img/pc-off.png" class='pc-icon'>
                            <button class='btn btn-generic computer-btn'>Manage</button>
                        </div>
                    </div>
                    <?php
                            endwhile;
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="page-modal">
        <div class="page-modal-container" style='width:600px; height:700px;'>
            Hello World
        </div>
    </div>
    <?php include "static/include/scripts.php"; ?>
    <script>
        $(document).on('click', '#manage-session-btn', function() {
            var id = $(this).attr('name');
            window.location.href = "admin-class.php?id="+id;
        });
    </script>
</body>
</html>
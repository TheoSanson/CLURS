<<?php
    include 'database.php';
    $lab_id = $_POST['lab_id'];
    $pc_qty = $_POST['pc-qty'];
    for($i = 0; $i < $pc_qty; $i++){
        mysqli_query($link,"INSERT INTO computer(vacancy,status,remarks,lab) VALUES('Vacant','Available','',$lab_id)");
    }
    echo "<script>
        window.location.href = '../../admin-lab-view.php?id='+$lab_id;
    </script>";
?>
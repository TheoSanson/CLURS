<?php

    include "database.php";

    $computer_id = $_POST['computer_id'];
    $computer_status = $_POST['status'];

    if($computer_status == 'Available'){
        mysqli_query($link,"UPDATE computer SET status='Unavailable' WHERE id=$computer_id");
    }
    else {
        mysqli_query($link,"UPDATE computer SET status='Available' WHERE id=$computer_id");
    }

?>
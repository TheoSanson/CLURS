<?php
    include "database.php";
    $session_id = $_POST['session-id'];
    $computer_id = $_POST['computer-id'];
    mysqli_query($link,"DELETE FROM session WHERE id=$session_id");
    echo "<script>
        window.location.href = '/clurs/admin-computer-view.php?id='+$computer_id;
    </script>";
?>
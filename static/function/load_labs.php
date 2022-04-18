<?php
    include "database.php";
    $labs = mysqli_query($link,"SELECT * FROM laboratory");
    echo "<option value=''>-----</option>";
    while($lab=mysqli_fetch_array($labs)):
        $lab_id = $lab['id'];
        $lab_name = $lab['name'];
        echo "
        <option value='$lab_id'>$lab_name</option>
        ";
    endwhile;
?>
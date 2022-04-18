<?php
    include "database.php";
    $lab_id = $_POST['lab_id'];
    $computers = mysqli_query($link,"SELECT * FROM computer WHERE lab=$lab_id");
    echo "<select name='computer' id='computer' class='col-md-12'>";
    echo "<option value=''>-----</option>";
    while($computer=mysqli_fetch_array($computers)):
        $computer = $computer['id'];
        echo "
            <option value='$computer'>PC-$computer</option>
        ";
    endwhile;
    echo "</select>";
    $record = mysqli_query($link,"SELECT * FROM laboratory WHERE id=$lab_id");
    $lab = mysqli_fetch_array($record);
    if(isset($lab)){
        $start = $lab['time_open'];
        $end = $lab['time_close'];
        echo "<input type='hidden' name='lab_time_start' id='lab_time_start' value='$start'>";
        echo "<input type='hidden' name='lab_time_end' id='lab_time_end' value='$end'>";
    }
?>
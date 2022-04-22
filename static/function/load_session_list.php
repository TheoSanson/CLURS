<?php
    include "database.php";
    $computer_id = $_POST['computer_id'];
    $date = $_POST['date'];
    $curdate = date('Y-m-d');

    $sessions = mysqli_query($link,"SELECT * FROM session WHERE computer=$computer_id AND date='$date'");
    if ($sessions->num_rows > 0) {
        if($date < $curdate){
            while($session=mysqli_fetch_array($sessions)):
                echo "<tr class='datatable-row' name='".$session['id']."'>
                    <td class='hidden' style='width:10%;'>
                        id
                    </td>
                    <td style='width:40%;' id='td-user-".$session['id']."'>";
                            $user_record = mysqli_query($link,"SELECT * FROM user WHERE id=".$session['user']);
                            $user=mysqli_fetch_array($user_record);
                            if(isset($user)){
                                echo $user['firstname']." ".$user['lastname'];
                            }
                    echo "</td>
                    <td style='width:20%;' id='td-start-".$session['id']."'>
                        ".date('H:i',strtotime($session['time_start']))."
                    </td>
                    <td style='width:20%;' id='td-end-".$session['id']."'>
                        ".date('H:i',strtotime($session['time_end']))."
                    </td>
                    <td style='width:20%; position:relative;' id='td-duration-".$session['id']."'>
                        ".$session['duration']."
                        <div class='row-btn-containers' style='align-items:center; position:absolute; right:0px;'>
                            <button class='btn btn-danger row-edit-btn open-delete-modal' name='".$session['id']."'><i class='bx bx-trash-alt'></i></button>
                        </div>
                    </td>
                </tr>";
            endwhile;
        }
        else{
            while($session=mysqli_fetch_array($sessions)):
                echo "<tr class='datatable-row' name='".$session['id']."'>
                    <td class='hidden' style='width:10%;'>
                        ".$session['id']."
                    </td>
                    <td style='width:40%;' id='td-user-".$session['id']."'>";
                            $user_record = mysqli_query($link,"SELECT * FROM user WHERE id=".$session['user']);
                            $user=mysqli_fetch_array($user_record);
                            if(isset($user)){
                                echo $user['firstname']." ".$user['lastname'];
                            }
                    echo "</td>
                    <td style='width:20%;' id='td-start-".$session['id']."'>
                        ".date('H:i',strtotime($session['time_start']))."
                    </td>
                    <td style='width:20%;' id='td-end-".$session['id']."'>
                        ".date('H:i',strtotime($session['time_end']))."
                    </td>
                    <td style='width:20%; position:relative;' id='td-duration-".$session['id']."'>
                        ".$session['duration']."
                        <div class='row-btn-containers' style='align-items:center; position:absolute; right:0px;'>
                            <button class='btn btn-primary row-edit-btn open-edit-modal' name='".$session['id']."' style='margin-right:2px'><i class='bx bx-clipboard'></i></button>
                            <button class='btn btn-danger row-edit-btn open-delete-modal' name='".$session['id']."'><i class='bx bx-trash-alt'></i></button>
                        </div>
                    </td>
                </tr>";
            endwhile;
        }
    }
<?php # include "static/function/authenticate.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        include "static/include/head.php";
        include "static/function/authenticateAdmin.php";
    ?>
    <link href="static/assets/css/dashboard.css" rel="stylesheet">
    <title>Dashboard</title>
</head>
<body>
    <?php include "static/include/navbar.php"; ?>
    
    <?php 
        $query = mysqli_query($link,"SELECT * FROM session WHERE DATE(date_set) = CURDATE()");
        $reservations_created_today = $query->num_rows;
        $query = mysqli_query($link,"SELECT * FROM session WHERE date = CURDATE()");
        $reservations_today = $query->num_rows;
        $query = mysqli_query($link,"SELECT * FROM user WHERE access_level = 0");
        $students = $query->num_rows;
        $query = mysqli_query($link,"SELECT * FROM class_session WHERE date = CURDATE() AND time_start < TIME(NOW()) AND time_end > TIME(NOW())");
        $classes = $query->num_rows;
        $query = mysqli_query($link,"SELECT * FROM laboratory WHERE time_open < TIME(NOW()) AND time_close > TIME(NOW())");
        $labs_open = $query->num_rows;
        $query = mysqli_query($link,"SELECT * FROM laboratory");
        $labs = $query->num_rows;
        $query = mysqli_query($link,"SELECT * FROM computer WHERE status='Unavailable'");
        $pcs_unavailable = $query->num_rows;
        $query = mysqli_query($link,"SELECT * FROM computer");
        $pcs = $query->num_rows;
        // $computer=mysqli_fetch_array($record);
        // if(isset($computer)){
        //     $computer_id = $computer['id'];
        //     $lab_id = $computer['lab'];
        // }
    ?>
    <div class="p-1 my-container active-cont">
        <div class="center-container container" style='background-color:transparent; box-shadow:none;'>
            <div class="row g-2">
                <div class="col-md-6 col-lg-3">
                    <div class="dashboard-module dashboard-module-sm">
                        <div class="dashboard-label">
                            Reservations Created Today
                        </div>
                        <div class="dashboard-value">
                            <?php echo $reservations_created_today; ?>
                        </div>
                    </div> 
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="dashboard-module dashboard-module-sm">
                        <div class="dashboard-label">
                            Reservations For Today
                        </div>
                        <div class="dashboard-value">
                            <?php echo $reservations_today; ?>
                        </div>
                    </div> 
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="dashboard-module dashboard-module-sm">
                        <div class="dashboard-label">
                            Student Users Registered
                        </div>
                        <div class="dashboard-value">
                            <?php echo $students; ?>
                        </div>
                    </div> 
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="dashboard-module dashboard-module-sm">
                        <div class="dashboard-label">
                            Class Sessions Ongoing
                        </div>
                        <div class="dashboard-value">
                            <?php echo $classes; ?>
                        </div>
                    </div> 
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="dashboard-module dashboard-module-lg">
                        <canvas id="pie" style="max-height:100%; max-width:100%;"></canvas>
                    </div> 
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="dashboard-module dashboard-module-lg">
                        <canvas id="bar" style="max-height:100%; max-width:100%;"></canvas>
                    </div> 
                </div>
                <div class="col-md-12 col-lg-12">
                    <div class="dashboard-module dashboard-module-lg">
                        <canvas id="plots" style="width:100%;max-width:100%; max-height:100%;"></canvas>
                    </div> 
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="dashboard-module dashboard-module-sm">
                        <div class="dashboard-label">
                            Computer Labs Currently Open
                        </div>
                        <div class="dashboard-value">
                            <?php echo $labs_open; ?>
                        </div>
                    </div> 
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="dashboard-module dashboard-module-sm">
                        <div class="dashboard-label">
                            Total Laboratories
                        </div>
                        <div class="dashboard-value">
                            <?php echo $labs; ?>
                        </div>
                    </div> 
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="dashboard-module dashboard-module-sm">
                        <div class="dashboard-label">
                            Computers Unavailable
                        </div>
                        <div class="dashboard-value">
                            <?php echo $pcs_unavailable; ?>
                        </div>
                    </div> 
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="dashboard-module dashboard-module-sm">
                        <div class="dashboard-label">
                            Total Computers
                        </div>
                        <div class="dashboard-value">
                            <?php echo $pcs; ?>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
    <?php include "static/include/scripts.php"; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        // Get the HTML canvas by its id 
        plots = document.getElementById("plots");
        pie = document.getElementById("pie");
        bar = document.getElementById("bar");

        // Example datasets for X and Y-axes 
        <?php
            $days = [];
            $sessions = [];
            $dayindex = 0;
            for($i = 0; $i < 7; $i++){
                $sessions_count = mysqli_query($link,"SELECT * FROM session WHERE date = CURDATE() + INTERVAL $dayindex DAY");
                $day = mysqli_fetch_array(mysqli_query($link,"SELECT DAYNAME(CURDATE() + INTERVAL $dayindex DAY) AS week_day"));
                if($day['week_day'] == 'Saturday' || $day['week_day'] == 'Sunday' ){
                    $i--;
                }
                else {
                    $days[$i] = $day['week_day'];
                    $sessions[$i] = mysqli_num_rows($sessions_count);
                }
                $dayindex++;
            }
        ?>
        var days = [<?php for($i = 0; $i < 7; $i++){ echo '\''.$days[$i].'\''.','; } ?>]; //Stays on the X-axis 
        var sales = [<?php for($i = 0; $i < 7; $i++){ echo $sessions[$i].','; } ?>] //Stays on the Y-axis 

        // Create an instance of Chart object:
        new Chart(plots, {
                options: {
                    plugins:{
                        title:{
                            display:true,
                            text: 'Amount of Reservations for the next 7 weekdays',
                        },
                    },
                },
                type: 'line', //Declare the chart type 
                data: {
                labels: days, //X-axis data 
                datasets: [{
                    label:'Reservations',
                    data: sales, //Y-axis data 
                    backgroundColor: '#003300',
                    borderColor: 'black',
                    tension: 0.3,
                    fill: false, //Fills the curve under the line with the babckground color. It's true by default
                }]
            },
        });
        <?php
            $sql = mysqli_query($link,"SELECT * FROM session WHERE duration=30");
            $duration_1=mysqli_num_rows($sql);
            $sql = mysqli_query($link,"SELECT * FROM session WHERE duration=60");
            $duration_2=mysqli_num_rows($sql);
            $sql = mysqli_query($link,"SELECT * FROM session WHERE duration=90");
            $duration_3=mysqli_num_rows($sql);
            $sql = mysqli_query($link,"SELECT * FROM session WHERE duration=120");
            $duration_4=mysqli_num_rows($sql);
            $sql = mysqli_query($link,"SELECT * FROM session WHERE duration=150");
            $duration_5=mysqli_num_rows($sql);
            $sql = mysqli_query($link,"SELECT * FROM session WHERE duration=180");
            $duration_6=mysqli_num_rows($sql);
        ?>
        new Chart(pie, {
                options: {
                    plugins:{
                        title:{
                            display:true,
                            text: 'Session Duration Distribution',
                        },
                    },
                },
                type: 'doughnut', //Declare the chart type 
                data: {
                labels: [
                    '30 Minutes',
                    '1 Hour',
                    '1 Hr 30 Mins',
                    '2 Hours',
                    '2 Hrs 30 Mins',
                    '3 Hours',
                ],
                datasets: [{
                    label:'Carts',
                    data:[<?php echo $duration_1.",".$duration_2.",".$duration_3.",".$duration_4.",".$duration_5.",".$duration_6; ?>],
                    backgroundColor: [
                        'rgb(102, 204, 0)',
                        'rgb(191, 255, 0)',
                        'rgb(250, 255, 0)',
                        'rgb(230, 140, 0)',
                        'rgb(230, 100, 0)',
                        'rgb(160, 0, 0)',
                    ],
                    borderColor: 'black',
                    fill: false, //Fills the curve under the line with the babckground color. It's true by default
                }]
            },
        });

        <?php
            $day_sessions_count = [];
            $days_count = [
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday'
            ];
            for($i = 0; $i < 5; $i++){
                $sessions_count = mysqli_query($link,"SELECT * FROM session WHERE DAYNAME(date) = '".$days_count[$i]."'");
                $day_sessions_count[$i] = mysqli_num_rows($sessions_count);
            }
        ?>
        new Chart(bar, {
                options: {
                    plugins:{
                        title:{
                            display:true,
                            text: 'Session Duration Distribution',
                        },
                    },
                },
                type: 'bar', //Declare the chart type 
                data: {
                labels: [<?php for($i = 0; $i < 5; $i++){ echo '\''.$days_count[$i].'\','; } ?>],
                datasets: [{
                    label:'Sessions',
                    data:[<?php for($i = 0; $i < 5; $i++){ echo '\''.$day_sessions_count[$i].'\''.','; } ?>],
                    backgroundColor: [
                        'rgb(0, 128, 0)',
                    ],
                    borderColor: 'black',
                    fill: false, //Fills the curve under the line with the babckground color. It's true by default
                }]
            },
        });
    </script>
</body>
</html>
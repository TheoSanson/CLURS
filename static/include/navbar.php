<div class="wrapper">
    <nav>
        <div class="sidebar-top">
            <span class="shrink-btn">
                <i class="bx bx-chevron-left"></i>
            </span>
            <img src="./static/assets/img/logo.png" class="logo" alt="">
            <h3 class="hide">ICS ComLabs</h3>
        </div>
        <div class="search">
            <i class="bx bx-search"></i>
            <input type="text" class="hide" placeholder="Quick Search ...">
        </div>
        <div class="sidebar-links">
            <ul>
            <?php
                $activeIndex = 0;  
                if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
                    $url = "https://";   
                else  
                    $url = "http://";   
                // Append the host(domain name, ip) to the URL.   
                $url.= $_SERVER['HTTP_HOST'];   
                
                // Append the requested resource location to the URL   
                $url.= $_SERVER['REQUEST_URI'];
            ?>   
            <div class="active-tab"></div>
            <?php if($_SESSION['access_level'] == 0){ ?>
            <li class="tooltip-element" data-tooltip="0">
                <a href="student-reservation.php" <?php if(strpos($url, 'student-reservation.php')) { echo "class='active'"; $activeIndex = 0; }?> data-active="0">
                    <div class="icon">
                        <i class='bx bx-home-alt-2'></i>
                        <i class='bx bxs-home-alt-2' ></i>
                    </div>
                    <span class="link hide">Home</span>
                </a>
            </li>
            <li class="tooltip-element" data-tooltip="1">
                <a href="/CLURS/account.php" <?php if(strpos($url, 'account.php')) { echo "class='active'"; $activeIndex = 1; }?> data-active="1">
                <div class="icon">
                    <i class='bx bxs-user-account'></i>
                    <i class='bx bxs-user-account'></i>
                </div>
                <span class="link hide">Account Management</span>
                </a>
            </li>
            <div class="tooltip">
                <!-- Specify Any Additional Tooltips! -->
                <span class="show">Home</span>
                <span>Account Mgmt</span>
            </div>
            <?php } 
                else { ?>
            <li class="tooltip-element" data-tooltip="0">
                <a href="/CLURS/admin-lab.php" <?php if(strpos($url, 'admin-dashboard.php')) { echo "class='active'"; $activeIndex = 0; }?> data-active="0">
                    <div class="icon">
                        <i class="bx bx-tachometer"></i>
                        <i class="bx bxs-tachometer"></i>
                    </div>
                    <span class="link hide">Dashboard</span>
                </a>
            </li>
            <li class="tooltip-element" data-tooltip="1">
                <a href="/CLURS/admin-lab.php" <?php if(strpos($url, 'admin-lab') || strpos($url, 'admin-class.php')) { echo "class='active'"; $activeIndex = 1; }?> data-active="1">
                <div class="icon">
                    <i class='bx bx-desktop'></i>
                    <i class='bx bx-desktop'></i>
                </div>
                <span class="link hide">Lab Management</span>
                </a>
            </li>
            <li class="tooltip-element" data-tooltip="2">
                <a href="/CLURS/admin-staff.php" <?php if(strpos($url, 'admin-staff.php')) { echo "class='active'"; $activeIndex = 2; }?> data-active="2">
                <div class="icon">
                    <i class='bx bx-user' ></i>
                    <i class='bx bx-user' ></i>
                </div>
                <span class="link hide">Admin User Mgmt.</span>
                </a>
            </li>
            <li class="tooltip-element" data-tooltip="3">
                <a href="/CLURS/admin-student.php" <?php if(strpos($url, 'admin-student.php')) { echo "class='active'"; $activeIndex = 3; }?> data-active="3">
                <div class="icon">
                    <i class='bx bxs-user-badge' ></i>
                    <i class='bx bxs-user-badge' ></i>
                </div>
                <span class="link hide">Student User Mgmt.</span>
                </a>
            </li>
            <li class="tooltip-element" data-tooltip="4">
                <a href="/CLURS/account.php" <?php if(strpos($url, 'account.php')) { echo "class='active'"; $activeIndex = 4; }?> data-active="4">
                <div class="icon">
                    <i class='bx bxs-user-account'></i>
                    <i class='bx bxs-user-account'></i>
                </div>
                <span class="link hide">Account Management</span>
                </a>
            </li>
            <div class="tooltip">
                <!-- Specify Any Additional Tooltips! -->
                <span class="show">Dashboard</span>
                <span>Lab Mgmt.</span>
                <span>Admin Mgmt.</span>
                <span>Student Mgmt.</span>
                <span>Account Mgmt.</span>
            </div>
            <?php } ?>
            </ul>
            <!--
            <h4 class="hide">Shortcuts</h4>
            <ul>
            <li class="tooltip-element" data-tooltip="0">
                <a href="#" data-active="5">
                <div class="icon">
                    <i class="bx bx-notepad"></i>
                    <i class="bx bxs-notepad"></i>
                </div>
                <span class="link hide">Tasks</span>
                </a>
            </li>
            <li class="tooltip-element" data-tooltip="1">
                <a href="#" data-active="6">
                <div class="icon">
                    <i class="bx bx-help-circle"></i>
                    <i class="bx bxs-help-circle"></i>
                </div>
                <span class="link hide">Help</span>
                </a>
            </li>
            <li class="tooltip-element" data-tooltip="2">
                <a href="#" data-active="7">
                <div class="icon">
                    <i class="bx bx-cog"></i>
                    <i class="bx bxs-cog"></i>
                </div>
                <span class="link hide">Settings</span>
                </a>
            </li>
            <div class="tooltip">
                <span class="show">Tasks</span>
                <span>Help</span>
                <span>Settings</span>
            </div>
            </ul> -->
        </div>
        <div class="sidebar-footer">
            <a href="#" class="account tooltip-element" data-tooltip="0">
            <i class="bx bx-user"></i>
            </a>
            <div class="admin-user tooltip-element" data-tooltip="1">
            <div class="admin-profile hide">
                <img src="./static/assets/img/face-1.png" alt="">
                <div class="admin-info">
                <h3><?php echo $_SESSION['user']; ?></h3>
                <h5>Admin</h5>
                </div>
            </div>
            <a href="static/function/logout.php" class="log-out">
            <i class="bx bx-log-out"></i>
            </a>
            </div>
            <div class="tooltip">
            <span class="show"><?php echo $_SESSION['user']; ?></span>
            <span>Logout</span>
            </div>
        </div>
    </nav>
</div>
<input type="hidden" id='activeIndex' value='<?php echo $activeIndex;?>'>
<div class="wrapper" style='position:sticky;'>
</div>
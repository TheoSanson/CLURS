<?php
    include "database.php";
    session_unset();
    session_destroy();
    echo "	<script type='text/javascript'>
                window.location='/clurs/login.php';
            </script>";
?>
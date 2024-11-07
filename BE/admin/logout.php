<?php
    session_start();
    session_destroy();
    header('Location: /tianguis/app/admin/login.php');
?>
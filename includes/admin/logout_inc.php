<?php
    session_start();

    include '../../config/db.php';

    if(isset($_POST['logout_btn'])) {
        session_unset();

        session_destroy();

        $success_msg = "You are logged out";
        $encoded_success_msg = urlencode($success_msg);
        header("location: ../../admin/login.php?error=$encoded_success_msg");
        exit();
    }
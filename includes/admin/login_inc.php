<?php
    session_start();

    include '../../config/db.php';


    if(isset($_POST['login_btn'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(empty($email) || empty($password)) {
            $error_msg = "All fields must be filled";
            $encoded_error_msg = urlencode($error_msg);
            header("location: ../../admin/login.php?error=$encoded_error_msg");
            exit();
        }else {
            $fetch_user = "SELECT * FROM `admins` WHERE `email` = ?";
            $stmt = $connect->prepare($fetch_user);

            $stmt->bind_param('s', $email);

            $stmt->execute();

            $result = $stmt->get_result();
            $fetch = $result->fetch_assoc();

            if(!$fetch > 0) {
                $error_msg = "This is not a user";
                $encoded_error_msg = urlencode($error_msg);
                header("location: ../../admin/login.php?error=$encoded_error_msg");
                exit();
            }elseif(!password_verify($password, $fetch['password'])) {
                $error_msg = "Incorrect Email or password";
                $encoded_error_msg = urlencode($error_msg);
                header("location: ../../admin/login.php?error=$encoded_error_msg");
                exit();
            }else{
                $_SESSION['id'] = $fetch['id'];

                //Save the history in the history table
                $action = "New Login Session";
                
                $add_history = "INSERT INTO `history` (`action`) VALUES(?)";
                $stmt = $connect->prepare($add_history);

                $stmt->bind_param('s', $action);

                $stmt->execute();

                $success_msg = "You are Logined";
                $encoded_success_msg = urlencode($success_msg);
                header("location: ../../admin/analytics.php?error=$encoded_success_msg");
                exit();

            }

        }
    }

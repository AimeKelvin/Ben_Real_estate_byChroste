<?php
    include '../../config/db.php';

    if(isset($_POST['register_btn'])) {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];
        $full_name = $_POST['full_name'];
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);

        //check if the user name is two words
        $words = explode(" ", $full_name);


        //check if  email is  unique
        $fetch = "SELECT * FROM `admins` WHERE `email` = ?";
        $stmt = $connect->prepare($fetch);
        $stmt->bind_param('s', $email);


        $stmt->execute();

        $result = $stmt->get_result();
        $fetch_user = $result->fetch_assoc();

        if(empty($email) || empty($password) || empty($full_name)) {
            $error_msg = "All fields must be filled";
            $encoded_error_msg = urlencode($error_msg);
            header("location: ../../admin/register.php?error=$encoded_error_msg");
            exit();
        }elseif(count($words) !== 2) {
            $error_msg = "Username must be two words";
            $encoded_error_msg = urlencode($error_msg);
            header("location: ../../admin/register.php?error=$encoded_error_msg");
            exit();
        }elseif(!preg_match('/^[a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
            $error_msg = "Invalid email";
            $encoded_error_msg = urlencode($error_msg);
            header("location: ../../admin/register.php?error=$encoded_error_msg");
            exit();
        }elseif(strlen($email) > 200){
            $error_msg = "Email too long";
            $encoded_error_msg = urlencode($error_msg);
            header("location: ../../admin/register.php?error=$encoded_error_msg");
            exit();
        }elseif($fetch_user['email'] === $email){
            $error_msg = "Email already used";
            $encoded_error_msg = urlencode($error_msg);
            header("location: ../../admin/register.php?error=$encoded_error_msg");
            exit();
        }else{

            $insert = "INSERT INTO `admins`(`email`, `password`, `full_name`) VALUES(?,?,?)";

            $stmt = $connect->prepare($insert);

            $stmt->bind_param('sss', $email, $hashed_pass, $full_name);

            $stmt->execute();



            //check if registered
            if($stmt->affected_rows > 0 ) {
                $success_msg = "You are registered";
                $encoded_success_msg = urlencode($success_msg);
                header("location: ../../admin/login.php?error=$encoded_success_msg");
                exit();
            }else{
                $error_msg = "Something went wrong";
                $encoded_error_msg = urlencode($error_msg);
                header("location: ../../admin/register.php?error=$encoded_error_msg");
                exit();
            }


            //close statement
            $stmt->close();
        }

        
    }

<?php
    include '../../config/db.php';


    //add the feedback in db
    if(isset($_POST['send_btn'])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $subject = $_POST["subject"];
        $message = $_POST["msg"];

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_msg = "Invalid email !";
            $encoded_msg = urlencode($error_msg);
            header(" ../../contact.php?msg_error=$encoded_msg");
            exit();
        }elseif(empty($name) || empty($email) || empty($subject) || empty($message)) {
            $error_msg = "Fill all fields";
            $encoded_error_msg = urlencode($error_msg);
            header("location: ../../contact.php?error=$encoded_error_msg");
            exit();
        }else {

            $send_msg = "INSERT INTO `feedback` (`name`, `email`, `subject`, `message`) VALUES(?,?,?,?)";
            $stmt = $connect->prepare($send_msg);

            $stmt->bind_param('ssss', $name, $email, $subject, $message);

            $stmt->execute();

            if($stmt->affected_rows > 0 ) {
                $success_msg = "You message is sent";
                $encoded_success_msg = urlencode($success_msg);
                header("location: ../../contact.php?error=$encoded_success_msg");
                exit();
            }else{
                $error_msg = "Something went wrong";
                $encoded_error_msg = urlencode($error_msg);
                header("location: ../../contact.php?error=$encoded_error_msg");
                exit();
            }

        }

        
        
    }

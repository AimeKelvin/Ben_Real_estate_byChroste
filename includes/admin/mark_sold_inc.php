<?php
    include '../../config/db.php';

    if(isset($_POST['mark_sold_btn'])) {
        $price = $_POST['price'];
        

        $insert_sale = "INSERT INTO `sales` (`price`) VALUES(?)";

        $stmt = $connect->prepare($insert_sale);

        $stmt->bind_param('s' , $price);

        //execute
        $stmt->execute();

        if($stmt->affected_rows > 0) {
            //Save the history in the history table
            $action = "New Sale Made";
            
            $add_history = "INSERT INTO `history` (`action`) VALUES(?)";
            $stmt = $connect->prepare($add_history);

            $stmt->bind_param('s', $action);

            $stmt->execute();

            $success_msg = "New Sale Added";
            $encoded_success_msg = urlencode($success_msg);
            header("location: ../../admin/analytics.php?error=$encoded_success_msg");
            exit();
        }else{
            $error_msg = "Something went wrong";
            $encoded_error_msg = urlencode($error_msg);
            header("location: ../../admin/analytics.php?error=$encoded_error_msg");
            exit();
        }

        $stmt->close();
        
    }


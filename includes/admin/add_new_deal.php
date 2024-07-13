<?php
    include '../../config/db.php';


    if(isset($_POST['send_deal_btn'])) {
        $phone = $_POST['phone'];
        $name = $_POST['name'];
        $listing_name = $_POST['listing_name'];

        if(empty($phone) || empty($name)) {
            $error_msg = "All fields must be filled";
            $encoded_error_msg = urlencode($error_msg);
            header("location: ../../properties.php?error=$encoded_error_msg");
            exit();
        }else{
                
                $add_deal = "INSERT INTO `deals` (`phone`, `name`, `listing`) VALUES(?,?,?)";
                $stmt = $connect->prepare($add_deal);

                $stmt->bind_param('sss', $phone,$name, $listing_name);

                $stmt->execute();

                $success_msg = "Your is Deal Made";
                $encoded_success_msg = urlencode($success_msg);
                header("location: ../../properties.php?success=$encoded_success_msg");
                exit();

        }

    }


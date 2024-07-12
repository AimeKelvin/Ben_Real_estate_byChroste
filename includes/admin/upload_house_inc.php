<?php
    include '../../config/db.php';

    if(isset($_POST['add_house_btn'])) {
        $house_title = filter_var($_POST['house_title'], FILTER_SANITIZE_SPECIAL_CHARS);
        $house_price = $_POST['price'];
        $number_rooms = $_POST['number_rooms'];
        $house_des = $_POST['description'];
        $number_bed_rooms = $_POST['number_bed_rooms'];
        $house_status = $_POST['status'];

        $total_files = count($_FILES['house_image']['name']);
        $files_array = array();

        //loop over them
        for($i = 0; $i < $total_files; $i++) {
            $image_name = $_FILES['house_image']['name'][$i];
            $tmp_name = $_FILES['house_image']['tmp_name'][$i];

            $image_ext = explode('.', $image_name);
            $image_ext = strtolower(end($image_ext));

            $new_img_name = uniqid() . '.' . $image_ext;

            move_uploaded_file($tmp_name, 'uploaded_houses/' . $new_img_name);
            //push them to files array
            $files_array[] = $new_img_name;
        }

        $files_array = json_encode($files_array);
   
        if(empty($house_title) || empty($house_price) || empty($number_rooms) || empty($house_des) || empty($number_bed_rooms) || empty($house_status)) {
            $error_msg = "Fill all fields please";
            $encoded_error_msg = urlencode($error_msg);
            header("location: ../../admin/houses/create.php?error=$encoded_error_msg");
            exit();
        }else {
            $insert_house = "INSERT INTO `houses` (`house_title`,`house_price`, `house_des`, `number_rooms`, `number_bedrooms`, `status`, `images`) VALUES(?,?,?,?,?,?,?)";

            $stmt = $connect->prepare($insert_house);
 
            $stmt->bind_param('sssssss' , $house_title, $house_price, $house_des,  $number_rooms, $number_bed_rooms, $house_status, $files_array);

            //execute
            $stmt->execute();

            if($stmt->affected_rows > 0) {
                //Save the history in the history table
                $action = "New Listing Added";
                
                $add_history = "INSERT INTO `history` (`action`) VALUES(?)";
                $stmt = $connect->prepare($add_history);

                $stmt->bind_param('s', $action);

                $stmt->execute();

                $success_msg = "New Listing Added";
                $encoded_success_msg = urlencode($success_msg);
                header("location: ../../admin/houses/create.php?error=$encoded_success_msg");
                exit();
            }else{
                $error_msg = "Something went wrong";
                $encoded_error_msg = urlencode($error_msg);
                header("location: ../../admin/houses/create.php?error=$encoded_error_msg");
                exit();
            }

            $stmt->close();
        }
    }
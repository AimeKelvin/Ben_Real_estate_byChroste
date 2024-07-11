<?php
    include '../../config/db.php';

    if(isset($_POST['add_car_btn'])) {
        $car_name = filter_var($_POST['car_name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $car_price = $_POST['price'];
        $kilometres = $_POST['kilometres'];
        $car_des = $_POST['description'];
        $car_status = $_POST['status'];

        $total_files = count($_FILES['car_image']['name']);
        $files_array = array();

        //loop over them
        for($i = 0; $i < $total_files; $i++) {
            $image_name = $_FILES['car_image']['name'][$i];
            $tmp_name = $_FILES['car_image']['tmp_name'][$i];

            $image_ext = explode('.', $image_name);
            $image_ext = strtolower(end($image_ext));

            $new_img_name = uniqid() . '.' . $image_ext;

            move_uploaded_file($tmp_name, 'uploaded_cars/' . $new_img_name);
            //push them to files array
            $files_array[] = $new_img_name;
        }

        $files_array = json_encode($files_array);
   
        if(empty($car_name) || empty($car_price) || empty($kilometres) || empty($car_des) || empty($car_status)) {
            $error_msg = "Fill all fields please";
            $encoded_error_msg = urlencode($error_msg);
            header("location: ../../admin/cars/create.php?error=$encoded_error_msg");
            exit();
        }else {
            $insert_car = "INSERT INTO `cars` (`car_name`,`car_price`, `kilometres`, `description`, `status`, `images`) VALUES(?,?,?,?,?,?)";

            $stmt = $connect->prepare($insert_car);
 
            $stmt->bind_param('ssssss' , $car_name, $car_price, $kilometres, $car_des, $car_status, $files_array);

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
                header("location: ../../admin/cars/create.php?error=$encoded_success_msg");
                exit();
            }else{
                $error_msg = "Something went wrong";
                $encoded_error_msg = urlencode($error_msg);
                header("location: ../../admin/cars/create.php?error=$encoded_error_msg");
                exit();
            }

            $stmt->close();
        }
    }

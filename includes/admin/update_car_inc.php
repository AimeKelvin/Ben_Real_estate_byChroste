<?php
    include '../../config/db.php';

    if(isset($_POST['update_car_btn'])) {
        $car_name = filter_var($_POST['car_name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $car_price = $_POST['price'];
        $kilometres = $_POST['kilometres'];
        $car_des = $_POST['description'];
        $car_status = $_POST['status'];
        $location = $_POST['location'];
        $car_id = $_POST['id'];
        $total_files = count($_FILES['car_image']['name']);
        $files_array = array();

        // Check if no image is chosen
        if ($total_files == 1 && empty($_FILES['car_image']['name'][0])) {
            $error_msg = "Choose at least one image";
            $encoded_error_msg = urlencode($error_msg);
            header("location: ../../admin/cars/single_listing_car.php?id=$car_id&error=$encoded_error_msg");
            exit();
        }

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
   
        if(empty($car_name) || empty($car_price) || empty($kilometres) || empty($car_des) || empty($car_status) || empty($location)) {
            $error_msg = "Fill all fields please";
            $encoded_error_msg = urlencode($error_msg);
            header("location: ../../admin/cars/single_listing_car.php?id=$car_id&error=$encoded_error_msg");
            exit();
        }else {
            $update_query = "UPDATE `cars` SET `car_name`=?, `car_price`=?,  `kilometres`=?,  `description`=?, `status`=?,  `images`=?, `location`=? WHERE `id` = ?";
            $stmt = $connect->prepare($update_query);

            $stmt->bind_param('ssssssss', $car_name, $car_price, $kilometres, $car_des, $car_status, $files_array, $location, $car_id);

            $stmt->execute();

            if($stmt->affected_rows > 0) {
                move_uploaded_file($profile_img_tmp, $profile_img_directory);
                $success_msg = "Listing updated";
                $encoded_success_msg = urlencode($success_msg);
                header("location: ../../admin/cars/single_listing_car.php?id=$car_id&success=$encoded_success_msg");
                exit();
            }else{
                $error_msg = "Something went wrong";
                $encoded_error_msg = urlencode($error_msg);
                header("location: ../../admin/cars/single_listing_car.php?id=$house_id&error=$encoded_error_msg");
                exit();
            }

            $stmt->close();
        }
        
       
    }


    //delete house
    
    if(isset($_POST['delete_listing_btn'])) {
        $car_id = $_POST['id'];

        // Retrieve the images from the database
        $select_query = "SELECT images FROM cars WHERE id = ?";
        $stmt = $connect->prepare($select_query);
        $stmt->bind_param('i', $car_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $car = $result->fetch_assoc();
        $stmt->close();

        if($car) {
            // Decode the images JSON
            $images = json_decode($car['images'], true);

            // Delete each image from the server
            foreach($images as $image) {
                $file_path = 'uploaded_cars/' . $image;
                if(file_exists($file_path)) {
                    unlink($file_path);
                }
            }
        } 

        $delete_query = "DELETE FROM `cars` WHERE `id` = ?";
        $stmt = $connect->prepare($delete_query);

        $stmt->bind_param('i', $car_id);
        $stmt->execute();

        if($stmt->affected_rows > 0) {
            session_unset();
            session_destroy();
            $success_msg = "Listing is deleted";
            $encoded_success_msg = urlencode($success_msg);
            header("location: ../../admin/cars/create.php?success=$encoded_success_msg");
            exit();

        }

        $stmt->close();
        
    }

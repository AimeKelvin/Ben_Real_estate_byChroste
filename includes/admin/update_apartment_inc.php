<?php
    include '../../config/db.php';

    if(isset($_POST['update_apartment_btn'])) {
        $apartment_title = filter_var($_POST['apartment_title'], FILTER_SANITIZE_SPECIAL_CHARS);
        $apartment_price = $_POST['price'];
        $number_rooms = $_POST['number_rooms'];
        $apartment_des = $_POST['description'];
        $number_bed_rooms = $_POST['number_bed_rooms'];
        $apartment_status = $_POST['status'];

        $apartment_id = $_POST['id'];

        $total_files = count($_FILES['apartment_image']['name']);
        $files_array = array();

        // Check if no image is chosen
        if ($total_files == 1 && empty($_FILES['apartment_image']['name'][0])) {
            $error_msg = "Choose at least one image";
            $encoded_error_msg = urlencode($error_msg);
            header("location: ../../admin/apartments/single_listing_apartment.php?id=$apartment_id&error=$encoded_error_msg");
            exit();
        }

        //loop over them
        for($i = 0; $i < $total_files; $i++) {
            $image_name = $_FILES['apartment_image']['name'][$i];
            $tmp_name = $_FILES['apartment_image']['tmp_name'][$i];

            $image_ext = explode('.', $image_name);
            $image_ext = strtolower(end($image_ext));

            $new_img_name = uniqid() . '.' . $image_ext;

            move_uploaded_file($tmp_name, 'uploaded_apartments/' . $new_img_name);
            //push them to files array
            $files_array[] = $new_img_name;
        }

        $files_array = json_encode($files_array);
   
        if(empty($apartment_title) || empty($apartment_price) || empty($number_rooms) || empty($apartment_des) || empty($number_bed_rooms) || empty($apartment_status)) {
            $error_msg = "Fill all fields please";
            $encoded_error_msg = urlencode($error_msg);
            header("location: ../../admin/apartments/single_listing_apartment.php?id=$apartment_id&error=$encoded_error_msg");
            exit();
        }else {
            $update_query = "UPDATE `apartments` SET `apartment_title`=?, `apartment_price`=?,  `apartment_des`=?,  `number_rooms`=?, `number_bedrooms`=?, `status`=?,  `images`=? WHERE `id` = ?";
            $stmt = $connect->prepare($update_query);

            $stmt->bind_param('ssssssss', $apartment_title, $apartment_price, $apartment_des,  $number_rooms, $number_bed_rooms, $apartment_status, $files_array, $apartment_id);

            $stmt->execute();

            if($stmt->affected_rows > 0) {
                move_uploaded_file($profile_img_tmp, $profile_img_directory);
                $success_msg = "Listing updated";
                $encoded_success_msg = urlencode($success_msg);
                header("location: ../../admin/apartments/single_listing_apartment.php?id=$apartment_id&success=$encoded_success_msg");
                exit();
            }else{
                $error_msg = "Something went wrong";
                $encoded_error_msg = urlencode($error_msg);
                header("location: ../../admin/apartments/single_listing_apartment.php?id=$apartment_id&error=$encoded_error_msg");
                exit();
            }

            $stmt->close();
        }
        
       
    }


    //delete house
    
    if(isset($_POST['delete_listing_btn'])) {
        $apartment_id = $_POST['id'];

        // Retrieve the images from the database
        $select_query = "SELECT images FROM apartments WHERE id = ?";
        $stmt = $connect->prepare($select_query);
        $stmt->bind_param('i', $apartment_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $apartment = $result->fetch_assoc();
        $stmt->close();

        if($apartment) {
            // Decode the images JSON
            $images = json_decode($apartment['images'], true);

            // Delete each image from the server
            foreach($images as $image) {
                $file_path = 'uploaded_apartments/' . $image;
                if(file_exists($file_path)) {
                    unlink($file_path);
                }
            }
        } 

        $delete_query = "DELETE FROM `apartments` WHERE `id` = ?";
        $stmt = $connect->prepare($delete_query);

        $stmt->bind_param('i', $apartment_id);
        $stmt->execute();

        if($stmt->affected_rows > 0) {
            session_unset();
            session_destroy();
            $success_msg = "Listing is deleted";
            $encoded_success_msg = urlencode($success_msg);
            header("location: ../../admin/apartments/create.php?success=$encoded_success_msg");
            exit();

        }

        $stmt->close();
        
    }

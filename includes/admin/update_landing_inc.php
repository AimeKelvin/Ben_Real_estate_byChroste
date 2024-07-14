<?php
    include '../../config/db.php';

    if(isset($_POST['update_landing_btn'])) {
        $landing_title = filter_var($_POST['landing_title'], FILTER_SANITIZE_SPECIAL_CHARS);
        $landing_price = $_POST['price'];
        $size = $_POST['size'];
        $landing_des = $_POST['description'];
        $location = $_POST['location'];
        $landing_id = $_POST['id'];

        $total_files = count($_FILES['landing_image']['name']);
        $files_array = array();

        // Check if no image is chosen
        if ($total_files == 1 && empty($_FILES['landing_image']['name'][0])) {
            $error_msg = "Choose at least one image";
            $encoded_error_msg = urlencode($error_msg);
            header("location: ../../admin/landings/single_listing_landing.php?id=$landing_id&error=$encoded_error_msg");
            exit();
        }

        //loop over them
        for($i = 0; $i < $total_files; $i++) {
            $image_name = $_FILES['landing_image']['name'][$i];
            $tmp_name = $_FILES['landing_image']['tmp_name'][$i];

            $image_ext = explode('.', $image_name);
            $image_ext = strtolower(end($image_ext));

            $new_img_name = uniqid() . '.' . $image_ext;

            move_uploaded_file($tmp_name, 'uploaded_landings/' . $new_img_name);
            //push them to files array
            $files_array[] = $new_img_name;
        }

        $files_array = json_encode($files_array);

        if(empty($landing_title) || empty($landing_price) || empty($size) || empty($landing_des) || empty($location)) {
            $error_msg = "Fill all fields please";
            $encoded_error_msg = urlencode($error_msg);
            header("location: ../../admin/landings/single_listing_landing.php?id=$landing_id&error=$encoded_error_msg");
            exit();
        }else {
            $update_query = "UPDATE `landings` SET `landing_title`=?, `landing_price`=?,  `landing_des`=?,  `landing_size`=?,  `images`=?, `location`=? WHERE `id` = ?";
            $stmt = $connect->prepare($update_query);

            $stmt->bind_param('sssssss', $landing_title, $landing_price, $landing_des, $size, $files_array, $location, $landing_id);

            $stmt->execute();

            if($stmt->affected_rows > 0) {
                move_uploaded_file($profile_img_tmp, $profile_img_directory);
                $success_msg = "Listing updated";
                $encoded_success_msg = urlencode($success_msg);
                header("location: ../../admin/landings/single_listing_landing.php?id=$landing_id&success=$encoded_success_msg");
                exit();
            }else{
                $error_msg = "Something went wrong";
                $encoded_error_msg = urlencode($error_msg);
                header("location: ../../admin/landings/single_listing_landing.php?id=$landing_id&error=$encoded_error_msg");
                exit();
            }

            $stmt->close();
        }
        
       
    }


    //delete landing
    
    if(isset($_POST['delete_listing_btn'])) {
        $landing_id = $_POST['id'];

        // Retrieve the images from the database
        $select_query = "SELECT images FROM landings WHERE id = ?";
        $stmt = $connect->prepare($select_query);
        $stmt->bind_param('i', $landing_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $house = $result->fetch_assoc();
        $stmt->close();

        if($house) {
            // Decode the images JSON
            $images = json_decode($house['images'], true);

            // Delete each image from the server
            foreach($images as $image) {
                $file_path = 'uploaded_landings/' . $image;
                if(file_exists($file_path)) {
                    unlink($file_path);
                }
            }
        } 

        $delete_query = "DELETE FROM `landings` WHERE `id` = ?";
        $stmt = $connect->prepare($delete_query);

        $stmt->bind_param('i', $landing_id);
        $stmt->execute();

        if($stmt->affected_rows > 0) {
            session_unset();
            session_destroy();
            $success_msg = "Listing is deleted";
            $encoded_success_msg = urlencode($success_msg);
            header("location: ../../admin/landings/create.php?error=$encoded_success_msg");
            exit();

        }

        $stmt->close();
        
    }


    //mark as sold
    if(isset($_POST['mark_sold_btn'])) {
        $price = $_POST['price'];
        $landing_id = $_POST['landing_id'];

        

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

            //then delete the listing
            $select_query = "SELECT images FROM `landings` WHERE id = ?";
            $stmt = $connect->prepare($select_query);
            $stmt->bind_param('i', $landing_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $apartment = $result->fetch_assoc();
            

            if($apartment) {
                // Decode the images JSON
                $images = json_decode($apartment['images'], true);

                // Delete each image from the server
                foreach($images as $image) {
                    $file_path = 'uploaded_landings/' . $image;
                    if(file_exists($file_path)) {
                        unlink($file_path);
                    }
                }
            } 

            $delete_query = "DELETE FROM `landings` WHERE `id` = ?";
            $stmt = $connect->prepare($delete_query);

            $stmt->bind_param('i', $landing_id);
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

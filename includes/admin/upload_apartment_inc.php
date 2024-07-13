<?php
    include '../../config/db.php';

    if(isset($_POST['add_apartment_btn'])) {
        $apartment_title = filter_var($_POST['apartment_title'], FILTER_SANITIZE_SPECIAL_CHARS);
        $apartment_price = $_POST['price'];
        $number_rooms = $_POST['number_rooms'];
        $location = $_POST['location'];
        $apartment_des = $_POST['description'];
        $number_bed_rooms = $_POST['number_bed_rooms'];
        $apartment_status = $_POST['status'];

        $total_files = count($_FILES['apartment_image']['name']);
        $files_array = array();

        // Check if no image is chosen
        if ($total_files == 1 && empty($_FILES['apartment_image']['name'][0])) {
            $error_msg = "Choose at least one image";
            $encoded_error_msg = urlencode($error_msg);
            header("location: ../../admin/apartments/create.php?error=$encoded_error_msg");
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
   
        if(empty($apartment_title) || empty($apartment_price) || empty($number_rooms) || empty($apartment_des) || empty($number_bed_rooms) || empty($apartment_status || empty($location ))) {
            $error_msg = "Fill all fields please";
            $encoded_error_msg = urlencode($error_msg);
            header("location: ../../admin/apartments/create.php?error=$encoded_error_msg");
            exit();
        }else {
            $insert_apartment = "INSERT INTO `apartments` (`apartment_title`,`apartment_price`, `apartment_des`, `number_rooms`, `number_bedrooms`, `status`, `images`, `location`) VALUES(?,?,?,?,?,?,?,?)";

            $stmt = $connect->prepare($insert_apartment);
 
            $stmt->bind_param('ssssssss' , $apartment_title, $apartment_price, $apartment_des,  $number_rooms, $number_bed_rooms, $apartment_status, $files_array, $location );

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
                header("location: ../../admin/apartments/create.php?success=$encoded_success_msg");
                exit();
            }else{
                $error_msg = "Something went wrong";
                $encoded_error_msg = urlencode($error_msg);
                header("location: ../../admin/apartments/create.php?error=$encoded_error_msg");
                exit();
            }

            $stmt->close();
        }
    }

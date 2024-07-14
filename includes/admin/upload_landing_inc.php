<?php
    include '../../config/db.php';

    if(isset($_POST['add_landing_btn'])) {
        $landing_title = filter_var($_POST['landing_title'], FILTER_SANITIZE_SPECIAL_CHARS);
        $landing_price = $_POST['price'];
        $size = $_POST['size'];
        $landing_des = $_POST['description'];
        $location = $_POST['location'];

        $total_files = count($_FILES['landing_image']['name']);
        $files_array = array();

        // Check if no image is chosen
        if ($total_files == 1 && empty($_FILES['landing_image']['name'][0])) {
            $error_msg = "Choose at least one image";
            $encoded_error_msg = urlencode($error_msg);
            header("location: ../../admin/landings/create.php?error=$encoded_error_msg");
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
            header("location: ../../admin/landings/create.php?error=$encoded_error_msg");
            exit();
        }else {
            $insert_house = "INSERT INTO `landings` (`landing_title`,`landing_price`, `landing_des`, `landing_size`, `images`, `location`) VALUES(?,?,?,?,?,?)";

            $stmt = $connect->prepare($insert_house);
 
            $stmt->bind_param('ssssss' , $landing_title, $landing_price, $landing_des,  $size, $files_array, $location);

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
                header("location: ../../admin/landings/create.php?success=$encoded_success_msg");
                exit();
            }else{
                $error_msg = "Something went wrong";
                $encoded_error_msg = urlencode($error_msg);
                header("location: ../../admin/landings/create.php?error=$encoded_error_msg");
                exit();
            }

            $stmt->close();
        }
    }

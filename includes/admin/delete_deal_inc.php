<?php
    include "../../config/db.php";

    if(isset($_POST['delete_deal_btn'])) {
        $deal_id = $_POST['deal_id'];

        $delete_history = "DELETE FROM `deals` WHERE `id` = ?";
        $stmt = $connect->prepare($delete_history);

        $stmt->bind_param('i', $deal_id);
        $stmt->execute();

        if($stmt->affected_rows > 0) {

            $success_msg = "You deleted one deal";
            $encoded_success_msg = urlencode($success_msg);
            header("location: ../../admin/manage.php?success=$encoded_success_msg");
            exit();

        }

        $stmt->close();
    }

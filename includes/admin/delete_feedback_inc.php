<?php
    include "../../config/db.php";

    if(isset($_POST['delete_feedback_btn'])) {
        $feedback_id = $_POST['feedback_id'];

        $delete_history = "DELETE FROM `feedback` WHERE `id` = ?";
        $stmt = $connect->prepare($delete_history);

        $stmt->bind_param('i', $feedback_id);
        $stmt->execute();

        if($stmt->affected_rows > 0) {

            $success_msg = "You deleted one feedback";
            $encoded_success_msg = urlencode($success_msg);
            header("location: ../../admin/analytics.php?success=$encoded_success_msg");
            exit();

        }

        $stmt->close();
    }


<?php
    include "../../config/db.php";

    if(isset($_POST['delete_history_btn'])) {
        $history_id = $_POST['history_id'];

        $delete_history = "DELETE FROM `history` WHERE `id` = ?";
        $stmt = $connect->prepare($delete_history);

        $stmt->bind_param('i', $history_id);
        $stmt->execute();

        if($stmt->affected_rows > 0) {

            $success_msg = "You deleted one history";
            $encoded_success_msg = urlencode($success_msg);
            header("location: ../../admin/history.php?success=$encoded_success_msg");
            exit();

        }

        $stmt->close();
    }

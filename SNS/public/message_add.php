<?php
try {
    $date = new DateTime();
    $date->setTimeZone(new DateTimeZone('Asia/Tokyo'));

    $message_text = $_POST['text'];
    $message_image = $_FILES['image'];
    $user_id = $_SESSION['user_id'];
    $destination_user_id = $_POST['destination_user_id'];

    if($message_text == '') {
        set_flash('danger', 'メッセージ内容が未入力です');
        reload();
    }

    if($message_image['size'] > 0) {
        if($message_image['size'] > 1000000) {
            set_flash('danger', '画像が大きすぎます');
            reload();
        } else {
            move_uploaded_file($message_image['tmp_name'], './image/'.$message_image['name']);
        }
    }
}

?>
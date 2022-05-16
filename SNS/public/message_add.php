<?php
try {
    $date = new DateTime();
    $date->setTimeZone(new DateTimeZone('Asia/Tokyo'));

    $message_text = $_POST['text'];
    $message_image = $_FILES['image'];
    $user_id = $_SESSION['user_id'];
    $destination_user_id
}

?>
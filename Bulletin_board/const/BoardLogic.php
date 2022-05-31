<?php

class BoardLogic {
public static function createBoard($boardDate) {

    $result = false;
    $sql = 'INSERT INTO message (message, post_date) VALUES(?, ?)';

    $arr = [];
    $arr = $boardDate['message'];
    $arr = $boardDate['post_date'];

    try {
        $stmt = connect()->prepare($sql);
        $result = $stmt->execute($arr);

        return $result;
    } catch(\Exception $e) {
        echo $e;
    }
}
}

?>

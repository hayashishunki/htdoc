<?php
//投稿内容保存
require_once '../dbconect.php';

class PostLogic {
    public static function createPostBox($postDate) {
        $result = false;
        $sql = 'INSERT INTO postBox (post) VALUES(?)';

        $arr = [];
        $arr[] = $postDate['post'];

        try {
            $stmt = connect()->prepare($sql);
            $result = $stmt->execute($arr);

            return $result;
        } catch (\Exception $e) {
            echo $e;
        }
    }
}


?>

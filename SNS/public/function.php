<?php       //get_user、get_messages関数で情報を取得。

function get_user($user_id) {
    try {
        $dsn = 'mysql:dbname=db;host=localhost;charset=utf8';
        $user = 'hayshi';
        $password = 'hayashi';
        $dbh = new PDO($dsn, $user, $password);
        $sql = "SELECT id, name, password, profile, image
                FROM user
                WHERE id = :id AND delete_flg = 0";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':id' => $user_id));
        return $stmt->fetch();
    } catch (\Exception $e) {
        error_log('エラー発生:'.$e->getMessage());
        set_flash('error',ERR_MSG1);//フラッシュ変数は、一度だけ使用されることを意図したセッション変数
    }
}

function get_messages($user_id, $destination_user_id) {
    try {
        //データベース接続
        $dsn = 'mysql:dbname=db;host=localhost;charset=utf8';
        $user = 'hayshi';
        $password = 'hayashi';
        $dbh = new PDO($dsn, $user, $password);
        //テーブルからユーザーIDと送信先ユーザーのIDを引数にして情報を取得
        $sql = "SELECT *
                FROM message
                WHERE (user_id = :id and destination_user_id = :destination_user_id) or (user_id = :destination_user_id and destination_user_id = :id)
                ORDER BY created_at ASK";

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':id' => $user_id,
                             ':destination_user_id' => $destination_user_id));
        return $stmt->fetchALL();
    } catch (\Exception $e) {
        error_log('エラー発生:'.$e->getMessage());
        set_flash('error', ERR_MSG1);
    }
}
?>
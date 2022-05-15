<?php       //データベース接続設定
require_once('env.php'); //サーバー設定のを読み込む

function connect()
{
    $host = DB_HOST;
    $db = DB_NAME;
    $user = DB_USER;
    $pass = DB_PASS;

    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

    try { //db接続の確認
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //エラーのモードを決める
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC //配列をキーとvalueで返す
        ]);
        return $pdo;
    } catch (PDOException $e) {
        echo '接続失敗です！' . $e->getMessage(); //エラーメッセージ受け取り
        exit(); //ここで終わりです
    }
}

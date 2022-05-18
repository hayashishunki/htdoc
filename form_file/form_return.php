<?php
// //お問合せ内容をメールで受け取る
session_start();

//トークンが入ってるかまたpostで送られてきたトークンと一致するか？正規ルートで入ってこないとエラー出す！
$token = filter_input(INPUT_POST, 'csrf_token');
if(!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
    exit('不正なリクエストです。');
}
unset($_SESSION['csrf_token']);//残す必要ないためメモリ解放とセキュリティ面でも消す
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問合せ確認</title>
</head>
<body>
    
</body>
</html>
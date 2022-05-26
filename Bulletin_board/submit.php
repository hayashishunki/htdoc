<?php
//前のセッションを受け継ぐ（昨日起きていたセッションの不具合治すために、先頭にsession_satrt()を移動させてみました。）
session_start();
require_once '../function.php';

//送られてきたトークンとsessionの中のトークンが一致しない、またはsessionトークンが入っていなければエラー
$token = filter_input(INPUT_POST, 'csrf_token');
if (!isset($_SESSION['csrf_token']) || $_SESSION['csrf_token'] !== $_POST['csrf_token']) {
    exit('不正なリクエストです。');
}
unset($_SESSION['csrf_token']);

$err = [];
if (!$message = filter_input(INPUT_POST, 'message')) {
    $err['message'] = '投稿内容を入力してください。';
}
if (count($err) > 0) {
    $_SESSION['err'] = $err;
    header("Location: index.php");
    return;
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>投稿者：<?= $_SESSION['login_user']['name']; ?></h2>
    <br>
    <h3>投稿内容：<?= h($_POST['message']) ?></h3>
    <a href="../public/mypage.php">マイページへ</a>
</body>

</html>

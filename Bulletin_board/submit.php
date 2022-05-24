<?php
require_once '../function.php';
//前のセッションを受け継ぐ
session_start();

//送られてきたトークンとsessionの中のトークンが一致しない、またはsessionトークンが入っていなければエラー
$token = filter_input(INPUT_POST, 'csrf_token');
if (!isset($_SESSION['csrf_token']) || $_SESSION['csrf_token'] !== $_POST['csrf_token']) {
    exit('不正なリクエストです。');
}
unset($_SESSION['csrf_token']);

$err = [];
if (!$viewName = filter_input(INPUT_POST, 'view_name')) {
    $err['view_name'] = 'ユーザーネームを入力してください。';
}
if (!$message = filter_input(INPUT_POST, 'message')) {
    $err['message'] = '投稿内容を入力してください。';
}
if (count($err) > 0) {
    $_SESSION = $err;
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
    <h2>投稿者：<?php echo h($_POST['view_name']) ?></h2>
    <br>
    <h3>投稿内容：<?php echo h($_POST['message']) ?></h3>
</body>

</html>

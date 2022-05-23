<?php
//前のセッションを受け継ぐ
session_start();

$err = [];

if(!$viewName = filter_input(INPUT_POST, 'view_name')) {
    $err['view_name'] = 'ユーザーネームを入力してください。';
}
if(!$message = filter_input(INPUT_POST, 'message')) {
    $err['message'] = '投稿内容を入力してください。';
}
if(count($err) > 0) {
    $_SESSION = $err;
    header("Location: index.php");
    return;
}
?>

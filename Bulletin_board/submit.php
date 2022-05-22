<?php

$viewName = filter_input(INPUT_POST, 'view_name');
$message = filter_input(INPUT_POST, 'message');

$err = [];
if(empty($viewName)) {
    $err[] = 'ユーザーネームを入力してください。';
}

if(empty($message)) {
    $err[] = 'メッセージを入力してください。';
}

if (!preg_match("/\A[a-z\d]{1,100}+\z/i", $viewName, $message)) {
    $err[] = '入力内容は100文字以下にしてください';
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿完了画面</title>
</head>
<body>
    <?php if(count($err) > 0): ?>
    <?php foreach($err as $e): ?>
    <?php echo $e; ?>
    <?php endforeach; ?>
    <?php else: ?>
    <p>投稿完了</p>
    <?php endif; ?>
</body>
</html>

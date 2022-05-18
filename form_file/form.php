<?php 
//セッション入れて上げて送信時に確認するため
session_start();
require_once '../function.php' 
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせ</title>
</head>
<body>
    <h2>お問い合わせフォーム</h2>
    <form action="form_return.php" method="POST">
        <p>email</p>
        <p><input type="text" name="email"></p>
        <p>お問い合わせ内容</p>
        <p><textarea name="form"></textarea></p>
        <input type="hidden" name="csrf_token" value="<?php echo h(setToken()); ?>">
        <input type="submit" value="送信">
    </form>
</body>
</html>

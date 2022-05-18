<?php
// //お問合せ内容をメールで受け取る
session_start();

//トークンが入ってるかまたpostで送られてきたトークンと一致するか？正規ルートで入ってこないとエラー出す！
$token = filter_input(INPUT_POST, 'csrf_token');
if(!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
    exit('不正なリクエストです。');
}
unset($_SESSION['csrf_token']);//残す必要ないためメモリ解放とセキュリティ面でも消す
$posts = $_POST;
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
    <form action="form_end.php">
        <h1><?php foreach($posts as $key => $value): ?></h1>
            <p><?php echo $key.' : '.$value; ?></p>
            <p>この内容でよろしいですか？</p>
            <?php endforeach; ?>
            <P><a href="form.php"></a>修正する</P>
            <button type="submit">これで送信</button>
    </form>
</body>
</html>
<?php
$email = $_POST['email'];
$contact = $_POST['contact'];

//メール送信本文作成
$mail_form  = 'メールアドレス:'.$email."\r\n".
            'お問合せ内容:'.$contact."\r\n";

            mail('hayashinoshun@gmail.com', 'お問合せ', $mail_form);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>送信完了しました</title>
</head>
<body>
    <h1>送信完了!</h1>
    <p>お問合せありがとうございます！</p>
    <p>送信完了しました。</p>
</body>
</html>
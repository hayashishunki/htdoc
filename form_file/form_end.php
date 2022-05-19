<?php
$email = $_POST['email'];
$contact = $_POST['contact'];

//メール送信本文作成/"/r/n"は改行
$mail_form  = 'メールアドレス:'.$email."\r\n".
            'お問合せ内容:'.$contact."\r\n";

mb_language("Japanese");
mb_internal_encoding("UTF-8");

$headers = [
    'MIME-Version' => '1.0',//電子メールであることを示す
    'Content-Transfer-Encoding' => '7bit',//基本初期値は7bit,メールを暗号化する
    'Content-Type' => 'text/plain; charset=UTF-8',//メールタイプ文字種類指定
    'Return-Path' => 'hayashinoshun@gmail.com',//メールが届かなかった場合に、そのメールが送り返される返信先のメールアドレス
    'From' => $email,//誰から送られたか	入力されたmail
    'Sender' => $email,//実際の送信元メールアドレス  実際に送られてきたmail
    'Reply-To' => 'hayashinoshun@gmail.com',//送信先のメールアドレス
    // 'Organization' => 'OrganizationName',
    // 'X-Sender' => 'from@example.com',
    // 'X-Mailer' => 'Postfix/2.10.1',
    'X-Priority' => '3',
    ];

        $result = mb_send_mail('hayashinoshun@gmail.com', 'お問合せ', $mail_form, $headers);
        var_dump($result);
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
    <a href="../public/mypage.php"></a>
</body>
</html>

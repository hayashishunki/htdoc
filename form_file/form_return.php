<?php
// //お問合せ内容をメールで受け取る
session_start();

//トークンが入ってるかまたpostで送られてきたトークンと一致するか？正規ルートで入ってこないとエラー出す！
$token = filter_input(INPUT_POST, 'csrf_token');
if(!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
    exit('不正なリクエストです。');
}
unset($_SESSION['csrf_token']);//残す必要ないためメモリ解放とセキュリティ面でも消す

//メールアドレス型かどうか検証(FILTER_VALIDATE_EMAIL)
$email_fil = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
//検証用var_dump($email_fil);
//もし文字入力が100文字以上の場合のエラー表示とここで止まる。
if(mb_strlen($email_fil) > 100) {
    exit('メールアドレスの入力は100文字以内にしてください。');
} 
if(empty($email_fil)) {
    exit('メールアドレスを入力してください。');
}

if(mb_strlen($_POST['contact']) > 200) {
    exit('お問合せ内容は200文字までにしてください。');
}
if(empty($_POST['contact'])) {
    exit('お問合せ内容を入力してください。');
}


// if(mb_strlen($_POST['contact'] > 200)) {
//     exit('お問合せ内容は200文字以内にしてください。');
// }

//XSS対策(送られてきたデータを置き換える)htmlに出力させるときにエスケープさせる。サーバーの中ではしなくても大丈夫。
$email = htmlspecialchars($_POST['email'], ENT_QUOTES);
$contact = htmlspecialchars($_POST['contact'], ENT_QUOTES);

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
    <h1>確認画面</h1>
    <form action="form_end.php" method="POST">
    <p>email:</p>
    <input type="text" name="email"value="<?=  $email; ?>">
    <p>お問合せ内容:</p>
    <input type="text" name="contact" value="<?=  $contact; ?>">

    <!-- 入力画面から受け取ったデータを格納 -->
    <input type="hidden" name="email" value="<?=  $email; ?>">
    <input type="hidden" name="contact" value="<?=  $contact; ?>">
    <button type="submit" value="送信">OK!送信します。</button>
    </form>
</body>
</html>


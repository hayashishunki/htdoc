<?php
session_start();
require_once '../function.php';

if(isset($_SESSION['err'])) {
    $err = $_SESSION['err'];
}
unset($_SESSION['message']);



define('FAILNAME', './message.txt');

//タイムゾーン設定
date_default_timezone_set('ASIA/TOKYO');

//変数の初期化
$current_date = null;
$date = null;
$file_handler = null;

if(!empty($_POST['btn_submit'])) {
    
    if($file_handler = fopen(FAILNAME, 'a')) {

        //書き込み日時を取得
        $current_date = date("Y-m-d H:i:s");

        //書き込むデータを作成
        $date = "'".$_POST['view_name']."','".$_POST['message']."','".$current_date."'\n";

        //書き込み
        fwrite($file_handler, $date);
        //ファイルを閉じる
        fclose($file_handler);
    }
}


if($file_handler = fopen(FAILNAME, 'r')) {
    while($date = fgets($file_handler)) {
        echo $date."<br>";
    }
    //ファイルを閉じる
    fclose($file_handler);
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>ひと言掲示板</title>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>ひと言掲示板</h1>
    <!-- メッセージの入力フォームを作成 -->
    <form method="post" action="submit.php">
        <h2>ユーザーネーム：<?= h($_SESSION['login_user']['name']); ?></h2>
        <div>
            <br>
            <label for='message'>ひと言メッセージ</label>
            <textarea name='message' id='message'></textarea>
            <?php if(isset($err['message'])): ?>
            <p><?= h($err['message']); ?></p>
            <?php endif; ?>
        </div>
        <br>
        <!-- トークン作成送り込み -->
        <input type="hidden" name="csrf_token" value="<?php echo h(setToken()); ?>">
        <input type='submit' name='btn_submit' value="書き込む">
    </form>
    <hr>
    <section>
        <!-- ここに投稿されたメッセージを表示 -->
    </section>
    <a href="../public/mypage.php">マイページへ</a>
</body>

</html>
© hayashinoshun
github
project

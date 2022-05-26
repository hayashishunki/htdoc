<?php
session_start();
require_once '../function.php';

//errに値が設定されている場合変数に代入
if (isset($_SESSION['err'])) {
    $err = $_SESSION['err'];
}
//リロードされた場合セッションをリセット
unset($_SESSION['message']);


//FAILNAME変数にurlキーを指定,メッセージ保存させるファイルパス指定
define('FAILNAME', './message.txt');

//タイムゾーン設定
date_default_timezone_set('ASIA/TOKYO');

//変数の初期化=存在しないエラーが起きなくなる
$current_date = null;
$date = null;
$file_handler = null;

$split_date = null;
$message = array();
$message_array = array();

//ファイルにアクセス
if (!empty($_POST['btn_submit'])) {

    if ($file_handler = fopen(FAILNAME, 'a')) {

        //書き込み日時を取得
        $current_date = date("Y-m-d H:i:s");

        //書き込むデータを作成
        $date = "'" . $_POST['message'] . "','" . $current_date . "'\n";

        //書き込み
        fwrite($file_handler, $date);
        //ファイルを閉じる
        fclose($file_handler);
    }
}
//message.txtのデータが読み込まれる
if ($file_handler = fopen(FAILNAME, 'r')) {
    //fgets関数を1度実行して1行読み込むと、このファイルポインターリソースの位置も都度更新されていく、ファイルが終わるまで1行ずつデータを読み込む
    while ($date = fgets($file_handler)) {
        
        //preg_split関数は文字列を特定の文字で分割する関数
        $split_date = preg_split('/\'/', $date);

        $message = array('message' => $split_date[1]);
        //$message_arrayに$messageごと格納,この操作を投稿されたメッセージの数だけ繰り返すと、$message_arrayに全てのメッセージのデータが入る
        array_unshift($message_array, $message);
    }


    //ファイルを閉じる
    fclose($file_handler);
}

// //ファイルからデータを取得する
// if ($file_handler = fopen(FAILNAME, 'r')) {
//     //ファイルからデータを一行ずつ取得
//     while ($date = fgets($file_handler)) {
//         echo $date . "<br>";
//     }
//     //ファイルを閉じる
//     fclose($file_handler);
// }
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
    <form method="post" >
        <h2>ユーザーネーム：<?= h($_SESSION['login_user']['name']); ?></h2>
        <div>
            <br>
            <label for='message'>ひと言メッセージ</label>
            <textarea name='message' id='message'></textarea>
            <?php if (isset($err['message'])) : ?>
                <p><?= h($err['message']); ?></p>
            <?php endif; ?>
        </div>
        <br>
        <!-- トークン作成送り込み -->
        <input type="hidden" name="csrf_token" value="<?php echo h(setToken()); ?>">
        <input type='submit' name='btn_submit' value="書き込む">
    </form>
    <br>
    <a href="../public/mypage.php">マイページへ</a>
    <hr>
    <section>
        <!-- ここに投稿されたメッセージを表示 -->
        <!-- foreach文で$message_arrayからメッセージ1件分のデータを取り出し、$valueに入れた -->
        <?php if(!empty($message_array)): ?>
            <?php foreach($message_array as $value): ?>
        <article>
            <div class="info">
                <h2><?php echo h($_SESSION['login_user']['name']) ?></h2>
                <time><?php echo date('Y年m月d日 H:i', strtotime($value['post_date'])); ?></time>
            </div>
            <p><?php echo $value['message']; ?></p>
        </article>
        <?php endforeach; ?>
        <?php endif; ?>
    </section>
</body>

</html>
© hayashinoshun
github
project

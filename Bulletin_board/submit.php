<?php
//前のセッションを受け継ぐ（昨日起きていたセッションの不具合治すために、先頭にsession_satrt()を移動させてみました。）
session_start();
require_once './const/file.php';
require_once '../function.php';

//送られてきたトークンとsessionの中のトークンが一致しない、またはsessionトークンが入っていなければエラー
$token = filter_input(INPUT_POST, 'csrf_token');
if (!isset($_SESSION['csrf_token']) || $_SESSION['csrf_token'] !== $_POST['csrf_token']) {
    exit('不正なリクエストです。');
}
unset($_SESSION['csrf_token']);
$message = filter_input(INPUT_POST, 'message');
$err = [];
if (empty($message)) {
    $err['message'] = '投稿内容を入力してください。';
}
if(mb_strlen($message) > 10) {
    $err['message'] = '入力は10文字以内にしてください。';
}

if (count($err) > 0) {
    $_SESSION['err'] = $err;
    header("Location: index.php");
    return;
}

//タイムゾーン設定,mamp設定済みなので必要なし
date_default_timezone_set('Asia/Tokyo');

//変数の初期化=存在しないエラーが起きなくなる
$current_date = null;
$date = null;
$file_handler = null;

$split_date = null;
$message = array();
$message_array = array();

//ファイルにアクセス
if (!empty($_POST['btn_submit'])) {

    //a...追記する
    if ($file_handler = fopen(FAILNAME, 'a')) {

        //書き込み日時を取得
        $current_date = date("Y-m-d H:i:s", time());
        //書き込むデータを作成
        $date = "'" . $_POST['message'] . "','" . $current_date . "'\n";

        //書き込み
        fwrite($file_handler, $date);
        //ファイルを閉じる
        fclose($file_handler);
    }
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


//リダイレクトの際値を引き継げない為、submit.phpで読み込ませる。または、sessionに入れるかデータベースにいれることでできる。
//エラーなかったらもどす
header("Location: index.php");
?>

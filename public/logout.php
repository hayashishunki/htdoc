<?php       //ログアウトする
//..は一個上の階層
session_start();
require_once '../class/UserLogic.php';

if(!$logout = filter_input(INPUT_POST, 'logout')) {
    exit('不正なリクエストです。');
}//ログアウトのボタンが押されてこなかったらログを返す。(セキュリティ対策)

//ログインしているか判定し、セッションが切れていたらログインしてくださいとメッセージを出す。
$result = UserLogic::checkLogin();


if (!$result) {
    exit('セッションが切れましたので、ログインし直してください。');
}

//ログアウトする
UserLogic::logout();

header('Location: login_form.php');//ログアウトしてログイン画面へ
?>

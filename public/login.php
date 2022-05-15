<?php       //login_form.phpから走る


session_start(); //こうするとsessionIdが入る

//..は一個上の階層
require_once '../class/UserLogic.php';


//エラーメッセージ
$err = []; //配列にエラーメッセージ入れる

//正しい形式のデータであるか規定道理か//バリデーション
//INPUT_POST=POSTで受け取ったデータ表示、filter_input=postで送られたもの_指定した名前の変数を外部から受け取る
if (!$email = filter_input(INPUT_POST, 'email')) {
    $err['email'] = 'メールアドレスを記入してください。';
}
//未入力ならエラーを返す
if (!$password = filter_input(INPUT_POST, 'password')) {
    $err['password'] = 'パスワードを入れてください。';
}

if (count($err) > 0) {
    //エラーがあった場合headerを使うことで戻してくれる。
    $_SESSION = $err; //エラーがあった場合_SESSION（連想配列で管理）にエラーメッセージを入れた上でlogin.phpに戻してくれる
    header('Location: login_form.php');
    return; //処理を止める
}

//resultに結果が返ってきてるtrue or false,ログイン成功時の処理
$result = UserLogic::login($email, $password);
//ログイン失敗時の処理
if (!$result) {
    header('Location:login_form.php');
    return;
}

header('Location:mypage.php');//ログインページに転移
?>
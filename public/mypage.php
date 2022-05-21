<?php       //ユーザーログイン画面
//..は一個上の階層
session_start();
require_once '../class/UserLogic.php';
require_once '../function.php';

//ログインしているか判定し、していなかったら新規登録画面へ返す
$result = UserLogic::checkLogin();

if (!$result) {
    $_SESSION['login.err'] = 'ユーザーを登録してください。'; //エラーメッセージを入れる
    header('Location: signup_form.php');
    return;
}
//ログインしていたら上はスルーされるので
$login_user = $_SESSION['login_user']; //ログインしているユーザーをSESSIONから取ってきて変数に入れる

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>マイページ</title>
</head>

<body>
    <h2>マイページ</h2>
    <p>ログインユーザー : <?php echo h($login_user['name']); ?></p>
    <!--h()はfunction.phpで定義、付ける理由はエスケープさせるため-->
    <p>メールアドレス : <?php echo h($login_user['email']); ?></p>
    <form action="logout.php" method="POST">
        <input type="submit" name="logout" value="ログアウト">
    </form>
    <a href="../form_file/form.php">お問い合わせ</a>
    <a href="../Bulletin board/index.php">投稿</a>
</body>

</html>

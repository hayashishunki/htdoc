<!-- 新規ユーザー登録画面 -->
<?php
session_start();
require_once '../function.php';
require_once '../class/UserLogic.php';

$result = UserLogic::checkLogin();//もしユーザーがログインしてたらtrue,でなければfalseを返す。
if($result) {//trueの場合mypageに戻してあげるif文
    header('Location: mypage.php');
    return;
}

$login_err = isset($_SESSION['login_err']) ? $_SESSION['login_err'] : null;//一回目ログインした時は$login_errにsessionが入るがunsetを通ると２回目から消える
unset($_SESSION['login_err']);//issetで確認して入っていたら実行、入っていなかったらnullを返す。これないとエラーになる。
//条件式 ? 式1 : 式2 <- 三項演算子と言うTRUEであれば式1、FALSEであれば式2を返します。。
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録画面</title>
</head>

<body>
    <h1>ユーザー登録フォーム</h1>
    <?php if (isset($login_err)) : ?>
        <!-- issetは値があるかどうか調べる -->
        <p><?php echo $login_err; ?></p>
    <?php endif; ?>
    <form action="register.php" method="POST">
        <p>
            <label for="username">ユーザー名:</label>
            <input type="text" name="username">
        </p>
        <p>
            <label for="email">メールアドレス:</label>
            <input type="text" name="email">
        </p>
        <p>
            <label for="password">パスワード:</label>
            <input type="text" name="password">
        </p>
        <p>
            <label for="password_conf">パスワード確認:</label>
            <input type="password" name="password_conf">
        </p>
        <input type="hidden" name="csrf_token" value="<?php echo h(setToken()); ?>">
        <p><input type="submit" value="登録！"></p>

    </form>
    <a href="login_form.php">ログインはこちら</a>
    <a href="../form_file/form.php">お問い合わせ</a>
</body>

</html>
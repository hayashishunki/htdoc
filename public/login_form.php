<?php

session_start();

require_once '../class/UserLogic.php';

$result = UserLogic::checkLogin();//もしユーザーがログインしてたらtrue,でなければfalseを返す。
if($result) {//trueの場合mypageに戻してあげるif文
    header('Location: mypage.php');
    return;
}

//sessionの中身をフォームに出す、エラーがあればemail,passwordの下に表示させる。
$err = $_SESSION;

//エラー起こった場合session保持されたままでエラーが消えないため消去、さらにsession内配列も初期化してあげる
$_SESSION = array();
session_destroy(); //sessionファイルが消える
?>
<!-- ログイン画面 -->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン画面</title>
</head>

<body>
    <h1>ログインフォーム</h1>
    <?php if (isset($err['msg'])) : ?>
        <!-- issetは値があるかどうか調べる -->
        <p><?php echo $err['msg']; ?></p>
    <?php endif; ?>
    <form action="login.php" method="POST" autocomplete="off">
        <p>
            <label for="email">メールアドレス:</label>
            <input type="email" name="email">
            <?php if (isset($err['email'])) : ?>
                <!-- issetは値があるかどうか調べる -->
        <p><?php echo $err['email']; ?></p>
    <?php endif; ?>
    </p>
    <p>
        <label for="password">パスワード:</label>
        <input type="password" name="password">
        <?php if (isset($err['password'])) : ?>
            <!-- issetは値があるかどうか調べる -->
    <p><?php echo $err['password']; ?></p>
<?php endif; ?>
</p>
<p><input type="submit" value="ログイン"></p>
    </form>
    <a href="signup_form.php">新規登録はこちらから</a>
</body>

</html>
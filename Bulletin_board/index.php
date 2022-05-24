<?php
require_once '../function.php';

session_start();

$err = $_SESSION;

unset($_SESSION['view_name'], $_SESSION['message']);
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
        <div>
            <label for='view_name'>ユーザー名</label>
            <input type="text" id='view_name' name='view_name' value="">
            <?php if(isset($err['view_name'])): ?>
                <p><?php echo $err['view_name']; ?></p>
                <?php endif; ?>
        </div>
        <div>
            <br>
            <label for='message'>ひと言メッセージ</label>
            <textarea name='message' id='message'></textarea>
            <?php if(isset($err['message'])): ?>
            <p><?php echo $err['message']; ?></p>
            <?php endif; ?>
        </div>
        <br>
        <input type="hidden" name="csrf_token" value="<?php echo h(setToken()); ?>">
        <input type='submit' name='btn_submit' value="書き込む">
    </form>
    <hr>
    <section>
        <!-- ここに投稿されたメッセージを表示 -->
    </section>
</body>

</html>
© hayashinoshun
github
project

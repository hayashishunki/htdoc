<?php 
session_start();
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
    </div>
    <div>
        <label for='message'>ひと言メッセージ</label>
        <textarea name='message' id='message'></textarea>
    </div>
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

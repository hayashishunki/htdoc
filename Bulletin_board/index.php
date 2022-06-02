<?php
session_start();
require_once './const/file.php';
require_once '../function.php';

//変数の初期化=存在しないエラーが起きなくなる
$current_date = null;
$date = null;
$file_handler = null;

$split_date = null;
$message = array();
$message_array = array();

//errに値が設定されている場合変数に代入
if (isset($_SESSION['err'])) {
    $err = $_SESSION['err'];
}
//リロードされた場合セッションをリセット
unset($_SESSION['err']);

// //message.txtのデータが読み込まれる
// if ($file_handler = fopen(FAILNAME, 'r')) {
//     //whileを使うと書き込みを
//     //fgets関数を1度実行して1行読み込むと、このファイルポインターリソースの位置も都度更新されていく、ファイルが終わるまで1行ずつデータを読み込む
//     while ($date = fgets($file_handler)) {
        
//         //preg_split関数は文字列を特定の文字で分割する関数
//         $split_date = preg_split('/\'/', $date);
//         //messageに配列で入れている。
//         $message = array('message' => $split_date[1],
//                         'post_date' => $split_date[3]
//     );
//         //$message_arrayに$messageごと格納。unshiftで先頭に表示
//         array_unshift($message_array, $message);
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
    <form action="./submit.php" method="post">
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
        <h2>掲示板</h2>
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

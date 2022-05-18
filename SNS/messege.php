<?php
//メッセージする際に必要な情報
$current_user = get_user($_SESSION['user_id']); //現在ログインしているユーザー
$destination_user = get_user($_GET['user_id']); //メッセージ送信先ユーザー
$messages = get_messages($current_user['id'], $destination_user['id']); //やりとりされるメッセージ
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メッセージ画面</title>
</head>

<body>
    <div class="message">
        <h2 class="center"><?= $destination_user['name'] ?></h2>
        <?php foreach ($messages as $message) : ?><!--自分のメッセージと送信先のメッセージが表示させる-->
            <div class="my_message">
                <?php if ($message['user_id'] == $current_user['id']) : ?><!--get_message関数で取得してメッセージ情報をforeachで回す-->
                    <div class="mycomment right">
                        <span class="message_created_at"><?= convert_to_fuzzy_time($message['created_at']) ?></span>
                        <p><?= $message['text'] ?></p><img src="../user/image/<?= $current_user['image'] ?>" class="message_user_img">
                    </div>
                <?php else : ?>
                    <div class="left"><img src="../user/image/<?= $destination_user['image'] ?>" class="message_user_img">
                        <div class="says"><?= $message['text'] ?></div><span class="message_created_at"><?= convert_to_fuzzy_time($message['created_at']) ?></span>
                    <?php endif; ?><!--自分と送信先のユーザーメッセージによって、左右に表示させるためにif文で分岐させています。-->

                    </div>
                <?php endforeach ?>

                <div class="message_process">
                    <h2 class="message_title">メッセージ</h2><!--message_add.phpに遷移しコメントテーブルにINSERTをかけるような処理-->
                    <form method="post" action="../message/message_add.php" enctype="multipart/form-data">
                        <textarea class="textarea form-control" placeholder="メッセージを入力ください" name="text"></textarea>
                        <input type="hidden" name="destination_user_id" value="<?= $destination_user['id'] ?>"><!--送信先のユーザーIDを渡しています。これでメッセージテーブルの中に相手側の情報をもつ-->
                        <div class="message_btn">
                            <div class="message_image">
                                <input type="file" name="image" class="my_image" accept="image/*" multiple>
                            </div>
                            <button class="btn btn-outline-primary" type="submit" name="post" value="post" id="post">投稿</button>
                        </div>
                    </form>
                </div>
            </div>
</body>

</html>

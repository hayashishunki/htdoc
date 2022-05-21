<?php
session_start();
require_once 'index.php';

if(!empty('view_name')) {
    echo '題名を入力してください。';
}
if(!empty('message')) {
    echo 'メッセージを入力してください。';
}
var_dump($_POST);



?>
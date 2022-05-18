<?php

$posts = $_POST;

//formから送られたものを不当なscriptが発動しないように表示させる。
foreach($posts as $key => $value) {
    echo $key.' : '.htmlspecialchars($value, ENT_QUOTES, 'UTF-8') . "<br>";
    echo '<br>';
}
?>
main3
main2

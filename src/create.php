<?php


// データベースに接続する
if ($mysql = mysqli_connect('db','book_log','pass','book_log')) {
    echo 'データベースに接続しました' . PHP_EOL;
}   else {
    echo 'データベース接続に失敗しました' . PHP_EOL;
    echo mysqli_error($mysql);
}

// テーブルを初期化する



// データベースを切断する
if (mysqli_close($mysql)) {
    echo 'データベース接続を切断しました' . PHP_EOL;
} else {
    echo 'データベース接続の切断に失敗しました' . PHP_EOL;
    echo mysqli_error($mysql);
}

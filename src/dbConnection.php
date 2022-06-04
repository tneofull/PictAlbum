<?php

// データベースに接続する
function dbConnection()
{
    if ($link = mysqli_connect('db', 'book_log', 'pass', 'book_log')) {
        echo 'データベースに接続しました' . PHP_EOL;
    } else {
        echo 'Error: データベース接続に失敗しました' . PHP_EOL;
        echo 'Debugging Error: ' . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    return $link;
}

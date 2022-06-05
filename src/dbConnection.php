<?php

// データベースに接続する
function dbConnection()
{
    if ($link = mysqli_connect('db', 'book_log', 'pass', 'book_log')) {
    } else {
        echo 'Error: データベース接続に失敗しました' . PHP_EOL;
        echo 'Debugging Error: ' . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    return $link;
}

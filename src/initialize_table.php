<?php

require_once ('dbConnection.php');

// テーブルを初期化する
function dropTable($link)
{
    $sql = 'DROP TABLE IF EXISTS PARKS';
    if (mysqli_query($link, $sql)) {
        echo 'テーブルを初期化しました' . PHP_EOL;
    } else {
        echo 'Error: テーブルの初期化に失敗しました' . PHP_EOL;
        echo 'Debugging Error: ' . mysqli_error($link) . PHP_EOL;
    }
}

// テーブルを作成する
function createTable($link)
{
    $sql = <<<EOT
    CREATE TABLE parks (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    name VARCHAR(100),
    area VARCHAR(10),
    view VARCHAR(10),
    size VARCHAR(10),
    score INT,
    comment VARCHAR(1000),
    created_at TIMESTAMP
    )
EOT;

    if ($result = mysqli_query($link, $sql)) {
        echo 'テーブルを作成しました' . PHP_EOL;
    } else {
        echo 'Error: テーブルの作成に失敗しました' . PHP_EOL;
        echo 'Debugging Error: ' . mysqli_error($link) . PHP_EOL;
        var_dump($result);
    }
}

// データベースを切断する
function dbClose($link)
{
    if (mysqli_close($link)) {
        echo 'データベース接続を切断しました' . PHP_EOL;
    } else {
        echo 'Error: データベース接続の切断に失敗しました' . PHP_EOL;
        echo 'Debugging Error: ' . mysqli_error($link) . PHP_EOL;
    }
}


$link = dbConnection();
dropTable($link);
createTable($link);
dbClose($link);

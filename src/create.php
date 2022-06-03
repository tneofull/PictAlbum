<?php


// データベースに接続する
if ($link = mysqli_connect('db', 'book_log', 'pass', 'book_log')) {
    echo 'データベースに接続しました' . PHP_EOL;
} else {
    echo 'データベース接続に失敗しました' . PHP_EOL;
    echo mysqli_connect_error();
}

// テーブルを初期化する
$sql = <<<EOT
CREATE TABLE PARKS (
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

$result = mysqli_query($link,$sql);
var_dump($result);
echo mysqli_error($link);


// データベースを切断する
if (mysqli_close($link)) {
    echo 'データベース接続を切断しました' . PHP_EOL;
} else {
    echo 'データベース接続の切断に失敗しました' . PHP_EOL;
    echo mysqli_error($link);
}

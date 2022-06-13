<?php
// 一度読み込んでおくと今後ライブラリは読み込まず(requireせず)使用できるようになる(パスが通る)
require_once __DIR__ . '/vendor/autoload.php';


// データベースに接続する
function dbConnection()
{
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);//引数に.envファイルが置かれているパスを指定する
    $dotenv->load();

    $dbHost = $_ENV['DB_HOST'];
    $dbUsername = $_ENV['DB_USERNAME'];
    $dbPassword = $_ENV['DB_PASSWORD'];
    $dbDatabase = $_ENV['DB_DATABASE'];

    if ($link = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbDatabase)) {
    } else {
        echo 'Error: データベース接続に失敗しました' . PHP_EOL;
        echo 'Debugging Error: ' . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    return $link;
}

<?php

require_once('dbConnection.php');
require_once('escape.php');


function selectTable($link)
{
    $sql = <<<EOT
    SELECT
    id,
    name,
    area,
    view,
    size,
    score,
    comment,
    pictname
    FROM parks
EOT;

    if ($result = mysqli_query($link, $sql)) :
        $parks = [];
        while ($row = mysqli_fetch_assoc($result)) :
            $parks[] = $row;
        endwhile;
        return $parks;
    else :
        echo 'Error: データの取得に失敗しました' . PHP_EOL;
        echo 'Debugging Error: ' . mysqli_error($link) . PHP_EOL;
    endif;
}

$link = dbConnection();
$parks = selectTable($link);

$title = '一覧画面';
$content = __DIR__ . '/views/list.php';
include __DIR__ . '/views/layout.php';

?>

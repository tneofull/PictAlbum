<?php

require_once('dbConnection.php');
var_dump($_POST['area']);
// foreach ($_POST['area'] as $area):
//     echo $area . PHP_EOL;
// endforeach;
// $count = count($_POST['area']);

// for ($i = 0; $i < $count; $i++)
// echo ($_POST['area'][$i] . PHP_EOL);


function selectTable($link)
{
    $array = implode(",", $_POST['area']);
    var_dump($array);

    $sql = <<<EOT
    SELECT
    id,
    name,
    area,
    view,
    size,
    score,
    comment
    FROM parks
    WHERE area IN ("{$_POST['area'][0]}","{$_POST['area'][1]}")
EOT;

//方針1
// 途中までは、末尾に,を含めた出力にし、一番最後だけ末尾の,を除くとする。
// なお判定は今何番目なのかと、全要素数から判定する

// 方針2
// area = '葛飾区'というのをかたまりととらえ後4セット分を条件で、同じ配列にどんどん格納していく。
// それをimplodeにて、ANDでのりづけしたものを、where句の後ろ部分として完成させる


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

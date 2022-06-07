<?php

require_once('dbConnection.php');


// 方針2
// area = '葛飾区'というのをかたまりととらえ後4セット分を条件で、同じ配列にどんどん格納していく。
// それをimplodeにて、ORでのりづけしたものを、where句の後ろ部分として完成させる
// $where = implode("OR", "area = '". $_POST['area'] . "'");
// var_dump($where);


    function selectTable($link)
    {
        $count = count($_POST['area']);
        var_dump($count);

        $where = 'WHERE ';
        for ($i = 0; $i < $count; $i++) :
            if ($i < $count - 1) :
                $where .= "area = '" . $_POST['area'][$i] . "' OR ";
                elseif ($i == $count - 1) :
                    $where .= "area = '" . $_POST['area'][$i] . "'";
                endif;
            endfor;
            echo $where;

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
        {$where}
        EOT;

        // WHERE area IN ("{$_POST['area'][0]}","{$_POST['area'][1]}")
        // WHERE area = '葛飾区' OR area = '足立区' OR area = '荒川区'




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

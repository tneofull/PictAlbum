<?php

require_once('dbConnection.php');
require_once('escape.php');


function selectTable($link)
{
    if (isset($_POST['area']) && is_array($_POST['area'])):

        // WHERE句の生成 やりかた1
        // チェックボックスで2つ以上チェックされると、2個目以降の検索要素ではWHERE句にORが加わるようにする
        // $where = 'WHERE ';
        // $count = count($_POST['area']);
        // for ($i = 0; $i < $count; $i++) :
        //     if ($i !== 0) :
        //         $where .= " OR ";
        //     endif;
        //     $where .= "area = '" . $_POST['area'][$i] . "'";
        // endfor;

        // WHERE句の生成 やりかた2
        // 要素が1つならimplode関数は合体しないこともうまく利用し、
        // 共通に現れてくる部分を見極めて複数要素を上手く合体してWHERE句を作成する
        $where  = "WHERE area = '";
        $where .= implode("' OR area = '", $_POST['area']) . "'";

            $sql = <<<EOT
            SELECT
                id,name,area,view,size,score,comment,pictname
            FROM
                parks
            {$where}
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
    else: //チェックボックスに何も入力がなく検索された場合の処理
        header('Location: http://localhost:55580/index.php');
        exit;
    endif;
}

$link = dbConnection();
$parks = selectTable($link);

$title = '一覧画面';
$content = __DIR__ . '/views/list.php';
include __DIR__ . '/views/layout.php';

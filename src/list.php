<?php

require_once('dbConnection.php');

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
    comment
    FROM parks
EOT;

    if ($result = mysqli_query($link, $sql)):
        echo 'データの取得に成功しました' . PHP_EOL;
        $parks = [];
        while ($row = mysqli_fetch_assoc($result)):
            $parks[] = $row;
        endwhile;
        // var_dump($parks);
        return $parks;
    else:
        echo 'Error: データの取得に失敗しました' . PHP_EOL;
        echo 'Debugging Error: ' . mysqli_error($link) . PHP_EOL;
    endif;
}

$link = dbConnection();
$parks = selectTable($link);

foreach ($parks as $park):
    echo $park['name'] . PHP_EOL;
    echo $park['area'] . PHP_EOL;
    echo $park['view'] . PHP_EOL;
    echo $park['size'] . PHP_EOL;
    echo $park['score'] . PHP_EOL;
    echo $park['comment'] . PHP_EOL;
endforeach;

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>画像一覧</title>
</head>

<body>
    <header>
        <h1>PhotoAlbum</h1>
    </header>

    <ul>
        <li>
            <div>
                <p>公園の名前:日暮里公園</p>
            </div>
            <div>
                <p>公園の場所:荒川区</p>
            </div>
            <div>
                <p>景観:きれい</p>
            </div>
            <div>
                <p>大きさ:small</p>
            </div>
            <div>
                <p>総合評価:5</p>
            </div>
            <div>
                <p>感想:構造が良い感じ。<br>
                    広さも適度にある。
                </p>
            </div>
        </li>
        <li>
            <div>
                <p>公園の名前:お花茶屋公園</p>
            </div>
            <div>
                <p>公園の場所:葛飾区</p>
            </div>
            <div>
                <p>景観:きれい</p>
            </div>
            <div>
                <p>大きさ:small</p>
            </div>
            <div>
                <p>総合評価:5</p>
            </div>
            <div>
                <p>感想:構造が良い感じ。<br>
                    椅子の数が多い。
                </p>
            </div>
        </li>
    </ul>

    <a href="index.php" style="margin: 0 120px;">検索ページへ</a>
    <a href="new.php" style="margin: 0 120px;">登録ページへ</a>

</body>

</html>

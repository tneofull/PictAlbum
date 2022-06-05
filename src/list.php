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
    <?php foreach ($parks as $park) : ?>
        <ul>
            <li>
                <div>
                    <p>公園の名前: <?php echo $park['name'] . PHP_EOL; ?></p>
                </div>
                <div>
                    <p>公園の場所: <?php echo $park['area'] . PHP_EOL; ?></p>
                </div>
                <div>
                    <p>景観: <?php echo $park['view'] . PHP_EOL; ?></p>
                </div>
                <div>
                    <p>大きさ: <?php echo $park['size'] . PHP_EOL; ?></p>
                </div>
                <div>
                    <p>総合評価: <?php echo $park['score'] . PHP_EOL; ?></p>
                </div>
                <div>
                    <p>感想: <?php echo $park['comment'] . PHP_EOL; ?><br></p>
                </div>
            </li>
        </ul>
    <?php endforeach; ?>

    <a href="index.php" style="margin: 0 120px;">検索ページへ</a>
    <a href="new.php" style="margin: 0 120px;">登録ページへ</a>

</body>

</html>

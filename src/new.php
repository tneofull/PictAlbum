<?php

require_once('dbConnection.php');

function validate()
{
    $errors = [];
    // 公園の名前のチェック
    if (empty($_POST['name'])) :
        $errors[] = '公園の名前を入力してください';
    elseif (mb_strlen($_POST['name']) > 100) :
        $errors[] = '公園の名前は100文字以内で入力してください';
    endif;

    // 場所のチェック
    if (!in_array($_POST['area'], ['葛飾区', '足立区', '新宿区', '荒川区', '杉並区'], true)) :
        $errors[] = '公園の場所は"葛飾区","足立区","新宿区","荒川区","杉並区"のいずれかを選択してください';
    endif;

    // 景観のチェック
    if (!in_array($_POST['view'], ['なつかしい', 'ふつう', 'きれい'], true)) :
        $errors[] = '景観は、"なつかしい","ふつう","きれい"のいずれかを選択してください';
    endif;

    // 大きさのチェック
    if (!in_array($_POST['size'], ['small', 'medium', 'large'], true)) :
        $errors[] = '大きさは、"small","medium","large"のいずれかを選択してください';
    endif;

    // 総合評価のチェック
    if ((int)$_POST['score'] <= 0 || (int)$_POST['score'] >= 6) :
        $errors[] = '総合評価は、1以上5以下の整数を選択してください';
    endif;

    // 感想のチェック
    if (empty($_POST['comment'])) :
        $errors[] = '感想を入力してください';
    elseif (mb_strlen($_POST['comment']) > 1000) :
        $errors[] = '感想は1000文字以内で入力してください';
    endif;
    return $errors;
}

function insertTable($link)
{
    $sql = <<<EOT
    INSERT INTO parks (
    name,
    area,
    view,
    size,
    score,
    comment
    ) VALUES (
    "{$_POST['name']}",
    "{$_POST['area']}",
    "{$_POST['view']}",
    "{$_POST['size']}",
    "{$_POST['score']}",
    "{$_POST['comment']}"
    )
EOT;

    if (mysqli_query($link, $sql)) {
        echo 'データの挿入に成功しました' . PHP_EOL;
    } else {
        echo 'Error: データの挿入に失敗しました' . PHP_EOL;
        echo 'Debugging Error: ' . mysqli_error($link) . PHP_EOL;
    }
}

// POST送信されたときのみ処理していく
if ($_SERVER["REQUEST_METHOD"] === 'POST'):
    $errors = validate();

    if (count($errors) > 0):
        foreach ($errors as $error):
            echo nl2br($error . PHP_EOL);
        endforeach;
    else: //$errorsの要素がない=エラーがない場合のみ下記処理する
        $link = dbConnection();
        insertTable($link);

        // データベース切断 ここも関数に切り出す?
        if (mysqli_close($link)):
            echo 'データベース接続を切断しました' . PHP_EOL;
        else:
            echo 'Error: データベース接続の切断に失敗しました' . PHP_EOL;
            echo 'Debugging Error: ' . mysqli_error($link) . PHP_EOL;
        endif;
    endif;
endif;

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>画像登録</title>
</head>

<body>
    <header>
        <h1>PhotoAlbum</h1>
    </header>
    <form action="new.php" method="post">
        <div>
            <label for="name">公園の名前</label>
            <input type="text" id="name" name="name">
        </div>


        <div>
            <label for="area">公園の場所</label>
            <select name="area" id="area">
                <option value="葛飾区">葛飾区</option>
                <option value="足立区">足立区</option>
                <option value="荒川区">荒川区</option>
                <option value="新宿区">新宿区</option>
                <option value="杉並区">杉並区</option>
            </select>
        </div>

        <div>
            <label for="view">景観</label>
            <select name="view" id="view">
                <option value="なつかしい">なつかしい</option>
                <option value="ふつう" selected>ふつう</option>
                <option value="きれい">きれい</option>
            </select>
        </div>



        <div>
            <label>大きさ</label>
            <input type="radio" name="size" id="size1" value="small">
            <label for="size1">small</label>

            <input type="radio" name="size" id="size2" value="medium" checked>
            <label for="size2">medium</label>

            <input type="radio" name="size" id="size3" value="large">
            <label for="size3">large</label>
        </div>

        <div>
            <label for="score">総合評価</label>
            <select name="score" id="score">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>

        <div>
            <label for="comment">感想</label>
            <textarea name="comment" id="comment" cols="50" rows="5"></textarea>
        </div>

        <div>
            <label for="pict">画像</label>
            <input type="file" name="pict" id="">
        </div>

        <br>
        <input type="submit" value="登録">
    </form>
    <a href="index.php" style="margin: 0 120px;">検索ページへ</a>
    <a href="list.php" style="margin: 0 120px;">一覧ページへ</a>



</body>

</html>

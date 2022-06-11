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


    // 画像ファイルのチェック
    require_once('upload.php');


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

        // データベース切断
        if (mysqli_close($link)):
            echo "データを登録しました。";
            include __DIR__ . '/list.php';//これでよいのかは正直わからんが、header関数使えないので妥当かな?
            exit;
        else:
            echo 'Error: データベース接続の切断に失敗しました' . PHP_EOL;
            echo 'Debugging Error: ' . mysqli_error($link) . PHP_EOL;
        endif;
    endif;
endif;

$title = '登録画面';
$content = __DIR__ . '/views/new.php';
include __DIR__ . '/views/layout.php';

?>

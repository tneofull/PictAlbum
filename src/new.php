<?php

$filename = ""; //ある関数内部でも使用できるグローバル変数としたいために宣言しておく
require_once('dbConnection.php');


function validate($review)
{
    $errors = [];
    // 公園の名前のチェック
    if (empty($review['name'])) :
        $errors[] = '公園の名前を入力してください';
    elseif (mb_strlen($review['name']) > 100) :
        $errors[] = '公園の名前は100文字以内で入力してください';
    endif;

    // 場所のチェック
    if (!in_array($review['area'], ['葛飾区', '足立区', '新宿区', '荒川区', '杉並区'], true)) :
        $errors[] = '公園の場所は"葛飾区","足立区","新宿区","荒川区","杉並区"のいずれかを選択してください';
    endif;

    // 景観のチェック
    if (!in_array($review['view'], ['なつかしい', 'ふつう', 'きれい'], true)) :
        $errors[] = '景観は、"なつかしい","ふつう","きれい"のいずれかを選択してください';
    endif;

    // 大きさのチェック
    if (!in_array($review['size'], ['small', 'medium', 'large'], true)) :
        $errors[] = '大きさは、"small","medium","large"のいずれかを選択してください';
    endif;

    // 総合評価のチェック
    if ($review['score'] <= 0 || $review['score'] >= 6) :
        $errors[] = '総合評価は、1以上5以下の整数を選択してください';
    endif;

    // 感想のチェック
    if (empty($review['comment'])) :
        $errors[] = '感想を入力してください';
    elseif (mb_strlen($review['comment']) > 1000) :
        $errors[] = '感想は1000文字以内で入力してください';
    endif;


    // 画像ファイルのチェック
    require_once('upload.php');

    return $errors;
}

function insertTable($link,$review)
{
    global $filename; //下記では$filenameをグローバル変数として使いたいのでこの宣言が必要
    $sql = <<<EOT
    INSERT INTO parks (
    name,area,view,size,score,comment,pictname
    ) VALUES (
    "{$review['name']}",
    "{$review['area']}",
    "{$review['view']}",
    "{$review['size']}",
    "{$review['score']}",
    "{$review['comment']}",
    "{$filename}"
    )
EOT;

    if (mysqli_query($link, $sql)) {
    } else {
        echo 'Error: データの挿入に失敗しました' . PHP_EOL;
        echo 'Debugging Error: ' . mysqli_error($link) . PHP_EOL;
    }
}

// POST送信されたときのみ下記処理していく
if ($_SERVER["REQUEST_METHOD"] === 'POST'):
    // 大きさの項目はラジオボタンで、初期値が定められてないと
    // $_POST['size']が未定義となるので値がPOSTされているなら
    // 空文字で初期値を定めている

    isset($_POST['size']) ? $size = $_POST['size'] : $size = '';

    $review = [
    'name' => $_POST['name'],
    'area' => $_POST['area'],
    'view' => $_POST['view'],
    'size' => $size,
    'score' => (int)$_POST['score'],
    'comment' => $_POST['comment']
    ];

    $errors = validate($review);

    if (count($errors) > 0):
        foreach ($errors as $error):
            echo nl2br($error . PHP_EOL);
        endforeach;
    else: //$errorsの要素がない=エラーがない場合のみ下記処理する
        $link = dbConnection();
        insertTable($link,$review);

        // 登録完了&データベース切断
        if (mysqli_close($link)):
            echo nl2br("データを登録しました。" . PHP_EOL);
            include __DIR__ . '/list.php';//これでよいのかは正直わからんが、header関数使えないので妥当かな?
            exit;
        else:
            echo 'Error: データベース接続の切断に失敗しました' . PHP_EOL;
            echo 'Debugging Error: ' . mysqli_error($link) . PHP_EOL;
        endif;
    endif;
else:
    // POSTされなかった時はreview配列は未定義となるので、初期化しておく
    $review = [
        'name' => "",
        'area' => "",
        'view' => "",
        'size' => "",
        'score' => "",
        'comment' => ""
    ];
endif;

$title = '登録画面';
$content = __DIR__ . '/views/new.php';
include __DIR__ . '/views/layout.php';

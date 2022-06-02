<?php

// 名前のチェック
if (empty($_POST['name'])) :
    echo nl2br('公園名を入力してください' . PHP_EOL);
elseif (mb_strlen($_POST['name']) > 30) :
    echo nl2br('公園名は30文字以内で入力してください' . PHP_EOL);
endif;

// 場所のチェック
if (!in_array($_POST['area'],['葛飾区','足立区','新宿区','荒川区','杉並区'],true)) :
    echo nl2br('公園の場所は葛飾区,足立区,新宿区,荒川区,杉並区のいずれかを選択してください' . PHP_EOL);
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
            <label>景観</label>
            <input type="checkbox" name="test" id="test1">
            <label for="test1">きたない</label>
            <input type="checkbox" name="test" id="test2">
            <label for="test2">しぶい</label>
            <input type="checkbox" name="test" id="test3">
            <label for="test3">ふつう</label>
            <input type="checkbox" name="test" id="test5">
            <label for="test5">きれい</label>
        </div>

        <div>
            <label>大きさ</label>
            <input type="radio" name="size" id="size1" value="small">
            <label for="size1">small</label>

            <input type="radio" name="size" id="size2" value="medium">
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

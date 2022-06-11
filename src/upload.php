<?php
echo "<pre>";
var_dump($_FILES);
echo "</pre>";

// もしもファイル変数が空なら処理しない(直接ページにアクセス OR 何も選択せず送信のケースを潰す)
if (!empty($_FILES['pict']['name'])) :
    // もしも画像ファイル以外のファイル形式でアップロードされたら警告する
    $check = getimagesize($_FILES['pict']['tmp_name']);
    var_dump($check);
    if ($check[2] == TRUE):
        $filename = $_FILES['pict']['name'];
        $oldfilename = $_FILES['pict']['tmp_name'];
        $path_Dir = __DIR__ . '/img/' . $filename;

        echo nl2br("元のファイル名: " . $oldfilename . PHP_EOL);
        echo nl2br("新しいファイル名: " . $filename . PHP_EOL);
        echo nl2br("保存先フォルダ名: " . $path_Dir . PHP_EOL);

        $result = move_uploaded_file($oldfilename, $path_Dir);
        if ($result):
            echo 'ファイルをアップロードしました！ ファイル名: ' . $filename;
        else:
            echo 'ファイルのアップロードに失敗しました' . $_FILES['pict']['error'];
        endif;
    else:
        echo "適切なファイル形式の画像をアップロードしてください";
    endif;
else:
    echo "アップロードする画像ファイルが選択されていません";
endif;

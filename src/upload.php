<?php
echo "<pre>";
var_dump($_FILES);
echo "</pre>";

// ファイル変数が空なら処理しない(直接ページにアクセス OR 何も選択せず送信のケースを潰す)
if (isset($_FILES['pict']['error']) && is_int($_FILES['pict']['error'])) :
    // GIF,JPEG,PNG以外のファイル形式でアップロードされたら警告する(戻り値が1~3のいずれかならOK)
    $filetype = @exif_imagetype($_FILES['pict']['tmp_name']);
    // var_dump($filetype);
    if (in_array($filetype, [1, 2, 3], true)) :
        $filename = bin2hex(openssl_random_pseudo_bytes(4)) . image_type_to_extension($filetype);
        $originalFilename = $_FILES['pict']['tmp_name'];
        $UploadDir = __DIR__ . '/img/' . $filename;

        echo nl2br("元のファイル名: " . $originalFilename . PHP_EOL);
        echo nl2br("新しいファイル名: " . $filename . PHP_EOL);
        echo nl2br("保存先フォルダ名: " . $UploadDir . PHP_EOL);

        $result = move_uploaded_file($originalFilename, $UploadDir);
        if ($result) :
            $msg = 'ファイルをアップロードしました！ ファイル名: ' . $filename;
        else :
            $msg = 'ファイルのアップロードに失敗しました' . $_FILES['pict']['error'];
        endif;
    else :
        $msg = "GIF,JPEG,PNGいずれかのファイル形式の画像をアップロードしてください";
    endif;
else :
    $msg = "アップロードする画像ファイルが選択されていません";
endif;

echo $msg;

?>

<img src="/img/<?php echo $filename ;?>" alt="">

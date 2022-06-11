<?php
// 直接このページにアクセスされた時は登録ページにリダイレクトさせる
if ($_SERVER["REQUEST_METHOD"] !== 'POST'):
    header('Location: http://localhost:55580/new.php');
    exit;
endif;


// echo "<pre>";
// var_dump($_FILES);
// echo "</pre>";

// ファイル変数が空なら処理しない(直接ページにアクセス OR 何も選択せず送信のケースを潰す)
if (isset($_FILES['pict']['error']) && is_int($_FILES['pict']['error'])) :
    // GIF,JPEG,PNG以外のファイル形式でアップロードされたら警告する(戻り値が1~3のいずれかならOK)
    $filetype = @exif_imagetype($_FILES['pict']['tmp_name']);
    if (in_array($filetype, [1, 2, 3], true)):
        $filename = bin2hex(openssl_random_pseudo_bytes(4)) . image_type_to_extension($filetype);
        $originalFilename = $_FILES['pict']['tmp_name'];
        $UploadDir = __DIR__ . '/img/' . $filename;

        // ↓いつか、後で消す
        // echo nl2br("元のファイル名: " . $originalFilename . PHP_EOL);
        // echo nl2br("新しいファイル名: " . $filename . PHP_EOL);
        // echo nl2br("保存先フォルダ名: " . $UploadDir . PHP_EOL);

        // 画像アップロード前のバリデーションに引っ掛かっているとそもそもアップロード作業しない
        if (!count($errors) > 0):
            $result = move_uploaded_file($originalFilename, $UploadDir);
            if ($result):
                echo 'ファイルをアップロードしました！';
            else:
                $errors[] = 'ファイルのアップロードに失敗しました' . $_FILES['pict']['error'];
            endif;
        endif;
    else:
        $errors[] = "GIF,JPEG,PNGいずれかのファイル形式の画像をアップロードしてください";
    endif;
else :
    $errors[] = "アップロードする画像ファイルが選択されていません";
endif;

?>

<!-- 画像の表示テスト用であり、いつか消す -->
<img src="/img/<?php echo $filename ;?>" alt="">

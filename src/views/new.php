<form action="/new.php" method="post">
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


    <br>
    <input type="submit" value="登録">
</form>
<br>
<br>


<form action="../upload.php" method="post" enctype="multipart/form-data">
    <div>
        <label for="pict">画像</label>
        <input type="file" name="pict" id="pict">
        <input type="submit" value="アップロード">
    </div>
</form>
<a href="index.php" style="margin: 0 120px;">検索ページへ</a>
<a href="list.php" style="margin: 0 120px;">一覧ページへ</a>

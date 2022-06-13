<form action="/new.php" method="post" enctype="multipart/form-data">
    <div>
        <label for="name">公園の名前</label>
        <input type="text" id="name" name="name" value="<?php echo $review['name'] ? escape($review['name']) : ''; ?>">
    </div>


    <div>
        <label for="area">公園の場所</label>
        <select name="area" id="area">
            <option value="葛飾区" <?php echo $review['area'] === '葛飾区' ? 'selected' : ''; ?>>葛飾区</option>
            <option value="足立区" <?php echo $review['area'] === '足立区' ? 'selected' : ''; ?>>足立区</option>
            <option value="荒川区" <?php echo $review['area'] === '荒川区' ? 'selected' : ''; ?>>荒川区</option>
            <option value="新宿区" <?php echo $review['area'] === '新宿区' ? 'selected' : ''; ?>>新宿区</option>
            <option value="杉並区" <?php echo $review['area'] === '杉並区' ? 'selected' : ''; ?>>杉並区</option>
        </select>
    </div>

    <div>
        <label for="view">景観</label>
        <select name="view" id="view">
            <option value="なつかしい" <?php echo $review['view'] === 'なつかしい' ? 'selected' : ''; ?>>なつかしい</option>
            <option value="ふつう" <?php echo $review['view'] === 'ふつう' ? 'selected' : ''; ?>>ふつう</option>
            <option value="きれい" <?php echo $review['view'] === 'きれい' ? 'selected' : ''; ?>>きれい</option>
        </select>
    </div>



    <div>
        <label>大きさ</label>
        <input type="radio" name="size" id="size1" value="small" <?php echo $review['size'] === 'small' ? 'checked' : ''; ?>>
        <label for="size1">small</label>

        <input type="radio" name="size" id="size2" value="medium" <?php echo $review['size'] === 'medium' ? 'checked' : ''; ?>>
        <label for="size2">medium</label>

        <input type="radio" name="size" id="size3" value="large" <?php echo $review['size'] === 'large' ? 'checked' : ''; ?>>
        <label for="size3">large</label>
    </div>

    <div>
        <label for="score">総合評価</label>
        <select name="score" id="score">
            <option value="1" <?php echo $review['score'] === 1 ? 'selected' : ''; ?>>1</option>
            <option value="2" <?php echo $review['score'] === 2 ? 'selected' : ''; ?>>2</option>
            <option value="3" <?php echo $review['score'] === 3 ? 'selected' : ''; ?>>3</option>
            <option value="4" <?php echo $review['score'] === 4 ? 'selected' : ''; ?>>4</option>
            <option value="5" <?php echo $review['score'] === 5 ? 'selected' : ''; ?>>5</option>
        </select>
    </div>

    <div>
        <label for="comment">感想</label>
        <textarea name="comment" id="comment" cols="50" rows="5"><?php echo $review['comment'] ? $review['comment'] : ""; ?></textarea>
    </div>

    <div>
        <label for="pict">画像</label>
        <input type="file" name="pict" id="pict">
        <!-- <input type="submit" value="アップロード"> 画像だけをまずアップロード後、全体を登録みたいなことももしかしたらできるのかもやけど、このボタンは削除とした-->
    </div>

    <br>
    <input type="submit" value="登録">
</form>
<br>
<br>

<a href="index.php" style="margin: 0 120px;">検索ページへ</a>
<a href="list.php" style="margin: 0 120px;">一覧ページへ</a>

    <?php foreach ($parks as $park) : ?>
        <ul>
            <li>
                <div>
                    <div>
                        <p>公園の名前: <?php echo escape($park['name']); ?></p>
                    </div>
                    <div>
                        <p>公園の場所: <?php echo escape($park['area']); ?></p>
                    </div>
                    <div>
                        <p>景観: <?php echo escape($park['view']); ?></p>
                    </div>
                    <div>
                        <p>大きさ: <?php echo escape($park['size']); ?></p>
                    </div>
                    <div>
                        <p>総合評価: <?php echo escape($park['score']); ?></p>
                    </div>
                    <div>
                        <p>感想: <?php echo escape($park['comment']); ?><br></p>
                    </div>
                </div>
                <div>
                    <img src="/img/<?php echo escape($park['pictname']); ?>" alt="">
                </div>
            </li>
        </ul>
    <?php endforeach; ?>

    <a href="index.php" style="margin: 0 120px;">検索ページへ</a>
    <a href="new.php" style="margin: 0 120px;">登録ページへ</a>

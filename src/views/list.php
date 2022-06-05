    <?php foreach ($parks as $park) : ?>
        <ul>
            <li>
                <div>
                    <p>公園の名前: <?php echo $park['name'] . PHP_EOL; ?></p>
                </div>
                <div>
                    <p>公園の場所: <?php echo $park['area'] . PHP_EOL; ?></p>
                </div>
                <div>
                    <p>景観: <?php echo $park['view'] . PHP_EOL; ?></p>
                </div>
                <div>
                    <p>大きさ: <?php echo $park['size'] . PHP_EOL; ?></p>
                </div>
                <div>
                    <p>総合評価: <?php echo $park['score'] . PHP_EOL; ?></p>
                </div>
                <div>
                    <p>感想: <?php echo $park['comment'] . PHP_EOL; ?><br></p>
                </div>
            </li>
        </ul>
    <?php endforeach; ?>

    <a href="index.php" style="margin: 0 120px;">検索ページへ</a>
    <a href="new.php" style="margin: 0 120px;">登録ページへ</a>

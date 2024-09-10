<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>楽天スーパーSALE</title>
    <?php
        // csvファイルを読み込んで配列にする
        $file = fopen('./csv/item.csv', 'r');

        $item_lists = [];
        while ( ($data = fgetcsv($file) ) !== FALSE ) {         // csvデータをfgetcsvで配列変換　行ごと
            mb_convert_variables('UTF-8', 'SJIS-win', $data);   // Shift-JISからUTF-8に文字コードに変換
            array_push($item_lists, $data);                     // 2次元配列にする
        }
        array_shift($item_lists);                   // 1行目の見出し削除

        fclose($file);
        
        // カテゴリだけの配列つくる
        $categories = [];
        foreach ( $item_lists as $item_list ) {
                array_push($categories, $item_list[0]);
            }
        $categories = array_unique($categories);                // 重複削除

        // selectの値取得
        if ( isset($_GET["search_category"]) ) {
            $search_category = $_GET["search_category"];
        } else {
            $search_category = "全商品" ;
        }

        // 表示用配列
        $display_items = [];
        if ( $search_category === "全商品" ) {
            $display_items = $item_lists;
        } else {
            // 絞り込み表示
            $search_items = array_keys( array_column( $item_lists, 0), $search_category );
            foreach ( $search_items as $search_item ) {
                array_push($display_items, $item_lists[$search_item]);
            }
        }
    ?>
    
</head>
<body>

<header>
    <img>
    <nav>

    </nav>
</header>

<main>
    <article id="pickup">
        <section class="pointup"></section>
        <section class="coupon"></section>
        <section class="discount"></section>
    </article>

    <article id="category">
        <section class="category_content">

            <div class="category_content_searcharea">
                <form action="index.php" method = "get">
                    <input type="submit" name="search_category" value="全商品">
                        <?php
                            foreach ( $categories as $category ) {
                                if ( $category === $search_category ) {;
                                    echo '<input type="submit" name="search_category"  value="', $category, '" checked >';
                                } else {
                                    echo '<input type="submit" name="search_category"  value="', $category, '">';
                                }
                            }
                        ?>
                    </select>
                </form>
            </div>
            
            <ul class="category_content_itemarea">
                <?php
                    foreach ( $display_items as $display_item ) {
                        //echo '<div class="', $heading[0], '">', $display_item[0], '</div>';
                        echo '
                        <li>
                            <a class="item_url" href="', $display_item[1], '" target="_blank">
                                <ul>';
                                    echo '<li class="item_img><img src="', $display_item[2], '"></li>';
                                    echo '<li class="item_name">', $display_item[3], '</li>';
                                    echo '<li class="item_text">', $display_item[4], '</li>';
                                    echo '<li class="item_price">', $display_item[5], '</li>';
                                    echo '<li class="item_saleprice">', $display_item[6], '</li>';
                                    echo '
                                        <li class="item_icom">
                                            <span class="', $display_item[7], '">', $display_item[8], '</span>
                                            <span class="', $display_item[9], '"></span>
                                            <span class="', $display_item[10], '"></span>
                                        </li>';
                                echo '
                                </ul>
                            </a>
                        </li>';
                    }
                ?>
            <ul>
        </section>
    </article>

    <article id="ranking">
        <section class="ranking_kick"></section>
        <section class="ranking_skatebord"></section>
        <section class="ranking_apparel"></section>
    </article>

</main>

</body>
</html>
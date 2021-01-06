<!DOCTYPE HTML>
<head>
    <link type="text/css" rel="stylesheet" href="public/css/main.css">
</head>

<body>
    <?php
		include_once(__DIR__ . "/../../src/common/header.php");
		include_once(__DIR__ . "/../../src/common/menu.php");
    ?>
    
    <!-- TODO -->

    <?php foreach($articles as $article): ?>
    <div class="news-container">
    
        <div class="news">
        
            <img class="news-icon" src="<?= "public/uploads/articles-icons/" . $article['image'] ?>">
            <div class="news-content">

                <a href="<?= "article-", $article['articles_id'] ?>">
                <div class="news-header"><?= $article['title'] ?></div>
                </a>
                <div class="news-header-date"> posted <?= $article['date'] ?> </div>


                <div class="news-text">
                <?= $article['content'] ?>
                </div>
                <br>
                <!-- <a class="news-read-more" href="#">Read more...</a> -->
            </div>

        </div>
    </div>
    <?php endforeach; ?>
</body>
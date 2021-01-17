<?php

require_once('Repository.php');
require_once(__DIR__.'/../models/Item.php');

class ArticleRepository extends Repository 
{
    public function getArticles() {

        $stmt = $this->database->connect()->prepare("
            SELECT * FROM `articles` ORDER BY `date` DESC LIMIT 10
        ");
        
        $stmt->execute();
        
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $articles;
    }

    public function addArticle(string $title, string $content, string $filename) {
        $stmt = $this->database->connect()->prepare("
        INSERT INTO `articles`
        (`title`, `content`, `image`, `date`)
        VALUES
        (?, ?, ?, NOW());
        ");
        
        $stmt->execute([
            $title,
            $content,
            $filename
        ]);
    }
}
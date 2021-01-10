<?php

require_once 'AppController.php';

require_once __DIR__ . '/../repository/ArticleRepository.php';

class DefaultController extends AppController {
    
    public function index()
    {
        $articles = ArticleRepository::getInstance()->getArticles();
        $this->render('index', ['articles' => $articles]);
    }

    public function login()
    {
        $this->render('login');
    }

    public function register()
    {
        $this->render('register');
    }
	
	public function error404()
    {
        $this->render('404');
    }
}
<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Router::get('', 'ArticleController');
Router::get('index', 'ArticleController');
Router::get('newArticle', 'ArticleController');
Router::get('article', 'ArticleController');

Router::post('login', 'SecurityController');
Router::post('register', 'SecurityController');
Router::post('logout', 'SecurityController');
Router::post('profile', 'SecurityController');
Router::post('getPermissions', 'SecurityController');

Router::get('item', 'ItemController');
Router::post('itemSearch', 'ItemController');
Router::post('itemRender', 'ItemController');
Router::post('itemComments', 'ItemController');
Router::post('setItemCommentVote', 'ItemController');
Router::post('getItemCommentsResponse', 'ItemController');
Router::post('deleteComment', 'ItemController');
Router::post('addComment', 'ItemController');

Router::run($path);

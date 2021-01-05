<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::get('index', 'DefaultController');

Router::post('login', 'SecurityController');
Router::post('register', 'SecurityController');
	
Router::post('profile', 'SecurityController');

Router::get('item', 'ItemController');
Router::post('itemSearch', 'ItemController');
Router::post('itemRender', 'ItemController');
Router::post('itemComments', 'ItemController');

Router::run($path);

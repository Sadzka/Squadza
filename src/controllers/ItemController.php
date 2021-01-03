<?php

require_once 'AppController.php';
require_once __DIR__ . '/../repository/ItemRepository.php';

class ItemController extends AppController {
	
    public function item()
    {
        if (!$this->isGet()) {
            return;
            //TODO
        }
        $this->render('item');
    }

    public function itemSearch()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode(ItemRepository::getInstance()->searchItems($decoded));
        }
    }

    public function itemRender()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            $item = ItemRepository::getInstance()->getItem($decoded['id']);

            echo include_once(__DIR__ . '/../common/renderItem.php');
        }
    }
}
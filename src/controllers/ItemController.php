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

            $items = ItemRepository::getInstance()->searchItems($decoded);
            echo json_encode($items);
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

    public function itemComments()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            $comments = ItemRepository::getInstance()->getItemComments($decoded['id']);
            echo json_encode($comments);
        }
    }

    public function setItemCommentVote()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            $ok = ItemRepository::getInstance()->setItemCommentVote(
                $decoded['comment_id'],
                $this->currentUser->getId(),
                $decoded['value']
            );
            echo json_encode($ok);
        }
    }

    public function getItemCommentsResponse()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            $responses = ItemRepository::getInstance()->getItemCommentsResponse(
                $decoded['comment_ids'],
                $this->currentUser->getId()
            );
            
            echo json_encode($responses);
        }
    }
}


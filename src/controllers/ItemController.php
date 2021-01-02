<?php

require_once 'AppController.php';
require_once __DIR__ . '/../repository/ItemRepository.php';

class ItemController extends AppController {
	
    public function item()
    {
        if (!$this->isGet()) {
            echo "isGet<br>";
            //TODO
        }
        $itemRepository = ItemRepository::getInstance();

        $item = null;
        if (isset($_GET['id'])) {
            $item = $itemRepository->getItem($_GET['id']);
        
            if ($item == null) {
                $this->render('item', ['item'=>'notfound'] );
                return;
            }    
        }
        else if (isset($_GET['search'])) {
            $items = $itemRepository->searchItems($_GET, 0);
            $this->render('item', ['items'=>$items] );
        }
        else {
            $this->render('item');
            return;
        }

        $this->render('item', ['item'=>$item] );
    }
}
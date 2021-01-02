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
        if (isset($_GET['name']))
        {
            $item = $itemRepository->getItem($_GET['name'], '');
        }
        else if (isset($_GET['id']))
        {
            $item = $itemRepository->getItem('', $_GET['id']);
        }
        else {
            $this->render('item');
            return;
        }
        
        if ($item == null)
        {
            $this->render('item', ['item'=>'notfound'] );
            return;
        }

        $this->render('item', ['item'=>$item] );
    }
}
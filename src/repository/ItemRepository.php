<?php

require_once('Repository.php');
require_once(__DIR__.'/../models/Item.php');

class ItemRepository extends Repository 
{
	public function getItem(string $id) : ? Item {
        
        $stmt = $this->database->connect()->prepare("
            SELECT * FROM items WHERE items_id = :id
        ");
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        

        $stmt->execute();
        
        $item = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$item) return null;
        
        $damage = ($item['damage_min'] == null) ? null : [$item['damage_min'], $item['damage_max']];
        $sockets = [$item['socket1'], $item['socket2'], $item['socket3']];
        $socketBonus = ['stat' => $item['socket_bonus_type'], 'value' => $item['socket_bonus_value']];

        $stats = [];
        foreach (range(1, 4) as $i) {
            if ( !is_null($item['stat_type' . $i]) ) {
                $stats[] = [
                    'stat'  => $item['stat_type'  . $i],
                    'value' => $item['stat_value' . $i]
                ];
            }
        }

        return new Item(
            $item['items_id'],
            $item['icon'],
            $item['quality'],
            $item['name'],
            $item['item_level'],
            $item['bind_on_pick_up'],
            $item['is_unique'],
            $item['equip_type'],
            $item['slot'],
            $damage,
            $item['speed'],
            $stats,
            $sockets,
            $socketBonus,
            $item['required_level'],
            $item['sell_price']
        );
        /*
		return new item(
            "inv_axe_113",
            5,
            "Shadowmourne",
            272,
            true,
            true,
            "Two-Hand",
            "Sword",
            [515, 648],
            3.6,
            [['stat' => 'Stamina',  'value' => 70],
             ['stat' => 'Strength', 'value' => 70],
             ['stat' => 'Crit',     'value' => 70],
             ['stat' => 'Haste',    'value' => 70]],
            ['red', 'green', 'blue', 'gray'],
            ['stat' =>'Strength', 'value' => '10'],
            50,
            132087
        );
        */  
	}

    public function searchItems($args) {

        if (!isset($args['name'])) {
            $args['name'] = '';
        }
        if (!isset($args['ilvmin']) || $args['ilvmin'] == '') {
            $args['ilvmin'] = '0';
        }
        if (!isset($args['ilvmax']) || $args['ilvmax'] == '') {
            $args['ilvmax'] = '9999';
        }
        if (!isset($args['reqlvmin']) || $args['reqlvmin'] == '') {
            $args['reqlvmin'] = '0';
        }
        if (!isset($args['reqlvmax']) || $args['reqlvmax'] == '') {
            $args['reqlvmax'] = '9999';
        }
        $args['name'] = '%' . $args['name'] . '%';

        $ask = "SELECT `name`, `quality`, `items_id`, `item_level`, `required_level`, `slot`, `equip_type` FROM items
        WHERE
        `name` like :name
        AND
        `item_level` between :ilvmin and :ilvmax
        AND
        `required_level` between :reqlvmin and :reqlvmax
        ";

        $length_slots = 0;
        if (isset($args['slot']) && count($args['slot']) > 0)
        {
            $length_slots = count($args['slot']);
            $ask = $ask . " AND ( slot = :slot0 ";

            for ($i = 1; $i < $length_slots; $i++) {
                $ask = $ask . " OR slot = :slot" . $i . " ";
            }
            $ask = $ask . " ) ";
        }

        $length_rarity = 0;
        if (isset($args['rarity']) && count($args['rarity']) > 0)
        {
            $length_rarity = count($args['rarity']);
            $ask = $ask . " AND ( quality = :quality0 ";

            for ($i = 1; $i < $length_rarity; $i++) {
                $ask = $ask . " OR quality = :quality" . $i . " ";
            }
            $ask = $ask . " ) ";
        }
        //echo $ask;
        $stmt = $this->database->connect()->prepare($ask);
        /*
                echo $ask . '<br>';
                echo $args['name'] . '<br>';
                echo $args['ilvmin'] . '<br>';
                echo $args['ilvmax'] . '<br>';
                echo $args['reqlvmin'] . '<br>';
                echo $args['reqlvmax'] . '<br>';
        */
        $stmt->bindParam(':name',       $args['name'],      PDO::PARAM_STR);
        $stmt->bindParam(':ilvmin',     $args['ilvmin'],    PDO::PARAM_STR);
        $stmt->bindParam(':ilvmax',     $args['ilvmax'],    PDO::PARAM_STR);
        $stmt->bindParam(':reqlvmin',   $args['reqlvmin'],  PDO::PARAM_STR);
        $stmt->bindParam(':reqlvmax',   $args['reqlvmax'],  PDO::PARAM_STR);
        
        for ($i = 0; $i < $length_slots; $i++) {
            $stmt->bindParam(':slot' . $i,       $args['slot'][$i],      PDO::PARAM_STR);
        }
        for ($i = 0; $i < $length_rarity; $i++) {
            $stmt->bindParam(':quality' . $i,    $args['rarity'][$i],    PDO::PARAM_STR);
        }

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getItemComments(string $id) {

        $stmt = $this->database->connect()->prepare("
            SELECT * FROM `v_items_comment` WHERE `items_id` = :id ORDER BY `date` DESC
        ");
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        
        $stmt->execute();
        
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $comments;
    }

    public function setItemCommentVote($comment_id, $userId, $value) {
        $stmt = $this->database->connect()->prepare("SELECT setItemCommentVote(:comment_id, :user_id, :value) as score");
        $stmt->bindParam(':comment_id', $comment_id, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $stmt->bindParam(':value', $value, PDO::PARAM_STR);

        $stmt->execute();

        $new_value = $stmt->fetch(PDO::FETCH_ASSOC);
        return $new_value;
    }

    public function getItemCommentsResponse($commentIds, $userId) {

        $ask = "SELECT `items_comment_id`, `positive` FROM `items_comment_likes` WHERE `users_id` = :user_id"; 

        $length_ids = 0;
        if (isset($commentIds) && count($commentIds) > 0)
        {
            $length_ids = count($commentIds);
            $ask = $ask . " AND ( `items_comment_id` = :id0 ";

            for ($i = 1; $i < $length_ids; $i++) {
                $ask = $ask . " OR `items_comment_id` = :id" . $i . " ";
            }
            $ask = $ask . " ) ";
        }
  
        $stmt = $this->database->connect()->prepare($ask);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_STR);
        for ($i = 0; $i < $length_ids; $i++) {
            $stmt->bindParam(':id' . $i, $commentIds[$i], PDO::PARAM_STR);
        }

        $stmt->execute();
        $responses = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $responses;
    }

    public function deleteItemComment($commentId, $userId, $userPerm) {
        $stmt = $this->database->connect()->prepare(
            'DELETE FROM `items_comment` WHERE
            `items_comment_id` = ? AND (`users_id` = ? OR "ADMIN" = ? OR "MODERATOR" = ?)
        ');
        
        $stmt->execute([
            $commentId,
            $userId,
            $userPerm,
            $userPerm
        ]);
    }

    public function addItemComment($itemId, $userId, $comment) {

        $stmt = $this->database->connect()->prepare("
            INSERT INTO `items_comment` (`items_id`, `users_id`, `comment`, date)
            VALUES (?, ?, ?, NOW())
        ");

        $stmt->execute([
            $itemId,
            $userId,
            $comment
        ]);

        $stmt = $this->database->connect()->prepare("
        SELECT `items_comment_id`, `date` FROM `items_comment`
        WHERE `items_id` = ? AND `users_id` = ? AND `comment` = ?");

        $stmt->execute([
            $itemId,
            $userId,
            $comment
        ]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
}


<?php

require_once('Repository.php');
require_once(__DIR__.'/../models/Item.php');

class ItemRepository extends Repository 
{
	public function getItem(string $name, string $id) : ? Item {
        
        if ($name != "")
        {
            $stmt = $this->database->connect()->prepare("
                SELECT * FROM items WHERE name = :name
            ");
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        }
        else 
        {
            $stmt = $this->database->connect()->prepare("
                SELECT * FROM items WHERE items_id = :id
            ");
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        }

        $stmt->execute();
        
        $item = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$item) return null;
        
        $damage = [$item['damage_min'], $item['damage_max']];
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
}
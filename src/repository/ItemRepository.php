<?php

require_once('Repository.php');
require_once(__DIR__.'/../models/Item.php');

class ItemRepository extends Repository 
{
	public function getItem(string $name, string $id) : ? Item {
        
        /*
        TODO

		$stmt = $this->database->connect()->prepare("
			SELECT * FROM users WHERE email = :email
		");
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->execute();
		
		$item = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if (!$item) return null;
		*/
		
		return new item(
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
        
	}
	

}
<?php

class Item
{
	private $icon;
    private $quality;
    private $name;
    private $itemLevel;
    private $bindOnPickUp;
    private $unique;
    private $equipType;
    private $slot;
    private $damage;
    private $speed;
    private $stats;
    private $sockets;
    private $socketBonus;
    private $requiredLevel;
    private $sellPrice;
    
    function __construct(
		$icon,
        $quality,
        $name,
        $itemLevel,
        $bindOnPickUp,
        $unique,
        $equipType,
        $slot,
        $damage,
        $speed,
        $stats,
        $sockets,
        $socketBonus,
        $requiredLevel,
        $sellPrice)
    {
        $this->icon          	= $icon;
        $this->quality          = $quality;
        $this->name             = $name;
        $this->itemLevel        = $itemLevel;
        $this->bindOnPickUp     = $bindOnPickUp;
        $this->unique           = $unique;
        $this->equipType        = $equipType;
        $this->slot             = $slot;
        $this->damage           = $damage;
        $this->speed            = $speed;
        $this->stats            = $stats;
        $this->sockets          = $sockets;
        $this->socketBonus      = $socketBonus;
        $this->requiredLevel    = $requiredLevel;
        $this->sellPrice        = $sellPrice;
    }

	function getName() { 
 		return $this->name; 
	} 

	function setName($name) {  
		$this->name = $name; 
	} 

	function getItemLevel() { 
 		return $this->itemLevel; 
	} 

	function setItemLevel($itemLevel) {  
		$this->itemLevel = $itemLevel; 
	} 

	function isBindOnPickUp() { 
 		return $this->bindOnPickUp; 
	} 

	function setBindOnPickUp($bindOnPickUp) {  
		$this->bindOnPickUp = $bindOnPickUp; 
	} 

	function isUnique() { 
 		return $this->unique; 
	} 

	function setUnique($unique) {  
		$this->unique = $unique; 
	} 

	function getEquipType() { 
 		return $this->equipType; 
	} 

	function setEquipType($equipType) {  
		$this->equipType = $equipType; 
	} 

	function getSlot() { 
 		return $this->slot; 
	} 

	function setSlot($slot) {  
		$this->slot = $slot; 
	} 

	function getDamage() { 
 		return $this->damage; 
	} 

	function setDamage($damage) {  
		$this->damage = $damage; 
	} 

	function getSpeed() { 
 		return $this->speed; 
	} 

	function setSpeed(float $speed) {  
		$this->speed = $speed; 
	} 

	function getStats() { 
 		return $this->stats; 
	} 

	function setStats($stats) {  
		$this->stats = $stats; 
	} 

	function getSockets() { 
 		return $this->sockets; 
	} 

	function setSockets($sockets) {  
		$this->sockets = $sockets; 
	} 

	function getRequiredLevel() { 
 		return $this->requiredLevel; 
	} 

	function setRequiredLevel(int $requiredLevel) {  
		$this->requiredLevel = $requiredLevel; 
	} 

	function getSellPrice() { 
 		return $this->sellPrice; 
	} 

	function setSellPrice(int $sellPrice) {  
		$this->sellPrice = $sellPrice; 
	} 

	function getQuality() { 
 		return $this->quality; 
	} 

	function setQuality(int $quality) {  
		$this->quality = $quality; 
	} 

	function getSocketBonus() { 
 		return $this->socketBonus; 
	} 

	function setSocketBonus($socketBonus) {  
		$this->socketBonus = $socketBonus; 
	} 

	function getIcon() { 
 		return $this->icon; 
	} 

	function setIcon($icon) {  
		$this->icon = $icon; 
	} 
}
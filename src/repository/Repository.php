<?php

require_once (__DIR__ . '/../../Database.php');

class Repository 
{
	protected $database;
    private static $instances = [];

    protected function __construct() {
			$this->database = new Database();
	}
	
    protected function __clone() { }
    
	public function __wakeup() {
        throw new \Exception("Cannot unserialize a singleton Database class.");
    }

    public static function getInstance() : Repository
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }
}
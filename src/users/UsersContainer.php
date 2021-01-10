<?php

// require_once (__DIR__ . '/../../Database.php');

require_once(__DIR__.'/../models/User.php');

class UsersContainer 
{
    private static $instances = [];
    private $users = [];

    protected function __construct() {
		
	}
	
    protected function __clone() { }
    
	public function __wakeup() {
        throw new \Exception("Cannot unserialize a singleton UsersContainer class.");
    }

    public static function getInstance() : UsersContainer
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    public function addUsers(User $user) {
        array_push($users, $user);
    }

    public function getUserByCookie(string $cookie) {
        foreach($this->users as $user) {
            if ($user->getCookie() == $cookie) {
                return $user;
            }
        }
        return null;
    }
}
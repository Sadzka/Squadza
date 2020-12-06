<?php

class User {
    private $email;
    private $password;
    private $username;

    public function __construct(
        string $email,
        string $password,
        string $username
    ) {
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
    }
	
    public function getUsername(): string 
    {
        return $this->username;
    }
	
    public function getEmail(): string 
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }
}
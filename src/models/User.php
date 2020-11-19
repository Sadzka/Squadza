<?php

class User {
    private $email;
    private $password;
    private $name;

    public function __construct(
        string $email,
        string $password,
        string $name
    ) {
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
    }
	
    public function getName(): string 
    {
        return $this->name;
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
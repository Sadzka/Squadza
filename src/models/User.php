<?php

class User {
    private $email;
    private $password;
    private $username;
    private $cookie;
    private $cookie_expire;
    private $avatar;

    public function __construct(
        string $email,
        string $username,
        string $password,
        string $cookie = '',
        string $cookie_expire = '0',
        string $avatar = "default.png"
    )
    {
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->cookie = $cookie;
        $this->cookie_expire = $cookie_expire;
        $this->avatar = $avatar;
    }

    public function setCookie(string $cookie, $cookie_expire)
    {
        $this->cookie = $cookie;
        $this->cookie_expire = $cookie_expire;
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

    public function getCookie()
    {
        return $this->cookie;
    }

    public function getCookieExpire()
    {
        return $this->cookie_expire;
    }

    public function setAvatar(string $avatarpath)
    {
        $this->avatar = $avatarpath;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }


}
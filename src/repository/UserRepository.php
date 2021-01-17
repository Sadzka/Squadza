<?php

require_once('Repository.php');
require_once(__DIR__.'/../models/User.php');

class UserRepository extends Repository 
{
	public function getUser(string $email) : ? User {
		
		$stmt = $this->database->connect()->prepare("
			SELECT email, username, password FROM users WHERE email = :email
		");
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->execute();
		
		$user = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if (!$user) return null;
		
		return new User(
			$user['email'],
			$user['username'],
			$user['password']
		); 
	}
	
	public function createUser(string $email, string $username, string $password) {

		$stmt = $this->database->connect()->prepare('
			INSERT INTO `users` (`username`, `password`, `email`)
			VALUES (?, ?, ?)
		');

		try {
			$stmt->execute([
				$username,
				$password,
				$email
			]);
		} catch (PDOException $e) {

			$error = $e->errorInfo[2];

			$pos_start = strpos($error, "key '");
			$error = substr( $error, $pos_start + 5 );
			$error = substr( $error, 0, strlen($error) - 1 );

			if ($error == 'UNIQUE_EMAIL') { return 1; }
			if ($error == 'UNIQUE_USERNAME') { return 2; }
		}
		return 0;
	}

	public function setUserCookie(string $email, string $cookie, $cookie_expire) 
	{
		$stmt = $this->database->connect()->prepare("
		UPDATE users
		SET
		cookie = :cookie,
		cookie_expire = :cookie_expire
		WHERE
		email = :email
		");
		$stmt->bindParam(':cookie', $cookie, PDO::PARAM_STR);
		$stmt->bindParam(':cookie_expire', $cookie_expire, PDO::PARAM_STR);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->execute();
	}

	public function getUserByCookie(string $cookie) {

		$stmt = $this->database->connect()->prepare("
			SELECT * FROM users WHERE cookie = :cookie
		");
		$stmt->bindParam(':cookie', $cookie, PDO::PARAM_STR);
		$stmt->execute();
		
		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		if (!$user) return null;
		
		return new User(
			$user['email'],
			$user['username'],
			$user['password'],
			$user['cookie'],
			$user['cookie_expire'],
			$user['avatar'],
			$user['id_users'],
			$user['permissions']
		); 
	}

	public function setUserAvatar(string $email, string $avatarpath) {
		$stmt = $this->database->connect()->prepare("
		UPDATE users
		SET
		avatar = :avatar
		WHERE
		email = :email
		");

		$stmt->bindParam(':avatar', $avatarpath, PDO::PARAM_STR);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->execute();
	}
}
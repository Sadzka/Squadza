<?php

require_once('Repository.php');
require_once(__DIR__.'/../models/User.php');

class UserRepository extends Repository 
{
	public function getUser(string $email) : ? User {
		
		$stmt = $this->database->connect()->prepare("
			SELECT * FROM users WHERE email = :email
		");
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->execute();
		
		$user = $stmt->fetch(PDO::FETCH_ASSOC);
		
		/*
		if (!$user) {
			throw new ErrorException("User not found in database.");
		}
		*/
		
		if (!$user) return null;
		
		return new User(
			$user['email'],
			$user['username'],
			$user['password']
		); 
	}
	
	public function createUser($email, $username, $password) {

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
}
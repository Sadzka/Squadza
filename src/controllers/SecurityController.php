<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repository/UserRepository.php';

class SecurityController extends AppController {

	private $messages = [];
	const MAX_FILE_SIZE = 1024 * 1024;
	const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
	const UPLOAD_DIRECTORY = '/../public/uploads/';
	
	private function validateImage($file) : bool {

		if ($file['size'] > self::MAX_FILE_SIZE) {
			$this->messages[] = 'File is too large. Max size is'. self::MAX_FILE_SIZE . '.';
			return false;
		}
		
		if (isset($file['type']) && !in_array($file['type'], self::SUPPORTED_TYPES)) {
			$this->messages[] = 'Invalid file format';
			return false;
		}
		return true;
	}
	
    public function login()
    {   
        // $user = new User('qwe@qwe.qwe', 'qwe', 'Qwe');
		
        if (!$this->isPost()) {
            return $this->render('login');
        }
		
		if (!isset($_POST['email']) || !isset($_POST['password'])) {
            return $this->render('login');
		}

        $email = $_POST['email'];
        $password = $_POST['password'];

		$user = UserRepository::getInstance()->getUser($email);
		
		$password = password_hash($password, PASSWORD_BCRYPT);
		
		if ($user == null
		||  $user->getEmail() !== $email
		||  $user->getPassword() !== $password) {
			return $this->render('login', ['messages' => ['Wrong email or password!']]);
		}

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/index");
		// TODO
    }
	
	public function register()
	{
		if (!$this->isPost()) {
            return $this->render('register');
        }
		
		if (!isset($_POST['email'])
		||  !isset($_POST['username'])
		||  !isset($_POST['password'])
		||  !isset($_POST['passwordC'])) {
            return $this->render('register');
		}

		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$passwordConfirmed = $_POST['passwordC'];

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return $this->render('register', ['messages' => ['Wrong email!']]);
		}

		if (strlen($username) < 3) {
			return $this->render('register', ['messages' => ['Username must have at least 3 characters!']]);
		}

		if (!preg_match('/^[a-zA-Z0-9 ]+$/', $username)) {
			return $this->render('register', ['messages' => ['Username can only contain letters and numbers!']]);
		}

		if (strcmp($password, $passwordConfirmed) != 0) {
			return $this->render('register', ['messages' => ['Password does not match!']]);
		}

		if (strlen($password) < 8) {
			return $this->render('register', ['messages' => ['Password must have at least 8 characters!']]);
		}

		$password = password_hash($password, PASSWORD_BCRYPT);
		$result = UserRepository::getInstance()->createUser($email, $username, $password);

		if ($result == 1) { return $this->render('register', ['messages' => ['Email already taken!']]); } 
		else if ($result == 2) { return $this->render('register', ['messages' => ['Username already taken!']]); }
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/index");
	}
	
	public function profile()
    {
		
		if ($this->isPost()
		&& is_uploaded_file( $_FILES['file']['tmp_name'])
		&& $this->validateImage($_FILES['file']))
		{
			if (move_uploaded_file(
			$_FILES['file']['tmp_name'],
			dirname(__DIR__) . self::UPLOAD_DIRECTORY.$_FILES['file']['name']
			)) {
				$this->messages[] = 'Avatar changed.';
			}
			else {
				$this->messages[] = 'Unknown error. Try again.';
			}
		}
		$this->render('profile', ['messages' => $this->messages]);		
		
    }
}
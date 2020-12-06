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
		$userRepository = UserRepository::getInstance();
		
        if (!$this->isPost()) {
            return $this->render('login');
        }
		
		if (!isset($_POST['email']) || !isset($_POST['password'])) {
            return $this->render('login');
		}

        $email = $_POST['email'];
        $password = $_POST['password'];

		$user = $userRepository->getUser($email);
		
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
		return $this->render('register');
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
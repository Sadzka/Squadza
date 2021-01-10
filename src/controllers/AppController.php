<?php

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repository/UserRepository.php';

class AppController {

    private $request;
    protected $currentUser;

    public function __construct()
    {
        $this->request = $_SERVER['REQUEST_METHOD'];
        $this->getCurrentUser();
    }

    protected function getCurrentUser() {
        if (isset($_COOKIE['sessionid'])) {
            $this->currentUser = UserRepository::getInstance()->getUserByCookie($_COOKIE['sessionid']);
            // check outdated cookies
            if ($this->currentUser != null
            &&  $this->currentUser->getCookieExpire() < time() ) {
                $this->currentUser = null;
            }

        } else {
            $this->currentUser = null;
        }
    }


    protected function isGet(): bool
    {
        return $this->request === 'GET';
    }

    protected function isPost(): bool
    {
        return $this->request === 'POST';
    }

    protected function render(string $template = null, array $variables = [])
    {
        $templatePath = 'public/views/'. $template.'.php';
        $output = '';
                
        if (file_exists($templatePath)) {
            extract($variables);
            
            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }
		else {
			ob_start();
            include 'public/views/404.php';
            $output = ob_get_clean();
		}
        print $output;
    }
}

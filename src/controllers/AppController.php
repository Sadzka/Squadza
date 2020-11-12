<?php

class AppController {

    protected function render(string $template = null, array $variables = [])
    {
        $templatePath = 'public/views/'. $template.'.html';
        $output = '';
                
        if(file_exists($templatePath)){
            extract($variables);
            
            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }
		else {
			ob_start();
            include 'public/views/404.html';
            $output = ob_get_clean();
		}
        print $output;
    }
}

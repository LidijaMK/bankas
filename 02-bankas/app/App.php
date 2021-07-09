<?php
namespace Bank;

class App {

    public static function start()
    {
        ob_start();
        self::router();
        ob_end_flush();
    }

    public static function view($file, $data = [])
    {
        extract($data);
        require DIR. 'views/'.$file.'.php';
    }
    
    public static function redirect($path = '', $id = 0) 
    {
        if ($id) {
            header('Location: '.URL.$path.'/'.$id);
        }
        else {
            header('Location: '.URL.$path);
        }
        die;
    }

    private static function router() 
    {
        // $uri = str_replace(INSTALL_DIR, '', $_SERVER['REQUEST_URI']);
        $uri = $_SERVER['REQUEST_URI'];
        $uri = explode('/', $uri);
        array_shift($uri);

        if ('create-account' == $uri[0]) {
            if ('GET' == $_SERVER['REQUEST_METHOD']) {
                return (new SaskaitosController)->create();
            }
            else {
                return (new SaskaitosController)->save();
            }
        }

        if ('add' == $uri[0] && isset($uri[1])) {
            if ('GET' == $_SERVER['REQUEST_METHOD']) {
                return (new SaskaitosController)->add($uri[1]);
            }
            else {
                return (new SaskaitosController)->doAdd($uri[1]);
            }
        }

        if ('deduct' == $uri[0] && isset($uri[1])) {
            if ('GET' == $_SERVER['REQUEST_METHOD']) {
                return (new SaskaitosController)->deduct($uri[1]);
            }
            else {
                return (new SaskaitosController)->doDeduct($uri[1]);
            }
        }
                
        if ('delete' == $uri[0] && isset($uri[1]) && 'POST' == $_SERVER['REQUEST_METHOD']) {
            return (new SaskaitosController)->delete($uri[1]);
        }

        if ($uri[0] === '' && count($uri) === 1) {
            return (new SaskaitosController)->index();
        }

        // LOGIN

        if ('login' == $uri[0]) {
            if ('GET' == $_SERVER['REQUEST_METHOD']) {
                return (new LoginController)->showLogin();
            } 
            return (new LoginController)->login();
        }
       
        if ('logout' == $uri[0]) {
            if ('GET' == $_SERVER['REQUEST_METHOD']) {
                return (new LoginController)->logout();
            }
        }

        if (!isset($_SESSION['logged'])) {
            return (new LoginController)->showLogin();
        }
        self::view('404');
        http_response_code(404);
    }
}
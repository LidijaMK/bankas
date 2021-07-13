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

    public static function accGenerator()
    {
        return 'LT3870440' . rand(10000000000, 99999999999);
    }

    public static function checkLogin() 
    {
        if (!isset($_SESSION['logged'])) {
            self::redirect('login');
        }
    }

    private static function router() 
    {
        // $uri = str_replace(INSTALL_DIR, '', $_SERVER['REQUEST_URI']);
        $uri = $_SERVER['REQUEST_URI'];
        $uri = explode('/', $uri);
        array_shift($uri);

        if ('login' == $uri[0]) {
            if ('GET' == $_SERVER['REQUEST_METHOD']) {
                return (new LoginController)->showLogin();
            } 
            else {
                return (new LoginController)->doLogin();
            }
        }
       
        if ('logout' == $uri[0]) {
            if ('GET' == $_SERVER['REQUEST_METHOD']) {
                return (new LoginController)->logout();
            }
        }

        if ('create-account' == $uri[0]) {
            self::checkLogin();
            if ('GET' == $_SERVER['REQUEST_METHOD']) {
                return (new SaskaitosController)->create();
            }
            else {
                return (new SaskaitosController)->save();
            }
        }

        if ('add' == $uri[0] && isset($uri[1])) {
            self::checkLogin();
            if ('GET' == $_SERVER['REQUEST_METHOD']) {
                return (new SaskaitosController)->add($uri[1]);
            }
            else {
                return (new SaskaitosController)->doAdd($uri[1]);
            }
        }

        if ('deduct' == $uri[0] && isset($uri[1])) {
            self::checkLogin();
            if ('GET' == $_SERVER['REQUEST_METHOD']) {
                return (new SaskaitosController)->deduct($uri[1]);
            }
            else {
                return (new SaskaitosController)->doDeduct($uri[1]);
            }
        }
                
        if ('delete' == $uri[0] && isset($uri[1]) && 'POST' == $_SERVER['REQUEST_METHOD']) {
            self::checkLogin();
            return (new SaskaitosController)->delete($uri[1]);
        }      

        if ($uri[0] === '' && count($uri) === 1) {
            return (new SaskaitosController)->index();
        }
        self::view('404');
        http_response_code(404);
    }
}
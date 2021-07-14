<?php
namespace Bank;

class LoginController {
    
//    private static $dbType = 'json';
   private static $dbType = 'maria';
    
   public static function getData()
   {
       if (self::$dbType == 'json') {
           return Json::getJson();
       }
       if (self::$dbType == 'maria') {
           return Maria::getMaria();
       }
   }    

    public function showLogin() 
    {
        return App::view('login');
    }

    public function doLogin()
    { 
        $name = $_POST['name'];
        $passw = md5($_POST['passw']);

        $user = self::getData()->getUser($name, $passw);

        if (empty($user)){
            Messages::setMessage('Neteisingas vartotojo vardas arba slaptažodis', 'danger');
            App::redirect('login');
        }
        $_SESSION['logged'] = 1;
        $_SESSION['name'] = $user;
        Messages::setMessage('Sveiki, ' . $name, 'success');
        Messages::setOld('name', $_POST['name']);
        App::redirect();
    }
    
    public function logout()
    {
        unset($_SESSION['logged'], $_SESSION['name']);
        Messages::setMessage('Jūs sėkmingai atsijungėte. Geros dienos!', 'success');
        App::redirect('login');
    }  
}
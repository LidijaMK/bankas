<?php
namespace Bank;

class LoginController {

    public function showLogin() 
    {
        return App::view('login');
    }

    public function login()
    {
        $users = json_decode(file_get_contents(DIR.'/users.json'), 1);
        foreach ($users as $user) {
            if ($user['name'] == $_POST['name']) {
                if ($user['passw'] == md5($_POST['passw'])) {
                    $_SESSION['logged'] = 1;
                    $_SESSION['name'] = $user['name'];
                    Messages::setMessage('Sveiki, ' . $user['name'], 'success');
                    Messages::setOld('name', $_POST['name']);
                    App::redirect();
                }
            } 
        }
        Messages::setMessage('Neteisingas vartotojo vardas arba slaptažodis', 'danger');
        App::redirect('login');
    }

    public function logout()
    {
        unset($_SESSION['logged'], $_SESSION['name']);
        Messages::setMessage('Jūs sėkmingai atsijungėte. Geros dienos!', 'success');
        App::redirect('login');
    }  
}
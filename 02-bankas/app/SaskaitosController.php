<?php
namespace Bank;

class SaskaitosController {

    // private static $dbType = 'json';
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

    public function index() 
    {
        return App::view('index', ['accounts' =>  self::getData()->showAll()]);
    }

    public function add($id)
    {
        return App::view('add', ['id' =>$id, 'accounts' => self::getData()->showAll()]);
    }

    public function doAdd($id)
    {
        $id = (int) $id;
        $account = self::getData()->show($id);
        $amount = $_POST['amount'];
        if (!is_numeric($_POST['amount'])) {
            $searchForVal = ',';
            if (strpos($amount, $searchForVal) != false) {
                $amount = str_replace(',', '.', $amount);
            }
        }
        if (!is_numeric($amount)) {
            Messages::setMessage('Lėšų pridėti nepavyko, prašome įvesti skaičių', 'warning');
            Messages::setOld('amount', $_POST['amount']);
            App::redirect('add', $id);
        } 
        elseif ($amount <= 0) {
            Messages::setMessage('Lėšų pridėti nepavyko: neigiamos pinigų sumos pridėti negalima', 'warning');
            Messages::setOld('amount', $_POST['amount']);
            App::redirect('add', $id);
        } 
        else {
            $amount = round($amount, 2);
            $account['balance'] += $amount;
            Messages::setMessage('Sąskaita (id: ' . $account['id'] . ') papildyta ' . $amount . ' Eur', 'success');
            Messages::setOld('amount', $_POST['amount']);
        }
        self::getData()->update($id, $account);
        App::redirect();
    }

    public function deduct($id)
    {
        return App::view('deduct', ['id' =>$id, 'accounts' => self::getData()->showAll()]);
    }

    public function doDeduct($id)
    {
        $id = (int) $id;
        $account = self::getData()->show($id);
        $amount = $_POST['amount'];
        if (!is_numeric($_POST['amount'])) {
            $searchForVal = ',';
            if (strpos($amount, $searchForVal) != false) {
                $amount = str_replace(',', '.', $amount);
            }
        }
        if (!is_numeric($amount)) {
            Messages::setMessage('Lėšų nuskaičiuoti nepavyko, prašome įvesti skaičių', 'warning');
            Messages::setOld('amount', $_POST['amount']);
            App::redirect('deduct', $id);
        }
        elseif ($account['balance'] < $amount) {
            Messages::setMessage('Nepakankamas likutis', 'warning');   
            Messages::setOld('amount', $_POST['amount']);
            App::redirect('deduct', $id);
        } 
        elseif ($amount < 0) {
            Messages::setMessage('Neigiamos pinigų sumos nuskaičiuoti negalima', 'warning');
            Messages::setOld('amount', $_POST['amount']);
            App::redirect('deduct', $id);
        }
        else {
            $amount = round($amount, 2);
            $account['balance'] -= $amount;
            Messages::setMessage('Iš sąskaitos (id: ' . $account['id'] . ') nuskaičiuota ' . $amount . ' Eur', 'success');
            Messages::setOld('amount', $_POST['amount']);
        }
        self::getData()->update($id, $account);
        App::redirect();
    }

    public function delete($id)
    {
        $id = (int) $id;
        $account = self::getData()->show($id);
        if ($account['id'] == $id && $account['balance'] == 0) {
            self::getData()->delete($id);
            Messages::setMessage('Sąskaita (id: ' .$account['id'] . ') sėkmingai ištrinta', 'success');
            Messages::setOld('balance', $account['balance']);
            App::redirect();
        } elseif ($account['id'] == $id && $account['balance'] > 0) {
            Messages::setMessage('Sąskaitos, kurioje yra lėšų ištrinti negalima', 'warning');
            Messages::setOld('balance', $account['balance']);
            App::redirect();
        }  
    }
    
    public function create() 
    {
        return App::view('create_account');
    }

    public function save() 
    { 
        if (!(Validator::isValidName($_POST['name']))) {
            Messages::setMessage('Naujos sąskaitos pridėti nepavyko, klaidingas kliento vardas', 'danger');
            Messages::setOld('name', $_POST['name']);
            $err = true;
        } 
        else {
            Messages::setOld('name', $_POST['name']); 
        }
        if (!(Validator::isValidName($_POST['surname']))) {
            Messages::setMessage('Naujos sąskaitos pridėti nepavyko, klaidinga kliento pavardė', 'danger');
            Messages::setOld('surname', $_POST['surname']);
            $err = true;
        } 
        else {
            Messages::setOld('surname', $_POST['surname']); 
        }
        if (!(Validator::isValidPersonalID($_POST['personalId']))) {
            Messages::setMessage('Naujos sąskaitos pridėti nepavyko, klaidingas asmens kodas', 'danger');
            Messages::setOld('personalId', $_POST['personalId']);
            $err = true;
        } 
        else {
            Messages::setOld('personalId', $_POST['personalId']); 
        } 

        if (Validator::isValidPersonalID($_POST['personalId'])) {
            $personalId = $_POST['personalId'];
                if (self::getData()->getPersonalId($personalId)) {
                    Messages::setOld('personalId', $_POST['personalId']);
                } 
                else {
                    Messages::setMessage('Naujos sąskaitos pridėti nepavyko, toks asmens kodas jau yra', 'danger');
                    Messages::setOld('personalId', $_POST['personalId']);
                    $err = true;
                }  
        } 
        if (!isset($err)){
            $account = [
               'id' => rand(10000000, 99999999),  
                'name' => $_POST['name'], 
                'surname' => $_POST['surname'], 
                'accountNo' => $_POST['accountNo'], 
                'personalId' => $_POST['personalId'],
                'balance' => 0 
            ];
            
           self::getData()->create($account);

           
            Messages::setMessage('Nauja sąskaita sėkmingai pridėta, klientas: ' . $account['name'] .' ' . $account['surname'] . ' , sąskaitos Nr. ' . $account['accountNo'], 'success');
            App::redirect();
        } 
        else {
            App::redirect('create-account', $id);
        }
    }   
}
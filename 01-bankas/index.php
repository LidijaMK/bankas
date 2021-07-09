<?php
require __DIR__ . '/bootstrap.php';
if (!isset($_SESSION['logged'])) {
    header('Location: http://localhost/bankas/01-bankas/login.php');
    die;
}

function accGenerator() 
{ 
    return $accNo = 'LT3870440' . rand(10000000000, 99999999999);       
}

function isValidPersonalID($ak) 
{
    if (strlen($ak) == 11 && $ak[0] > 2 && $ak [0] < 7) {
        if (checkdate(substr($ak, 3, 2), substr($ak, 5, 2), substr($ak, 1, 2))) {
            $suma = $ak[0] * 1 + $ak[1] *2 + $ak[2] * 3 + $ak[3] * 4 + $ak[4] * 5 + $ak[5] * 6 + $ak[6] * 7 + $ak[7] * 8 + $ak[8] * 9 + $ak[9] * 1;
            if ($suma % 11 == 10) {
                $suma = $ak[0] * 3 + $ak[1] * 4 + $ak[2] * 5 + $ak[3] * 6 + $ak[4] * 7 + $ak[5] * 8 + $ak[6] * 9 + $ak[7] * 1 + $ak[8] * 2 + $ak[9] * 3;
                if ($suma % 11 == 10 && substr($ak, 10, 1) == 0) {
                    return true;
                } elseif ($suma % 11 == substr($ak, 10, 1)) {
                    return true;
                }
            } elseif ($suma % 11 == substr($ak, 10, 1)){
                return true;          
            }
        }
    }
}

function isValidName($name) 
{
    if (mb_strlen($name) >= 3) {
        if (preg_match('/^[a-zA-ZąčęėįšųūžĄČĘĖĮŠŲŪŽ]+$/', $name)){
            return true;
        }
    }
}

// vienos sąskaitos struktūra: ['id' => 1, 'name' => 'Jonas', 'surname' => 'Jonaitis' 'accountNo' => 'LT12310000000000000000', 'personalNo' => '40003210000', 'balance' => '0']

if (!file_exists(__DIR__. '/saskaitos.json')) 
{
    file_put_contents(__DIR__. '/saskaitos.json', json_encode([]));
}
$accounts = json_decode(file_get_contents(__DIR__.'/saskaitos.json'), 1);


// 1. Sąskaitų sąrašo atvaizdavimas GET
if (!isset($_GET['action']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
    require __DIR__. '/accounts.php';
}

// 2. Lėšų pridėjimo atvaizdavimas GET
elseif ($_GET['action'] == 'add' && $_SERVER['REQUEST_METHOD'] == 'GET') {
    require __DIR__. '/add.php';
}

// 3. Lėšų pridėjimo vykdymas POST
elseif ($_GET['action'] == 'add' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    require __DIR__. '/doAdd.php';
}

// 4. Lėšų nuskaičiavimo atvaizdavimas GET
elseif ($_GET['action'] == 'deduct' && $_SERVER['REQUEST_METHOD'] == 'GET') {
    require __DIR__. '/deduct.php';
}

// 5. Lėšų nuskaičiavimo vykdymas POST
elseif ($_GET['action'] == 'deduct' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    require __DIR__. '/doDeduct.php';
}

// 6. Naujos sąskaitos sukūrimo atvaizdavimas GET
elseif ($_GET['action'] == 'add-account' && $_SERVER['REQUEST_METHOD'] == 'GET') {
    require __DIR__. '/addAccount.php';
}

// 7. Naujos sąskaitos sukūrimo vykdymas POST
elseif ($_GET['action'] == 'add-account' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    require __DIR__. '/createAccount.php';
}

// 8. Sąskaitos ištrynimo vykdymas POST
elseif ($_GET['action'] == 'delete' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    require __DIR__. '/doDeleteAccount.php';
}
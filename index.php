<?php
session_start();

require __DIR__ . '/bootstrap.php';

function accGenerator() 
{ 
    return $accNo = 'LT3870440' . rand(10000000000, 99999999999);       
}

// function accGenerator($accounts) 
// {  
//     if ($accounts == null) {
//         return $accNo = 'LT3870440' . rand(99999999998, 99999999999);
//     } 
//     $accNo = 'LT3870440' . rand(99999999998, 99999999999);
//     foreach ($accounts as $account) {
//         if ($accNo === $account['accountNo']) {
//             return accGenerator($accounts);
//          } 
//         return $accNo;
//     }    
// }

function validPersonalID($ak) 
{
$valid = false;
if (strlen($ak) == 11 && $ak[0] > 2 && $ak [0] < 7) {
    // datos tikrinima perdayti su regex
    if (checkdate(substr($ak, 3, 2), substr($ak, 5, 2), substr($ak, 1, 2))) {
        $valid = true;              
    }
}
return $valid;
}

// vienos sąskaitos struktūra: ['id' => 1, 'name' => 'Jonas', 'surname' => 'Jonaitis' 'accountNo' => 'LT1231 0000 0000 0000 0000', 'personalNo' => '40003210000', 'balance' => '0']  ]

if (!file_exists(__DIR__. '/saskaitos.json')) 
{
    file_put_contents(__DIR__. '/saskaitos.json', json_encode([]));
}
$accounts = json_decode(file_get_contents(__DIR__.'/saskaitos.json'), 1);


// 1. Sąskaitų sąrašo atvaizdavimas GET
if (!isset($_GET['action']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
    require __DIR__. '/home.php';
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
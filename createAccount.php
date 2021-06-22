<?php

if (isset($_POST['name']) && mb_strlen($_POST['name']) <= 3 || is_numeric($_POST['name'])) {
    setMessage('Naujos sąskaitos pridėti nepavyko, klaidingas kliento vardas');
    redirectToAction('add-account', $id);
} 
if (isset($_POST['surname']) && mb_strlen($_POST['surname']) <= 3) {
    setMessage('Naujos sąskaitos pridėti nepavyko, klaidinga kliento pavardė');
    redirectToAction('add-account', $id);
}
if (isset($_POST['personalId']) && !validPersonalID($_POST['personalId'])) {
    setMessage('Naujos sąskaitos pridėti nepavyko, klaidingas asmens kodas');
    redirectToAction('add-account', $id);
} else {
    foreach ($accounts as $account) {
        if ($_POST['personalId'] == $account['personalId']) {
            setMessage('Naujos sąskaitos pridėti nepavyko, toks asmens kodas jau yra');
            redirectToAction('add-account', $id);
        } 
    }
}
// if (isset($_POST['accountNo'])) {
//     foreach ($accounts as $account) {
//         if ($_POST['accountNo'] == $account['accountNo']) {
//             setMessage('Toks sąskaitos Nr. jau yra');
//             redirectToAction('add-account', $id);
//         }
//     }
// }

$account = [
    'id' => rand(10000000, 99999999),  
    'name' => $_POST['name'], 
    'surname' => $_POST['surname'], 
    'accountNo' => $_POST['accountNo'], 
    'personalId' => $_POST['personalId'],
    'balance' => 0 
];

$accounts[] = $account;
file_put_contents(__DIR__.'/saskaitos.json', json_encode($accounts)); 
setMessage('Nauja sąskaita sėkmingai pridėta, sąskaitos id: ' . $account['id']);
redirect();





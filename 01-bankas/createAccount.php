<?php
if (isset($_POST['name']) && !isValidName($_POST['name'])) {
    setMessage('Naujos sąskaitos pridėti nepavyko, klaidingas kliento vardas', 'danger');
    setOld('name', $_POST['name']);
    $err = true;
} else {
    setOld('name', $_POST['name']); 
}
if (isset($_POST['surname']) && !isValidName($_POST['surname'])) {
    setMessage('Naujos sąskaitos pridėti nepavyko, klaidinga kliento pavardė', 'danger');
    setOld('surname', $_POST['surname']);
    $err = true;
} else {
    setOld('surname', $_POST['surname']); 
}
if (isset($_POST['personalId']) && !isValidPersonalID($_POST['personalId'])) {
    setMessage('Naujos sąskaitos pridėti nepavyko, klaidingas asmens kodas', 'danger');
    setOld('personalId', $_POST['personalId']);
    $err = true;
} else {
    setOld('personalId', $_POST['personalId']); 
} 
if (isValidPersonalID($_POST['personalId'])) {
    foreach ($accounts as $account) {
        if ($_POST['personalId'] == $account['personalId']) {
            setMessage('Naujos sąskaitos pridėti nepavyko, toks asmens kodas jau yra', 'danger');
            setOld('personalId', $_POST['personalId']);
            $err = true;
            // redirectToAction('add-account', $id);
        } else {
            setOld('personalId', $_POST['personalId']);
        }  
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
        
    $accounts[] = $account;
        
    file_put_contents(__DIR__.'/saskaitos.json', json_encode($accounts)); 
    setMessage('Nauja sąskaita sėkmingai pridėta, sąskaitos id: ' . $account['id'], 'success');
    redirect();
} else {
    redirectToAction('add-account', $id);
}


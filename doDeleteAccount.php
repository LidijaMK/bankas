<?php
$id = $_GET['id'] ?? 0;
foreach ($accounts as $index => $account) {
    if ($account['id'] == $id && $account['balance'] == 0) {
        unset($accounts[$index]);
        file_put_contents(__DIR__.'/saskaitos.json', json_encode($accounts));
        setMessage('Sąskaita (id: ' .$account['id'] . ') sėkmingai ištrinta.');
        redirect();
    } elseif ($account['id'] == $id && $account['balance'] > 0) {
        setMessage('Sąskaitos, kurioje yra lėšų ištrinti negalima');
        redirect();
    }  
}
<?php
$id = $_GET['id'] ?? 0;
foreach ($accounts as &$account) {
    if ($account['id'] == $id) {
        $amount = $_POST['amount'];
        if (!is_numeric($_POST['amount'])) {
            $searchForVal = ',';
            if (strpos($amount, $searchForVal) != false) {
                $amount = str_replace(',', '.', $amount);
            }
        }
        if (!is_numeric($amount)) {
            setMessage('Lėšų pridėti nepavyko, prašome įvesti skaičių.', 'warning');
            setOld('amount', $_POST['amount']);
            redirectToAction('add', $id);
        } 
        elseif ($amount < 0) {
            setMessage('Lėšų pridėti nepavyko: neigiamos pinigų sumos pridėti negalima.', 'warning');
            setOld('amount', $_POST['amount']);
            redirectToAction('add', $id);
        } else {
            $amount = round($amount, 2);
            $account['balance'] += $amount;
            setMessage('Sąskaita (id: ' . $account['id'] . ') papildyta ' . $amount . ' Eur', 'success');
            setOld('amount', $_POST['amount']);
        }
        file_put_contents(__DIR__.'/saskaitos.json', json_encode($accounts)); 
        redirect();
    }
}
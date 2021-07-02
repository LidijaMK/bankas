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
            setMessage('Lėšų nuskaičiuoti nepavyko, prašome įvesti skaičių.', 'warning');
            setOld('amount', $_POST['amount']);
            redirectToAction('deduct', $id);
        }
        elseif ($account['balance'] < $amount) {
            setMessage('Nepakankamas likutis.', 'warning');   
            setOld('amount', $_POST['amount']);
            redirectToAction('deduct', $id);
        } elseif ($amount < 0) {
            setMessage('Neigiamos pinigų sumos nuskaičiuoti negalima.', 'warning');
            setOld('amount', $_POST['amount']);
            redirectToAction('deduct', $id);
        }
         else {
            $amount = round($amount, 2);
            $account['balance'] -= $amount;
            setMessage('Iš sąskaitos (id: ' . $account['id'] . ') nuskaičiuota ' . $amount . ' Eur.', 'success');
            setOld('amount', $_POST['amount']);
        }
        file_put_contents(__DIR__.'/saskaitos.json', json_encode($accounts)); 
        redirect();
    }
}
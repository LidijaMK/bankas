<?php
define('ENTER', true);
require __DIR__ . '/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['logout'])) {
        // 2. Atjungti vartotoją
        unset($_SESSION['logged'], $_SESSION['name']);
        setMessage('Atsijungta', 'success');
        setOld('logout',$_GET['logout']);
        header('Location: http://localhost/bankas/01-bankas/login.php');
        die;
    }
    // 1. Rodyti formą

} else {
    // 2. Tikrinti prisijungimo duomenis
    $users = json_decode(file_get_contents(__DIR__.'/users.json'), 1);
    foreach ($users as $user) {
        if ($user['name'] == $_POST['name']) {
            if ($user['passw'] == md5($_POST['passw'])) {
                $_SESSION['logged'] = 1;
                $_SESSION['name'] = $user['name'];
                setMessage('Labas, ' . $user['name'], 'success');
                setOld('name', $_POST['name']);
                header('Location: http://localhost/bankas/01-bankas/');
                die;
                
            }
        }
    }
    setMessage('Neteisingas vartotojo vardas arba slaptažodis', 'danger');
    header('Location: http://localhost/bankas/01-bankas/login.php');
    die;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php include __DIR__ . '/header.php' ?>
    <?php include __DIR__ . '/msg.php' ?>
    <div class="container">
        <div class="row">
            <h1 style="margin: 0 0 30px;">Bankas</h1>
        </div>
        <div class="row">
            <div class="col-4">
                <form action="http://localhost/bankas/01-bankas/login.php" method="post">
                        <input type="text" name="name" placeholder="Vardas" class="form-control"><br>
                        <input type="password" name="passw" placeholder="Slaptažodis" class="form-control"><br>
                        <button class="btn btn-primary" type="submit">Prisijungti</button><br>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
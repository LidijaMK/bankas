<?php

if (!isset($_SESSION['logged'])) {
    header('Location: http://localhost/bankas/login.php');
    die;
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pridėti naują sąskaitą</title>
</head>
<body>
<?php include __DIR__ . '/header.php' ?>
    <div class="container">
        <div class="row">
            <h2 style="margin: 0 0 20px;">Pridėti naują sąskaitą</h2>
        </div>
        <div class= "row">
            <?php include __DIR__ . '/msg.php' ?>
            <form action="?action=add-account" method="post">
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Vardas</label>
                    <div class="col-sm-4">
                        <input type="text" name="name" class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Pavardė</label>
                    <div class="col-sm-4">
                        <input type="text" name="surname" class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Asmens kodas</label>
                    <div class="col-sm-4">
                        <input type="text" name="personalId" class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Sąskaitos numeris</label>
                    <div class="col-sm-4">
                        <input type="text" name="accountNo" value="<?= accGenerator() ?> " readonly class="form-control">
                    </div>
                </div>
                <button class="btn btn-primary">Pridėti sąskaitą</button>
            </form>
        </div>
    </div>    
</body>
</html>
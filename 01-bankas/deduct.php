<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pridėti lėšas</title>
</head>
<body>
<?php include __DIR__ . '/header.php' ?>
    <div class="container">
        <div class="row">
            <h2 style="margin: 0 0 20px;">Nuskaičiuoti lėšas</h2>
        </div>
        <?php $id = $_GET['id'] ?? 0 ?>
        <?php include __DIR__ . '/msg.php' ?>
        <?php foreach ($accounts as $account) : ?>
        <?php if ($account['id'] == $id) :?>
        <div class="row">
            <h5 style="margin: 0 0 20px;">[sąskaitos id: <?= $id ?>]</h5>
        </div>
        <div class="row">
            <form action="?action=deduct&id=<?= $id ?>" method="post">
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Vardas</label>
                    <div class="col-sm-4">
                        <input type="text" name="name" value="<?= $account['name'] ?>" readonly class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Pavardė</label>
                    <div class="col-sm-4">
                        <input type="text" name="surname" value="<?= $account['surname'] ?>" readonly class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Sąskaitos likutis, Eur</label>
                    <div class="col-sm-4">
                        <input type="text" name="balance" value="<?= $account['balance'] ?>" readonly class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Suma, Eur</label>
                    <div class="col-sm-4">
                        <input type="text" name="amount" value="<?= $mas[1]['amount'] ?? ''?>" class="form-control">
                    </div>
                </div>
                <button class="btn btn-primary">Nuskaičiuoti lėšas</button>           
            </form>
        </div>
        <?php endif ?>
        <?php endforeach ?>  
    </div>    
</body>
</html>
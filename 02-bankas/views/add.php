<?php require DIR. 'views/top.php' ?>
<?php require DIR. 'views/header.php' ?>
<div class="container">
    <div class="row">
        <h2 style="margin: 0 0 20px;">Pridėti lėšas</h2>
    </div>
    <?php include __DIR__ . '/msg.php' ?>
    <h5 style="margin: 0 0 20px;">[sąskaitos id: <?= $id ?>]</h5>
    <div class="row">
    <?php foreach ($accounts as $account) : ?>
    <?php if ($account['id'] == $id) :?>
        <form action="<?= URL ?>add/<?= $id ?>" method="post">
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Vardas </label>
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
                    <input type="text" name="amount" class="form-control" value="<?= $mas[1]['amount'] ?? ''?>">
                </div>
            </div>
            <button class="btn btn-primary">Pridėti lėšas</button>  
        </form>
    <?php endif ?>
    <?php endforeach ?>
    </div>
</div>     
<?php require DIR. 'views/bottom.php' ?>    
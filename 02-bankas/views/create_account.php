<?php require DIR. 'views/top.php' ?>
<?php require DIR. 'views/header.php' ?>
<div class="container">
    <div class="row">
        <h2 style="margin: 0 0 20px;">Pridėti naują sąskaitą</h2>
    </div>
    <div class= "row">
        <?php include __DIR__ . '/msg.php' ?>
        <form action="<?= URL ?>create-account" method="post">
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Vardas</label>
                <div class="col-sm-4">
                    <input type="text" name="name" value="<?= $mas[1]['name'] ?? '' ?>" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Pavardė</label>
                <div class="col-sm-4">
                    <input type="text" name="surname" value="<?= $mas[1]['surname'] ?? '' ?>" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Asmens kodas</label>
                <div class="col-sm-4">
                    <input type="text" name="personalId" value="<?= $mas[1]['personalId'] ?? '' ?>" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Sąskaitos numeris</label>
                <div class="col-sm-4">
                    <input type="text" name="accountNo" value="<?= Bank\App::accGenerator() ?>" readonly class="form-control">
                </div>
            </div>
            <button class="btn btn-primary">Pridėti sąskaitą</button>
        </form>
    </div>
 </div>
<?php require DIR. 'views/bottom.php' ?>    
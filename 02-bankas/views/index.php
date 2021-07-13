<?php require DIR. 'views/top.php' ?>
<?php require DIR. 'views/header.php' ?>
<div class="container" style="margin-top: 50px;">
        <?php include __DIR__ . '/msg.php' ?>
        <div class="row">
            <div class="col-12">
                <table class="table table-secondary">
                    <thead>
                        <tr class="table-primary">
                            <th class="text-center" scope="col">ID</th>
                            <th class="text-center" scope="col">Vardas</th>
                            <th class="text-center" scope="col">Pavardė</th>
                            <th class="text-center" scope="col">Asmens kodas</th>
                            <th class="text-center" scope="col">Sąskaitos Nr.</th>
                            <th class="text-center" scope="col">Sąskaitos likutis, Eur</th>
                            <th class="text-center" scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($accounts as $account) : ?>
                        <tr>
                            <th class="table-primary text-center" scope="row"><?= $account['id'] ?></th>
                            <td class="text-center"><?= $account['name'] ?></td>
                            <td class="text-center"><?= $account['surname'] ?></td>
                            <td class="text-center"><?= $account['personalId'] ?></td>
                            <td class="text-center"><?= $account['accountNo'] ?></td>
                            <td class="text-center"><?= $account['balance'] ?></td> 
                            <td class="text-center">
                            [<a href="<?= URL ?>add/<?= $account['id'] ?>">Pridėti lėšas</a>]
                            </td>
                            <td class="text-center">
                            [<a href="<?= URL ?>deduct/<?= $account['id'] ?>">Nuskaičiuoti lėšas</a>]
                            </td>
                            <td class="text-center">
                            <form action="<?= URL ?>delete/<?= $account['id'] ?>" method="post">
                            <button type="submit" class="btn btn-primary">Ištrinti sąskaitą</button>
                            </form>
                            </td>  
                        </tr>
                    <?php endforeach ?>    
                    </tbody>
                </table>
            </div>
        </div>
    </div>   
<?php require DIR. 'views/bottom.php' ?>
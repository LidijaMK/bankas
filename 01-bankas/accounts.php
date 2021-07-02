<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sąskaitos</title>
</head>
<body>
<?php include __DIR__ . '/header.php' ?>   
    <div class="container">
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
                <?php
                    usort($accounts, function($a, $b) {
                        return $a['surname'] <=> $b['surname'];
                    });
                ?>
                    <?php foreach ($accounts as $account) : ?>
                        <tr>
                            <th class="table-primary text-center" scope="row"><?= $account['id'] ?></th>
                            <td class="text-center"><?= $account['name'] ?></td>
                            <td class="text-center"><?= $account['surname'] ?></td>
                            <td class="text-center"><?= $account['personalId'] ?></td>
                            <td class="text-center"><?= $account['accountNo'] ?></td>
                            <td class="text-center"><?= $account['balance'] ?></td> 
                            <td class="text-center">
                            [<a href="?action=add&id=<?= $account['id'] ?>">Pridėti lėšas</a>]
                            </td>
                            <td class="text-center">
                            [<a href="?action=deduct&id=<?= $account['id'] ?>">Nuskaičiuoti lėšas</a>]
                            </td>
                            <td class="text-center">
                            <form action="?action=delete&id=<?= $account['id'] ?>" method="post">
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
</body>
</html>
<?php require DIR. 'views/top.php' ?>
<?php require DIR. 'views/header.php' ?>
<?php require DIR. 'views/msg.php' ?>
<div class="container">
        <div class="row">
            <h1 style="margin: 0 0 30px;">Bankas</h1>
        </div>
        <div class="row">
            <div class="col-4">
                <form action="<?= URL ?>login" method="post">
                        <input type="text" name="name" placeholder="Vardas" class="form-control"><br>
                        <input type="password" name="passw" placeholder="Slaptažodis" class="form-control"><br>
                        <button class="btn btn-primary" type="submit">Prisijungti</button><br>
                </form>
            </div>
        </div>
    </div>
<?php require DIR. 'views/bottom.php' ?>    
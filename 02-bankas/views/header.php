<?php require DIR. 'views/top.php' ?>
    <header class="container-fluid" style="background-color: #316DB5;">
        <div class="navbar">
                <a class="navbar-brand" href="#" style="margin-right:30px;"><img class="foto" src="<?= URL ?>/img/bank.png" alt="logo" height="40"></a>  
                <nav class="nav justify-content-center">
                    <a class="nav-link" style="color: white;font-weight:500;" href="<?= URL ?>">Sąskaitų sąrašas</a>
                    <a class="nav-link" style="color: white;font-weight:500;" href="<?= URL ?>create-account">Pridėti naują sąskaitą</a>
                    <?php if (!isset($_SESSION['logged'])) : ?>
                    <a class="nav-link" style="color: white;font-weight:500;" href="<?= URL ?>login">Prisijungti</a>
                    <?php else : ?>
                    <a class="nav-link" style="color: white;font-weight:500;" href="<?= URL ?>logout">Atsijungti</a>
                    <?php endif ?>
                </nav>
        </div>
    </header>
<?php require DIR. 'views/bottom.php' ?>
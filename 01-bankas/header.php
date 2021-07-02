<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style.css">
    <title>Bankas</title>
</head>
<body style="background-color: #BAC6D3;">
    <header class="container-fluid" style="background-color: #316DB5;">
        <div class="navbar">
                <a class="navbar-brand" href="#" style="margin-right:30px;"><img class="foto" src="./img/bank.png" alt="logo" height="40"></a>  
                <nav class="nav justify-content-center">
                    <a class="nav-link" href="http://localhost/bankas/01-bankas/">Sąskaitų sąrašas</a>
                    <a class="nav-link" href="http://localhost/bankas/01-bankas/?action=add-account">Pridėti naują sąskaitą</a>
                    <?php if (!isset($_SESSION['logged'])) : ?>  
                    <a class="nav-link" href="http://localhost/bankas/01-bankas/login.php">Prisijungti</a>
                    <?php else : ?>
                    <a class="nav-link" href="http://localhost/bankas/01-bankas/login.php?logout">Atsijungti</a>
                    <?php endif ?>
                </nav>
        </div>
    </header>
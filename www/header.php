<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Clovero</title>
</head>

<body>
    <header>
        <a href="index.php"><img id="logopic" src="images/logo_2.png" alt="LOGO"></a>
        <nav>
            <ul class="ulnav">
                <li class="linav"> <a href="index.php">HOME PAGE </a></li>
                <li class="linav"> <a href="ireland.php">IRELAND </a></li>
                <li class="linav"><a href="dishes.php"> DISHES </a></li>
                <li class="linav"><a href="reserving.php"> RESERVING </a></li>
            </ul>
        </nav>
        <div class="divsocials">
            <ul class="ulsocials">
                <li class="lisocials"><a href="#" class="fa fa-facebook"></a></li>
                <li class="lisocials"><a href="#" class="fa fa-youtube"></a></li>
                <li class="lisocials"><a href="#" class="fa fa-twitter"></a></li>
                <li class="lisocials"><a href="#" class="fa fa-instagram"></a></li>
            </ul>
        </div>
        <div>
            <?php if (isset($_SESSION['gebruiker_id'])) : ?>
                <a href="logout.php" class="uitloggenButton"> UITLOGGEN </a>
            <?php else : ?>
                <a href="inloggen.php" class="inloggenButton"> INLOGGEN </a>
            <?php endif; ?>
        </div>
    </header>
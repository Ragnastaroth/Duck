<?php

include_once('environnement.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Accueil</title>
</head>
<body>
    
    <?php include_once('header.php') ?>

    <?php include_once('nav.php');?>

    <div class="popup">
        <?php
            if(isset($_SESSION['userName'])) { ?>
                <h2>Bienvenue <?= $_SESSION['userName'] ?></h2>
            <?php }else{ ?>
                <h2>Bienvenue visiteur</h2>
        <?php } ?>
    </div>
    <main>
        <section class="who">
            <h2>Qui sommes-nous ?</h2>
            <div>
                <img src="assets\images\duckassembly.jpg" alt="">
            </div>
        </section>
        <section class="join">
            <h2>Nous rejoindre</h2>
            <div>
                <img src="assets/images/duckarmy.webp" alt="">
            </div>
        </section>
    </main>
</body>
</html>
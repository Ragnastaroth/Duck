<?php

include_once('environnement.php');

if(!isset($_GET['category'])){

    $request = $bdd->query('SELECT *, p.id AS pId, ROUND(AVG(n.score), 1) AS avgscore, u.id AS author
                            FROM products AS p
                            INNER JOIN users AS u ON p.user_id = u.id
                            LEFT JOIN notes AS n ON n.product_id = p.id
                            INNER JOIN category AS c ON p.type_id = c.id
                            GROUP BY p.id
                          ');


} else if ($_GET['category'] != 0) {

    $cat = $_GET['category'];
    
    $request = $bdd->prepare('SELECT *, p.id AS pId, ROUND(AVG(n.score), 1) AS avgscore, u.id AS author
                              FROM products AS p
                              INNER JOIN users AS u ON p.user_id = u.id 
                              LEFT JOIN notes AS n ON n.product_id = p.id
                              INNER JOIN category AS c ON p.type_id = c.id
                              WHERE type_id = ?
                              GROUP BY pId
                            ');
     $request->execute(array($cat));
     
    } else {
        header('Location: gallery.php');
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/libs/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Galerie</title>
</head>
<body>
    
    <?php include_once('header.php') ?>

    <?php include_once('nav.php');?>

    <main>
        <div class="popup">
            <?php
                if(isset($_SESSION['userName'])) { ?>
                    <h2>Bienvenue <?= $_SESSION['userName'] ?></h2>
                <?php }else{ ?>
                    <h2>Bienvenue visiteur</h2>
            <?php } ?>
        </div>
        <form action="gallery.php" class="cat" method="GET">
            <select name="category" id="category">
                <option value="0">Tout</option>
                <option value="1">Films</option>
                <option value="2">Jeux Vidéos</option>
                <option value="3">Divers</option>
            </select>
            <button>Envoyer</button>
        </form>
        <section class="article_container">
            
            
        <?php while ($duck = $request->fetch()) { ?>
            <article>
                <a href="product.php?id=<?=$duck['pId']?>">
                <img src="assets/images/products/<?=$duck['type_id']?>/<?=$duck['img']?>" alt="une image de <?=$duck['name']?>" class="product_link">
                </a>
                <h3><?=$duck['name']?></h3>
                <h4>Présenté par: <?=$duck['username']?></h4>
                <h5 id="note">Notes: <?= $duck['avgscore']?> /5 <i class="fa-solid fa-star"></i></h5>
                <?php if (isset($_SESSION['userId'])) : ?>
                        <?php if ($_SESSION['userId'] == $duck['author']) : ?>
                            <div class="custom_container">
                                <a class="btn btn-modif" href="<?= 'modification.php?id=' . $duck['pId']; ?>">Modifier le canard</a>
                                <a class="btn btn-suppr" href="<?= 'suppression.php?id=' . $duck['pId']; ?>">Supprimer le canard  :'(</a>
                            </div>
                        <?php endif ?>
                    <?php endif ?>
            </article>
            <?php } ?>
        </section>
    </main>
</body>
</html>
    
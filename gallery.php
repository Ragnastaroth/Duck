<?php

include_once('environnement.php');

if(!isset($_GET['category'])){

    $request = $bdd->query('SELECT *, p.id AS pId
                            FROM products AS p
                            INNER JOIN users AS u ON
                            p.user_id = u.id
                          ');

} else if ($_GET['category'] != 0) {

    $cat = $_GET['category'];
    
    $request = $bdd->prepare('SELECT *, p.id AS pId
                              FROM products AS p
                              INNER JOIN users AS u ON
                              p.user_id = u.id
                              WHERE p.type_id = ?
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
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Gallerie</title>
</head>
<body>
    
    <?php include_once('header.php') ?>

    <?php include_once('nav.php');?>

    <main>
        <form action="gallery.php" class="cat" method="GET">
            <select name="category" id="category">
                <option value="1">Films</option>
                <option value="2">Jeux Vidéos</option>
                <option value="3">Divers</option>
                <option value="0">Tout</option>
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
                <h4>Note:</h4>
            </article>
            <?php } ?>
        </section>
    </main>
</body>
</html>
    
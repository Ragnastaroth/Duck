<?php

include_once('environnement.php');

$productId = $_GET['id'];

$request = $bdd->prepare('SELECT *, products.id AS pId
                          FROM products
                          INNER JOIN users ON
                          products.user_id = users.id
                          WHERE products.id = ?
                        ');

$request->execute(array($productId));

$comReq = $bdd->prepare('SELECT *
                         FROM comments
                         INNER JOIN products ON
                         comments.product_id = products.id
                         INNER JOIN users ON
                         comments.user_id = users.id
                         WHERE comments.product_id = ?
                       ');
$comReq->execute(array($productId));

$noteReq = $bdd->prepare('SELECT *, ROUND(AVG(notes.score), 1) AS avgscore, products.id AS prodId
                          FROM products
                          INNER JOIN notes ON products.id = notes.product_id
                          WHERE products.id = ?
                          GROUP BY notes.product_id
                        ');
$noteReq->execute(array($productId));

$values = $noteReq->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/libs/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Produit</title>
</head>

<body>

    <?php include_once('header.php') ?> 

    <?php include_once('nav.php');?>

    <main>

    <section class="article_container">

        <?php while ($duck = $request->fetch()) { ?>
            <article>
                <img src="assets/images/products/<?=$duck['type_id']?>/<?=$duck['img']?>" alt="une image de <?=$duck['name']?>" class="product_link">
                <h3><?=$duck['name']?></h3>
                <h4>Présenté par: <?=$duck['username']?></h4>

                <?php foreach ($values as $value) : ?>
                <h5 id="note">Notes: <?= $value['avgscore'] ?> /5 <i class="fa-solid fa-star"></i></h5>
                <?php endforeach; ?>


                <div id="comments">Commentaires:
                    <div id="com_container" class="dNone">
                        <?php while ($com = $comReq->fetch()) { ?>
                            <div class="com">
                                <p><?=$com['comment'] ?></p>
                                <p>Par: <?=$com['username']?></p>
                            </div>
                        <?php } ?>
                    </div>
                    <a href= <?= 'comment.php?id=' . $productId ?>>Écrire un commentaire</a>
                </div>
            </article>
            <?php } ?>

        </section>

    </main>

</body>

<script src="assets/js/comments.js"></script>

</html>



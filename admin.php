<?php
include_once('environnement.php');

    
$request = $bdd->query('SELECT *, p.id AS pId, ROUND(AVG(n.score), 1) AS avgscore, u.id AS author
                            FROM products AS p
                            INNER JOIN users AS u ON p.user_id = u.id 
                            LEFT JOIN notes AS n ON n.product_id = p.id
                            GROUP BY pId
                        ');

$userReq = $bdd->query('SELECT *
                        FROM users
                        ')
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/libs/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>ADMIN</title>
</head>

    <?php include_once('header.php') ?>

    <?php include_once('nav.php');?>

<body>
    
    <div class="pre_section">
        <h2>Liste des canards</h2>
        <button id="ducks">Montrer les canards</button>
    </div>
    <div id="ducks_container" class="dNone"> 
        <section class="article_container">
                <?php while ($duck = $request->fetch()) { ?>
                    <article>
                        <a href="product.php?id=<?=$duck['pId']?>">
                        <img src="assets/images/products/<?=$duck['type_id']?>/<?=$duck['img']?>" alt="une image de <?=$duck['name']?>" class="product_link">
                        </a>
                        <h3><?=$duck['name']?></h3>
                        <h4>Présenté par: <?=$duck['author']?></h4>
                        <h5 id="note">Notes: <?= $duck['avgscore']?> /5 <i class="fa-solid fa-star"></i></h5>
                        <div class="custom_container">
                            <a class="btn btn-modif" href="<?= 'modification.php?id=' . $duck['pId']; ?>">Modifier le canard</a>
                            <a class="btn btn-suppr" href="<?= 'suppression.php?id=' . $duck['pId']; ?>">Supprimer le canard  :'(</a>
                        </div>
                    </article>
                <?php } ?>
        </section>
    </div> 

    <div class="pre_section">
        <h2>Liste des utilisateurs</h2>
        <button id="users">Montrer les utilisateurs</button>
    </div>
    <div id="users_container" class="dNone">
        <section class="article_container">  
            <?php while ($user = $userReq->fetch()) { ?>
                <article>
                    <i class="fa-solid fa-user"></i>
                    <h3> <?= $user['username'] ?> </h3>
                    <div class="custom_container">
                            <a class="btn btn-suppr" href="<?= 'suppression.php?id=' . $user['username']; ?>">Supprimer l'utilisateur'  :'(</a>
                        </div>
                </article>
            <?php } ?>
        </section>
    </div>
    <script src="assets/js/admin.js"></script>
</body>
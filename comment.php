<?php

include_once('environnement.php');

$productId = $_GET['id'];
$author = $_SESSION['userId'];

if (isset($_POST['comment'])) {

    $comment = htmlspecialchars($_POST['comment']);
    


$request = $bdd->prepare('INSERT INTO comments (comment, user_id, product_id)
                          VALUES(?,?,?)
                        ');

$request->execute(array($comment, $author, $productId));

header('Location: product.php?id='. $productId );
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Produit</title>
</head>

<body>

    <?php include_once('header.php') ?> 

    <?php include_once('nav.php');?>

    <main>

        <section>

            <form action="comment.php?id=<?=$productId?>" method="POST" enctype="multipart/form-data" class="comment" >
                <textarea name="comment" id="comment" cols="55" rows="15" placeholder="Écrivez votre commentaire sur ce canard"></textarea>
                <button>Envoyer</button>
            </form>

        </section>

    </main>

</body>
</html>

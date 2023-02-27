<?php
include_once('environnement.php');

$productId = $_GET['id'];

$rqSelect = $bdd->prepare('SELECT *
                           FROM products
                           WHERE id = ?');
$rqSelect->execute(array($productId));

$values = $rqSelect->fetchAll();

foreach ($values as $value) :
    if (isset($_SESSION['userId']) && $value['user_id'] == $_SESSION['userId'] || $_SESSION['role'] == 'admin') {

        if (isset($_POST['name'])) {
            $name = htmlspecialchars($_POST['name']);

            $request = $bdd->prepare('UPDATE products
                                SET name = :name
                                WHERE id = :id');

            $request->execute(array(
                'name'           => $name,
                'id'            => $productId
            ));
            header('Location: gallery.php');
        }
    } else {
        header('Location: index.php');
    }
endforeach;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Modification du canard</title>
</head>

<body>

    <?php include_once('header.php'); ?>
    
   <?php include_once('nav.php'); ?>
    
    <main>
        
        <section class="create">
            <h1>Modification du canard</h1>
            <form action="modification.php<?= '?id=' . $productId ?>" method="POST" class="create_form">

                <?php foreach ($values as $value) : ?>
                    <label for="name">Modifier le nom du canard:</label>
                    <input type="text" id="name" name="name" value="<?= $value['name'] ?>">
                <?php endforeach; ?>

                <button>Modifier</button>
            </form>
        </section>
    </main>
</body>

</html>
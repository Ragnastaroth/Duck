<?php

include_once('environnement.php');

if (isset($_POST['name']) && isset($_POST['category'])) {
    $name = htmlspecialchars($_POST['name']);
    $category = $_POST['category'];
    $author = $_SESSION['userId'];

    if (isset($_FILES['image'])) {
        // NOM DU FICHIER IMAGE
        $image = $_FILES['image']['name']; //machin1123456543456.webp
        $imageTmp = $_FILES['image']['tmp_name']; // NOM TEMPORAIRE DU FICHIER IMAGE
        $infoImage = pathinfo($image); //tableau qui décortique le nom de l'image
        $extImage = $infoImage['extension']; //extension
        $imageName = $infoImage['filename']; //nom du fichier sans l'extension
        $uniqueName = $imageName . time() . rand(1, 1000) . "." . $extImage; //génération d'un nom de fichier unique

        move_uploaded_file($imageTmp, 'assets/images/products/' .$category.'/' . $uniqueName);
    }

    $request = $bdd->prepare('INSERT INTO products(name, img, type_id, user_id)
                              VALUES(?,?,?,?)');

    $request->execute(array($name, $uniqueName, $category, $author));
    header('Location: index.php?success=1');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Ajouter un canard</title>
</head>

<body>

    <?php include_once('header.php') ?>

    <?php include_once('nav.php'); ?>

    <main>
        <section class="create">
            <h1>Création du canard</h1>

            <!--Formulaire de Création-->
            <form action="create.php" method="POST" enctype="multipart/form-data" class="create_form">
                <label for="name">Nom du canard: </label>
                <input type="text" id="name" name="name">

                <label for="category">Catégorie du canard</label>
                <select name="category" id="category">
                    <option value="1">Films</option>
                    <option value="2">Jeux Vidéos</option>
                    <option value="3">Divers</option>
                </select>

                <label for="image">Ajouter une image:</label>
                <input type="file" id="image" name="image">

                <button>Ajouter le canard à la collection</button>
            </form>
        </section>
    </main>
</body>
</html>
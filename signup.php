<?php
include_once('environnement.php');

if (isset($_POST['name']) && isset($_POST['password']) && isset($_POST['passconfirm'])) {
    $name = htmlspecialchars(trim($_POST['name'])); //trim pour supprimer les espaces, strtolower pour ignorer les maj
    $password = htmlspecialchars($_POST['password']);
    $passconfirm = htmlspecialchars($_POST['passconfirm']);

    if ($password === $passconfirm) {

        $rqCount = $bdd->prepare('SELECT COUNT(*) AS usercount
                                FROM users
                                WHERE username = ?');

        $rqCount->execute([$name]);

        while ($count = $rqCount->fetch()) {
            $countVerify = $count['usercount'];

            if($countVerify < 1){

                $passCrypt = sha1(sha1('123' . $password . 'ABCDEF'));

                    $request = $bdd->prepare('INSERT INTO users(username,password)
                                            VALUES(?,?)');

                    $request->execute(array($name, $passCrypt));

                    header('Location: index.php');
            }
        }   
    }else{
        echo "Même mot de passe steu plaît -_-' ";
    }  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="assets/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

    <?php include_once('header.php') ?>

    <?php include_once('nav.php'); ?>

        <form action="signup.php" method="POST" class="signup">
            <label for="name">Nom d'utilisateur:</label>
            <input type="text" id="name" name="name">
            <label for="password" id="password">Votre mot de passe:</label>
            <input type="password" id="password" name="password">
            <label for="passconfirm" id="passconfirm">Confirmez votre mot de passe:</label>
            <input type="password" id="passconfirm" name="passconfirm">
            <button>Créer un compte</button>
        </form>

</body>
</html>
<?php
include_once('environnement.php');

if (isset($_POST['name']) && isset($_POST['password'])) {
    $username = htmlspecialchars($_POST['name']);
    $password = htmlspecialchars($_POST['password']);
    $passCrypt = sha1(sha1('123' . $password . 'ABCDEF'));
    

    $auth = $bdd->prepare('SELECT *
                        FROM users
                        WHERE username = ?');
    $auth->execute(array($username));

    while($userData = $auth->fetch()) {

        if($userData['username'] == 'Admin' && $passCrypt == $userData['password'] && $userData['role'] == 'admin') {

            $_SESSION['userName'] = $userData['username'];
            $_SESSION['role'] = $userData['role'];
            header('Location: admin.php');
            exit();

        } else if($passCrypt == $userData['password']) {
            $_SESSION['userName'] = $userData['username'];
            $_SESSION['userId'] = $userData['id'];
            header('Location: index.php');
            exit(); 
        
        } else {
            echo 'Nom ou mot de passe incorrect';
        }
    };
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

    <?php include_once('header.php') ?>

    <?php include_once('nav.php'); ?>

        <form action="signin.php" method="POST" class="signup">
            <label for="name">Nom d'utilisateur:</label>
            <input type="text" id="name" name="name">
            <label for="password" id="password">Votre mot de passe:</label>
            <input type="password" id="password" name="password">
            <button>S'identifier</button>
        </form>


</body>
</html>
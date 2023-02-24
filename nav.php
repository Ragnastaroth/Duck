<nav>
    <ul>
        <li>
            <a href="index.php">Accueil</a>
        </li>
        <li>
            <a href="gallery.php?category=0">Collection</a>
        </li>
        <li>
            <a href="create.php">Ajouter un canard</a>
        </li>
        <?php
        if(isset($_SESSION['userName'])){
            if($_SESSION['userName'] == 'Admin' && $_SESSION['role'] == 'admin'){
                echo '<li><a href="admin.php" type="button">Modération</a></li>';
            }
    }
        if(isset($_SESSION['userName'])){
            echo '<a href="disconnect.php">Déconnexion</a>';
        } else {
            echo '<li><a href="signup.php" type="button" id="login">S\'inscrire</a></li>
                  <li><a href="signin.php" type="button">Se connecter</a></li>';
        }
        
        ?>
    </ul>
</nav>
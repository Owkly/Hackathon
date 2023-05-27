<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profil.css">
    <title>Profil</title>
</head>
<body>
    <header>
        <a href="#" class="logo"><span>Poly'</span>Troc</a>
        <div class="menutoggle" onclick="toggleMenu();"></div>
        <ul class="navbar">
            <li><a href="connexion.php" onclick="toggleMenu();">Accueil</a></li>
            <li><a href="#" onclick="toggleMenu();">Profil</a></li>
            <a href="annonce_connexion.html" class="btn-annonce" onclick="toggleMenu();">Annonce</a>
        </ul>
    </header>
    <section class="Profil" id="Profil">
        <div class="contenu">
            <h2>Profil</h2>
            <div class="text">
                <p>Bonjour ! Bienvenue sur votre page de profil, vous trouverez ci-dessous l'ensemble des informations que nous détenons à propos de vous.</p>
                <p>Nom : <?php echo $_SESSION['nom'];?></p>
                <p>Prénom: <?php echo $_SESSION['prenom'];?></p>
                <p>Email: <?php echo $_SESSION['email'];?></p>
            </div>
            <div class="deco">
                <li><a href="index.php" onclick="toggleMenu();">Déconnexion</a></li>
            </div>
        </div>
    </section>
    
    <div class="copyright">
        <p>copyright 2023 <a href="#">Thomas, Nicolas, Yannick</a></p>
    </div>
    <script type="text/javascript">
        window.addEventListener('scroll', function(){
            const header = document.querySelector('header');
            header.classList.toggle("sticky", window.scrollY > 0);
        });
    
        function toggleMenu(){
            const toggleMenu = document.querySelector('.menutoggle');
            const navbar = document.querySelector('.navbar');
            menutoggle.classList.toggle('active');
            navbar.classList.toggle('active');
        }
    </script>
</body>
</html>
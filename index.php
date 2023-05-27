<?php
$error = "";
// Vérifier que le bouton envoyer est cliqué
if(isset($_POST['envoyer'])){
    // Vérifier que les champs ne sont pas vides
    if(!empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['message'])){
        $nom_serveur = "localhost";
        $utilisateur = "root";
        $mot_de_passe = "";
        $nom_bd = "inscription";
        $con = mysqli_connect($nom_serveur, $utilisateur, $mot_de_passe, $nom_bd);

        // Vérifier la connexion à la base de données
        if(!$con){
            die("Erreur de connexion à la base de données : ".mysqli_connect_error());
        }

        // Requête préparée
        $req = mysqli_prepare($con, "INSERT INTO contact (nom, email, message) VALUES (?, ?, ?)");
        
        // Vérifier la préparation de la requête
        if(!$req){
            die("Erreur de préparation de la requête : ".mysqli_error($con));
        }

        // Liage des valeurs aux paramètres
        mysqli_stmt_bind_param($req, "sss", $_POST['nom'], $_POST['email'], $_POST['message']);

        // Exécution de la requête préparée
        if(mysqli_stmt_execute($req)){
            // Redirection vers une page de succès ou affichage d'un message de réussite
            header('Location: a.html');
            exit();
        }
        else{
            $error = "Erreur lors de l'exécution de la requête : ".mysqli_stmt_error($req);
        }

        // Fermeture de la requête préparée
        mysqli_stmt_close($req);

        // Fermeture de la connexion à la base de données
        mysqli_close($con);
    }
    else{
        $error = "Veuillez remplir tous les champs";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Poly'Troc</title>
</head>
<body>
<header>
    <a href="#" class="logo"><span>Poly'</span>Troc</a>
    <div class=menutoggle onclick="toggleMenu();"></div>
    <ul class="navbar">
        <li><a href="#banniere" onclick="toggleMenu();">Accueil</a></li>
        <li><a href="#apropos" onclick="toggleMenu();">A propos</a></li>
        <li><a href="#contact" onclick="toggleMenu();">Contact</a></li>
        <li><a href="login.php" onclick="toggleMenu();">Connexion</a></li>
        <a href="annonce.html" class="btn-annonce" onclick="toggleMenu();">Annonce</a>
    </ul>
</header>
<section class="banniere" id="banniere">
    <div class="contenu">
        <h2>Des trocs à gogo</h2>
        <p>Bienvenue sur notre site web de troc environnemental !

            Chez nous, vous pouvez échanger des biens et des services avec d'autres utilisateurs, dans le but de favoriser l'environnement et de réduire notre impact sur la planète. Notre plateforme offre une alternative durable et responsable à la consommation traditionnelle, en encourageant le réutilisation, le recyclage et l'économie circulaire.</p>
        <a href="annonce.html" class="btn1">Annonce</a>
        <a href="#" class="btn2">Liste des Annonces</a>
    </div>
</section>
<section class="apropos" id="apropos">
    <div class="row">
        <div class="col50">
            <h2 class="titre-texte"><span>A</span> Propos De Nous</h2>
            <p>En tant que jeunes ingénieurs, nous sommes profondément inquiets face à la crise écologique actuelle. Nous ressentons la responsabilité d'apporter des solutions durables pour préserver notre environnement. Rejoignez-nous dans notre engagement pour un avenir plus vert et plus respectueux de la planète. Ensemble, nous pouvons faire la différence.</p>
        </div>
        <div class="col50">
            <div class="img">
                <img src="./images/trock.jpeg" alt="image">
            </div>
        </div>
    </div>
</section>
<section class="contact" id="contact">
    <div class="titre noir">
        <h2 class="titre-texte"><span>C</span>ontact</h2>
        <div class="ligne">
            <p>Pour toutes informations supplémentaires ou pour toutes questions n'hésitez pas à nous contacter via ce formulaire !</p>
        </div>
    </div>
    <form action="" method="POST">
    <div class="contactform" id="contactform">
        <h3>Envoyer un message</h3>
        <div class="inputboite">
            <input type="text" placeholder="Nom" id="in", name="nom">
        </div>
        <div class="inputboite">
            <input type="text" placeholder="email" id="in2", name = "email">
        </div>
        <div class="inputboite">
            <textarea placeholder="message" id="in3", name = message></textarea>
        </div>
        <div class="inputboite" id="buttonsend">
            <button type="submit", name = "envoyer">Envoyer</button>
        </div>
        <?php
            echo '<p style="color: red;">'. $error .'</p>';
    ?>
    </div>
    
    </form>
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

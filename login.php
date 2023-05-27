<?php
session_start();

if (isset($_POST['Connexion'])) {
    // Vérification de la validité des informations
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $mdp = $_POST['password'];
        $erreur = "";
        
        // Connexion à la base de données
        $nom_serveur = "localhost";
        $utilisateur = "root";
        $mot_de_passe = "";
        $nom_bd = "inscription";
        $con = mysqli_connect($nom_serveur, $utilisateur, $mot_de_passe, $nom_bd);

        // Requête préparée
        $req = mysqli_prepare($con, "SELECT nom, prénom, email FROM utilisateurs WHERE email = ? AND mdp = ?");
        mysqli_stmt_bind_param($req, "ss", $email, $mdp);
        mysqli_stmt_execute($req);

        // Récupérer le résultat
        $result = mysqli_stmt_get_result($req);
        $num_ligne = mysqli_num_rows($result);

        if ($num_ligne > 0) {
            // Récupérer le nom et le prénom de l'utilisateur
            $row = mysqli_fetch_assoc($result);
            $nom = $row['nom'];
            $prenom = $row['prénom'];

            // Stocker les données dans la session
            $_SESSION['nom'] = $nom;
            $_SESSION['prenom'] = $prenom;
            $_SESSION['email'] = $email;

            header('Location: connexion.php');
        } else {
            $erreur = "Adresse email ou mot de passe incorrect";
        }
    }
}


?>

<?php
// Vérifier que le bouton Enregistrer est cliqué
if (isset($_POST['Enregistrer'])) {
    // Vérifier que les champs ne sont pas vides
    if (!empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        $nom_serveur = "localhost";
        $utilisateur = "root";
        $mot_de_passe = "";
        $nom_bd = "inscription";
        $con = mysqli_connect($nom_serveur, $utilisateur, $mot_de_passe, $nom_bd);

        // Vérifier la connexion à la base de données
        if (!$con) {
            die("Erreur de connexion à la base de données : " . mysqli_connect_error());
        }

        // Requête préparée
        $req = mysqli_prepare($con, "INSERT INTO utilisateurs (nom, email, mdp) VALUES (?, ?, ?)");
        
        // Vérifier la préparation de la requête
        if (!$req) {
            die("Erreur de préparation de la requête : " . mysqli_error($con));
        }

        // Liage des valeurs aux paramètres
        mysqli_stmt_bind_param($req, "sss", $_POST['nom'], $_POST['email'], $_POST['password']);

        // Exécution de la requête préparée
        if (mysqli_stmt_execute($req)) {
            $_SESSION['nom'] = $_POST['nom'];
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['prenom'] = $_POST['prenom'];
            // Redirection vers une page de succès ou affichage d'un message de réussite
            header('Location: connexion.php');
            exit();
        } else {
            $erreur2 = "Erreur lors de l'exécution de la requête : " . mysqli_stmt_error($req);
        }

        // Fermeture de la requête préparée
        mysqli_stmt_close($req);

        // Fermeture de la connexion à la base de données
        mysqli_close($con);
    } else {
        $erreur2 = "Veuillez remplir tous les champs";
    }
}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="login.css">
    <title>Connexion & Inscription</title>
</head>
<body>
 <div class="wrapper">
    <nav class="nav">

        <div class="nav-menu" id="navMenu">
            <ul>
                <a href="#" class="logo"><span>Poly'</span>Trock</a>
                <li><a href="index.php" class="link active">Accueil</a></li>
            </ul>
        </div>

        <div class="nav-button">
            <button class="btn white-btn" id="loginBtn" onclick="login()">Connexion</button>
            <button class="btn" id="registerBtn" onclick="register()">Inscription</button>
        </div>
        <div class="nav-menu-btn">
            <i class="bx bx-menu" onclick="myMenuFunction()"></i>
        </div>
    </nav>

<!----------------------------- Zone Formulaire ----------------------------------->    
    <div class="form-box" id="formBox">
        
        <!------------------- Connexion -------------------------->

        <div class="login-container" id="login">
            <div class="top">
                <span>Vous n'avez pas de compte ?<a href="#" onclick="register()">Inscription</a></span>
                <header>Connexion</header>
            </div>
            <?php
                if(isset($erreur)){
                    // afficher le message d'erreur en rouge en le centrant
                    echo "<div style='color: red; text-align: center;'>".$erreur."</div>";
                }
            ?>
            </br>
            <form action="" method="POST">
                <div class="input-box">
                    <input type="text" class="input-field" placeholder="Nom d'utilisateur ou Email" name="email">
                    <i class="bx bx-user"></i>
                </div>
                <div class="input-box">
                    <input type="password" class="input-field" placeholder="Mot de passe" name="password">
                    <i class="bx bx-lock-alt"></i>
                </div>

                <div class="input-box">
                    <input type="submit" class="submit" value="Connexion", name="Connexion">
                </div>

                <div class="two-col">
                    <div class="one">
                        <input type="checkbox" id="login-check">
                        <label for="login-check"> Se souvenir de moi</label>
                    </div>
                    <div class="two">
                        <label><a href="#">Mot de passe oublié?</a></label>
                    </div>
                </div>
            </form>
        </div>

        <!------------------- Inscription -------------------------->
        <div class="register-container" id="register">
            <div class="top">
                <span>Vous avez un compte ? <a href="#" onclick="login()">Connexion</a></span>
                <header>Inscription</header>
            </div>
            <?php
                if(isset($erreur2)){
                    // afficher le message d'erreur en rouge en le centrant
                    echo "<div style='color: red; text-align: center;'>".$erreur2."</div>";
                }
            ?>
            </br>
            <form action="" method="POST">
            <div class="two-forms">
                <div class="input-box">
                    <input type="text" class="input-field" placeholder="Nom", name="nom">
                    <i class="bx bx-user"></i>
                </div>
                <div class="input-box">
                    <input type="text" class="input-field" placeholder="Prénom", name="prenom">
                    <i class="bx bx-user"></i>
                </div>
            </div>
            <div class="input-box">
                <input type="text" class="input-field" placeholder="Email", name="email">
                <i class="bx bx-envelope"></i>
            </div>
            <div class="input-box">
                <input type="password" class="input-field" placeholder="Mot de Passe", name="password">
                <i class="bx bx-lock-alt"></i>
            </div>
            <div class="input-box">
                <input type="submit" class="submit" value="Enregistrer", name = "Enregistrer">
            </div>
            <div class="two-col">
                <div class="one">
                    <input type="checkbox" id="register-check">
                    <label for="register-check"> Se souvenir de moi</label>
                </div>
                <div class="two">
                    <label><a href="#">Conditions générales d'utilisation</a></label>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>   


<script>
   
   function myMenuFunction() {
    var i = document.getElementById("navMenu");

    if(i.className === "nav-menu") {
        i.className += " responsive";
    } else {
        i.className = "nav-menu";
    }
   }
 
</script>

<script>

var a = document.getElementById("loginBtn");
var b = document.getElementById("registerBtn");
var x = document.getElementById("login");
var y = document.getElementById("register");
var formBox = document.getElementById("formBox");

function login() {
    x.style.left = "4px";
    y.style.right = "-520px";
    a.className += " white-btn";
    b.className = "btn";
    x.style.opacity = 1;
    y.style.opacity = 0;
    formBox.style.height = "450px"; // Ajustez la hauteur de la div en fonction de vos besoins
}

function register() {
    x.style.left = "-510px";
    y.style.right = "5px";
    a.className = "btn";
    b.className += " white-btn";
    x.style.opacity = 0;
    y.style.opacity = 1;
    formBox.style.height = "500px"; // Ajustez la hauteur de la div en fonction de vos besoins
}


</script>

</body>
</html>

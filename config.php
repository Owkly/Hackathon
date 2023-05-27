<?php
// Vérification de la validité des informations
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $mdp = $_POST['password'];

    // Connexion à la base de données
    $nom_serveur = "localhost";
    $utilisateur = "root";
    $mot_de_passe = "";
    $nom_bd = "inscription";
    $con = mysqli_connect($nom_serveur, $utilisateur, $mot_de_passe, $nom_bd);

    // Requête préparée
    $req = mysqli_prepare($con, "SELECT * FROM utilisateurs WHERE email = ? AND mdp = ?");
    mysqli_stmt_bind_param($req, "ss", $email, $mdp);
    mysqli_stmt_execute($req);

    // Récupérer le résultat
    $result = mysqli_stmt_get_result($req);
    $num_ligne = mysqli_num_rows($result);

    if ($num_ligne > 0) {
        header('Location: index.php');
    } else {
        echo "Adresse email ou mot de passe incorrect";
    }
}
?>

<?php
error_reporting(-1);
ini_set("display_errors", 1);


require_once "../models/Users.php";
require_once "../models/Image.php";
require_once "../models/Question.php";
//require_once "../db/config.php";
require_once "../include/head.php";
require_once "../include/navigation.php";
require_once "../include/header.php";
require_once "../include/token.php";


// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];
    $new_user = new Users();
    $user = $new_user->getUserById($id_user);

    $nom = $user['nom'];
    $prenom = $user['prenom'];
    $email = $user['email'];
    $image = $user['photo_profil']; 
    

}else{
    
    header('Location: ../views/connexion.php');
    exit();
}


?>

<div class="dashboard-container">
    <h2>Bienvenue sur votre tableau de bord</h2>
    <p>Vous pouvez maintenant accéder à toutes les fonctionnalités réservées à nos utilisateurs inscrits.</p>
    <a href="deconnexion.php">Se déconnecter</a>
</div>


<?php require_once "../include/footer.php"; ?>
<?php
error_reporting(-1);
ini_set("display_errors", 1);


require_once "../models/Users.php";
require_once "../models/Image.php";
require_once "../models/Question.php";
require_once "../models/Commentaire.php";
//require_once "../db/config.php";
require_once "../include/head.php";
require_once "../include/nav_burger.php";
//require_once "../include/navigation.php";
require_once "../include/header.php";
require_once "../include/token.php";

if (isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];
    $new_user = new Users();
    $user = $new_user->getUserById($id_user);

    $nom = $user['nom'];
    $prenom = $user['prenom'];
    $email = $user['email'];
    $image = $user['photo_profil']; 
}

//instancier la methode getAllCommentaires
$commentaire = new Commentaire();
$commentaires = $commentaire->getAllCommentaires();
// Instanciation du gestionnaire  des utilisateurs


?>
<div class="content">

        <div class="annonces-list">
            <?php foreach ($commentaires as $commentaire): ?>
                <div class="annonce-card">
                    <div class="annonce-header">
                        <img src="../uploads/photo_profil/<?=$commentaire['photo_profil'] ?>" alt="Photo de profil" class="user-photo">
                        <div class="user-info">
                            <h3><?= htmlspecialchars($commentaire['prenom'] . ' ' . $commentaire['nom']) ?></h3>
                            <h3><?=$commentaire['email']?></h3>
                        </div>
                    </div>
                    
                    <div class="annonce-details">
                        <p class="departement"><?= htmlspecialchars($commentaire['etoile']) ?> Etoiles</p>
                        
                        <p class="description"><?= $commentaire['commentaire'];?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
</div>

<?php require_once "../include/footer.php"; ?>

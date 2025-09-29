<?php
error_reporting(-1);
ini_set("display_errors", 1);


require_once "../models/Users.php";
require_once "../models/Question.php";
require_once "../models/Reponse.php";
require_once "../db/config.php";
require_once "../include/head.php";
require_once "../include/nav_burger.php";
//require_once "../include/navigation.php";
require_once "../include/header.php";
//require_once "../include/token.php";


// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];
    $new_user = new Users();
    $user = $new_user->getUserById($id_user);

    //$questions = $new_question->questionByIdUser($id_user);
    $nom = $user['nom'];
    $prenom = $user['prenom'];
    $email = $user['email'];
    $image = $user['photo_profil'];

    $delete_user = new Users();
    $user = $delete_user->seDesinscrire();
        ?>
        <h1>Se désinscrire</h1>
        <?php
        echo '<div>
                <p class="warning">Nom : '.$nom.'</p>
                <p class="warning">Prénom : '.$prenom.'</p>
                <p class="warning">Email : '.$email.'</p> 
            </div>';
        ?>
        
            <?php if(isset($message)) echo "<div class='erreurs'>".$message."</div>"; ?>
        
            <p class="warning">
                Attention : La désinscription est irréversible.<br>
                Toutes vos questions et réponses seront définitivement supprimées.
            </p>
        <?php 
        
        ?>
            <form method="post">
                <div class="button-group">
                    
                    <button type="submit" class="confirm-button">Confirmer la désinscription</button>
                    
                    <a href="tableau_de_bord.php" class="cancel-button">Annuler</a>
                </div>
            </form>
        
       

        <?php
}else{
    header('Location: ../views/connexion.php');
    exit();
}
require_once "../include/footer.php";

?>
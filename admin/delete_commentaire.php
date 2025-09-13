<?php
error_reporting(-1);
ini_set("display_errors", 1);
//inclure les fichier nécéssaire

require_once "template/header.php";//fichier de l'accueil
require_once "../db/config.php";//fichier de connexion
require_once "../models/Commentaire.php";//fichier de classe


$commentaire = false;
$errors = [];
$messages = [];
if (isset($_GET["id_commentaire"])) {//ramener l'id du commentaire
    //instancier un commentaire
    $new_commentaire = new Commentaire();
      //pour ramener les commentaires par leur id
    $commentaire =  $new_commentaire->getCommentaireById( (int)$_GET["id_commentaire"]);
}
if ($commentaire) {//si il y a commentaire alors appel a la fonction (instance de classe) delete tel commentaire
    if ($commentaire = $new_commentaire->deleteCommentaire( $_GET["id_commentaire"])) {
        $messages[] = "Le commentaire à bien été supprimée";
    } else {
        $errors[] = "Une erreur s'est produite lors de la suppression";
    }
} else {
    $errors[] = "Le commentaire n'existe pas";
}
?>
<div class="row text-center my-5">
    <h1>Supression de commentaire</h1>
    <?php foreach ($messages as $message) { ?>
    <div class="alert alert-success" role="alert">
        <?= $message; ?>
    </div>
    <?php } ?>
    <?php foreach ($errors as $error) { ?>
    <div class="alert alert-danger" role="alert">
        <?= $error; ?>
    </div>
    <?php } ?>
</div>

<?php
require_once('template/footer.php');

?>
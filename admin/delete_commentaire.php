<?php
error_reporting(-1);
ini_set("display_errors", 1);
//incluer les fichier nécéssaire
//adminOnly();

require_once "template/header.php";
require_once "../db/config.php";
require_once "../models/Commentaire.php";

//$new_user = new Users();
//$user = $new_user->getUserById($id);


$commentaire = false;
$errors = [];
$messages = [];
if (isset($_GET["id_commentaire"])) {
    $new_commentaire = new Commentaire();
    $commentaire =  $new_commentaire->getCommentaireById( (int)$_GET["id_commentaire"]);
}
if ($commentaire) {
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
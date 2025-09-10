<?php
error_reporting(-1);
ini_set("display_errors", 1);
//incluer les fichier nécéssaire
//adminOnly();

require_once "template/header.php";
require_once "../db/config.php";
require_once "../models/Reponse.php";

//$new_user = new Users();
//$user = $new_user->getUserById($id);


$reponse = false;
$errors = [];
$messages = [];
if (isset($_GET["id_reponse"])) {
    $new_reponse = new Reponse();
    $reponse =  $new_reponse->reponseById( (int)$_GET["id_reponse"]);
}
if ($reponse) {
    if ($reponse = $new_reponse->deleteReponse( $_GET["id_reponse"])) {
        $messages[] = "La reponse à bien été supprimée";
    } else {
        $errors[] = "Une erreur s'est produite lors de la suppression";
    }
} else {
    $errors[] = "La reponse n'existe pas";
}
?>
<div class="row text-center my-5">
    <h1>Supression de reponse</h1>
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
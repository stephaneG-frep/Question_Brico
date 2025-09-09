<?php
error_reporting(-1);
ini_set("display_errors", 1);
//incluer les fichier nécéssaire
//adminOnly();

require_once "template/header.php";
require_once "../db/config.php";
require_once "../models/Astuce.php";

//$new_user = new Users();
//$user = $new_user->getUserById($id);


$commentaire = false;
$errors = [];
$messages = [];
if (isset($_GET["id_astuce"])) {
    $new_astuce = new Astuce();
    $astuce =  $new_astuce->getAstuceById( (int)$_GET["id_astuce"]);
}
if ($astuce) {
    if ($astuce = $new_astuce->deleteAstuce( $_GET["id_astuce"])) {
        $messages[] = "L'astuce à bien été supprimée";
    } else {
        $errors[] = "Une erreur s'est produite lors de la suppression";
    }
} else {
    $errors[] = "cette astuce n'existe pas";
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
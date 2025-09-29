<?php
error_reporting(-1);
ini_set("display_errors", 1);


require_once "template/header.php";//fichier de l'accueil
require_once "../db/config.php";// fichier de la connexion
require_once "../models/Astuce.php";// fichier de classe Astuce

$astuce = false;
$errors = [];
$messages = [];
if (isset($_GET["id_astuce"])) { //ramener l'id de l'astuce
    //instancier une astuce
    $new_astuce = new Astuce();
    //pour ramener les astuces par leur id
    $astuce =  $new_astuce->getAstuceById( (int)$_GET["id_astuce"]);
}
if ($astuce) { //si il y a astuce alors appel a la fonction (instance de classe) delete telle astuce
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
    <h1>Supression d'astuce</h1>
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
<?php
error_reporting(-1);
ini_set("display_errors", 1);
//inclure les fichier nécéssaire

require_once "template/header.php";//fichier de l'accueil
require_once "../db/config.php";//fichier de connexion
require_once "../Users.php";//fichier de classe


$user = false;
$errors = [];
$messages = [];
if (isset($_GET["id"])) {//ramener l'id de l'utilisateur
    //instancier un user
    $new_user = new Users();
    //pour ramener les users par leur id
    $user =  $new_user->getUserById( (int)$_GET["id"]);
}
if ($user) {//si il y a user alors appel a la fonction (instance de classe) delete tel user
    if ($user = $new_user->deleteUser( $_GET["id"])) {
        $messages[] = "L'employer a bien été supprimé";
    } else {
        $errors[] = "Une erreur s'est produite lors de la suppression";
    }
} else {
    $errors[] = "L'employer n'existe pas";
}
?>
<div class="row text-center my-5">
    <h1>Supression d'user</h1>
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
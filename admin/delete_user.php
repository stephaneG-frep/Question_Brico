<?php
error_reporting(-1);
ini_set("display_errors", 1);
//incluer les fichier nécéssaire

require_once "../session/session.php";
//adminOnly();

require_once "template/header.php";
require_once "../db/config.php";
require_once "../Users.php";

//$new_user = new Users();
//$user = $new_user->getUserById($id);


$user = false;
$errors = [];
$messages = [];
if (isset($_GET["id"])) {
    $new_user = new Users();
    $user =  $new_user->getUserById( (int)$_GET["id"]);
}
if ($user) {
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
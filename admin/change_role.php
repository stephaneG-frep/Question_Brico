<?php
error_reporting(-1);
ini_set("display_errors", 1);
//incluer les fichier nécéssaire
//adminOnly();

require_once "template/header.php";
require_once "../db/config.php";
require_once "../models/Users.php";

//$new_user = new Users();
//$user = $new_user->getUserById($id);


$user = false;
$errors = [];
$messages = [];
if (isset($_GET["id_user"])) {
    $new_user = new Users();
    $user =  $new_user->getByRole( $role);
}
if ($role) {
    if ($role = $new_role->updateRole( $new_role)) {
        $messages[] = "La role à bien été changé";
    } else {
        $errors[] = "Une erreur s'est produite lors de la suppression";
    }
} else {
    $errors[] = "Le role n'existe pas";
}
?>
<div class="row text-center my-5">
    <h1>Changer de role</h1>
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
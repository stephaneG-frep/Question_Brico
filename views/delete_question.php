<?php
error_reporting(-1);
ini_set("display_errors", 1);
//incluer les fichier nécéssaire

require_once "../models/Users.php";
require_once "../models/Image.php";
require_once "../models/Question.php";
require_once "../db/config.php";
require_once "../include/head.php";
require_once "../include/navigation.php";
require_once "../include/header.php";
//require_once "../include/token.php";


$question = false;
$errors = [];
$messages = [];
if (isset($_GET["id_user"])) {
    $new_question = new Question();
    $question =  $new_question->questionById( (int)$_GET["id_user"]);
}
if ($question) {
    if ($question = $new_question->deleteQuestion( $_GET["id_user"])) {
        $messages[] = "L'annonce a bien été supprimée";
    } else {
        $errors[] = "Une erreur s'est produite lors de la suppression";
    }
} else {
    $errors[] = "L'annonce n'existe pas";
}
?>
<div class="row text-center my-5">
    <h1>Supression de votre question</h1>
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
require_once('../include/footer.php');

?>
<?php
error_reporting(-1);
ini_set("display_errors", 1);
//incluer les fichier nécéssaire
//adminOnly();

require_once "template/header.php";
require_once "../db/config.php";
require_once "../models/Question.php";

//$new_user = new Users();
//$user = $new_user->getUserById($id);


$question = false;
$errors = [];
$messages = [];
if (isset($_GET["id_question"])) {
    $new_question = new Question();
    $question =  $new_question->questionById( (int)$_GET["id_question"]);
}
if ($question) {
    if ($question = $new_question->deleteQuestion( $_GET["id_question"])) {
        $messages[] = "La question à bien été supprimée";
    } else {
        $errors[] = "Une erreur s'est produite lors de la suppression";
    }
} else {
    $errors[] = "La question n'existe pas";
}
?>
<div class="row text-center my-5">
    <h1>Supression de question</h1>
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
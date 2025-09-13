<?php
error_reporting(-1);
ini_set("display_errors", 1);
//inclure les fichier nécéssaire

require_once "template/header.php";//fichier de l'accueil
require_once "../db/config.php";//fichier de connexion
require_once "../models/Question.php";//fichier de classe 


$question = false;
$errors = [];
$messages = [];
if (isset($_GET["id_question"])) {//ramener l'id de la question
    //instancier une question avec sa class
    $new_question = new Question();
       //pour ramener les questions par leur id
    $question =  $new_question->questionById( (int)$_GET["id_question"]);
}
if ($question) {//si il y a question alors appel a la fonction (instance de classe) delete telle question
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
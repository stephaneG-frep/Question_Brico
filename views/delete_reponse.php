<?php
error_reporting(-1);
ini_set("display_errors", 1);
//incluer les fichier nécéssaire

require_once "../models/Users.php";
require_once "../models/Question.php";
require_once "../models/Reponse.php";
require_once "../db/config.php";
require_once "../include/head.php";
require_once "../include/nav_burger.php";
require_once "../include/header.php";

if (!isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];
    $new_user = new Users();
    $user = $new_user->getUserById($id_user);

    die("Vous devez être connecté pour supprimer une question.");
}

if (!isset($_GET['id_reponse'])) {
    die("ID de la question non spécifié.");
}

$id_reponse = $_GET['id_reponse'];

// Vérifier que l'utilisateur est bien l'auteur de la reponse
$user_reponse = new Reponse();
$reponse = $user_reponse->idUserAndIdReponse($id_reponse);

if (!$reponse || $reponse['id_user'] != $_SESSION['id_user']) {
    die("Vous n'êtes pas autorisé à supprimer cette question.");
}

// instancier une reponse pour Supprimer la reponse
$new_reponse = new Reponse();
$result = $new_reponse->deleteReponse($id_reponse);
if($result){
    header("Location: tableau_de_bord.php");
    exit();
} else {
    header("location: tableau_de_bord.php");
    die("Erreur lors de la suppression de la question.");
}
?>


<?php
require_once('../include/footer.php');

?>
<?php
error_reporting(-1);
ini_set("display_errors", 1);

require_once "../models/Users.php";
require_once "../models/Image.php";
require_once "../models/Question.php";
require_once "../models/Reponse.php";
require_once "../db/config.php";
require_once "../include/head.php";
require_once "../include/navigation.php";
require_once "../include/header.php";

if (isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];
    $new_user = new Users();
    $user = $new_user->getUserById($id_user);

    $nom = $user['nom'];
    $prenom = $user['prenom'];
    $email = $user['email'];
    $image = $user['photo_profil']; 
            
}else{   
    header('Location: ../views/connexion.php');
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reponse = $_POST['reponse'];
    $id_question = $_POST['id_question'];
    $id_user = $_SESSION['id_user'];

    $new_reponse = new Reponse();

    if ($reponse = $new_reponse->registerReponse($reponse, $id_user, $id_question)) {
        echo "Réponse ajoutée avec succès !";
    } else {
        echo "Erreur lors de l'ajout de la réponse.";
    }
}
?>
<?php if(isset($message)) echo "<div class='erreurs'>".$message."</div>"; ?>
<h2 class="h2">Votre reponse</h2>

<form method="post">
    Réponse : <textarea name="reponse" required></textarea><br>
    <input type="hidden" name="id_question" value="<?= htmlspecialchars($_GET['id_question']) ?>">
    <button type="submit">Répondre</button>
</form>

<?php
require_once "../include/footer.php";

?>
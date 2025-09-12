<?php
error_reporting(-1);
ini_set("display_errors", 1);

require_once "../models/Users.php";
require_once "../models/Astuce.php";
require_once "../models/Question.php";
require_once "../models/Reponse.php";
require_once "../models/Commentaire.php";
require_once "../db/config.php";
require_once "../include/head.php";
require_once "../include/nav_burger.php";
//require_once "../include/navigation.php";
require_once "../include/header.php";
//require_once "../include/token.php";
// si il y a un id donc un user instancier un nouvel user et l'appeler avec la méthode getUser...
// de la classe Users
if (isset($_SESSION['id_user'])) {
    $id = $_SESSION['id_user'];
    $new_user = new Users();
    $user = $new_user->getUserById($id_user);


    //$id = $id['id'];
    $nom = $user['nom'];
    $prenom = $user['prenom'];
    $email = $user['email'];
    $image = $user['photo_profil']; 
    //$annonce = $user['annonce'];
//sino retour a la page de connexion
}else{
    
    header('Location: connexion.php');
    exit();
}

//si on poste "attribuer"
if(isset($_POST['attribuer'])){
    //alors l'avis est vérifier pour la sécuritée
    $date = htmlspecialchars($_POST['date']);
    $commentaire = htmlspecialchars($_POST['commentaire']);
    $etoile = htmlspecialchars($_POST['etoile']);
    //tous doit etre remplis dans le formulaire
    if(empty($_POST['date'])){
        $message = "N'oublier pas la date";
    }elseif(empty($_POST['commentaire'])){
        $message = "Ecrire un commentaire";
    }elseif(empty($_POST['etoile'])){
        $message = "Attribuer au moins une étoile";
    }else{
        $commentaire = $_POST['commentaire'];
        $etoile = $_POST['etoile'];
        //instancier un nouvel avis et méthode de la requete SQL
        $new_commentaire = new Commentaire();
        $result = $new_commentaire->registerCommentaire($date, $commentaire,$etoile,$id_user);

        if($result){
            header("location: ../public/index.php");
            exit();
        }else{
            $message = "Erreur lors de l'execution du commentaire";
        }
    }

}

?>
<h1>Bienvenue, <?php echo $user['prenom']." ". $user['nom']; ?>!</h1>    
<p>Email: <?php echo $user['email']; ?></p>

<div class="inscrip">
    <h2 class="h2">Deposer un avis un commentaire</h2>
    
    <?php if(isset($message)) echo "<div class='erreurs'>".$message."</div>"; ?>

        <form method="POST" action="">
            Date du jour : <br>
            <input type="text" name="date" placeholder="la date du jour">
            <br>
            Commentaire : <br>
            <textarea type="text" name="commentaire" cols="40px" rows="10px"
             placeholder="petit commentaire pas trop long"></textarea>    
            <br>
            Nombre d'etoiles : <br>
            <select name="etoile" id="pet-select">
                <option  value="">--Attribuer des étoiles--</option>
                <option name="etoile" value="1">1</option>
                <option name="etoile" value="2">2</option>
                <option name="etoile" value="3">3</option>
                <option name="etoile" value="4">4</option>
                <option name="etoile" value="5">5</option>
            </select>
            <br>
            Attribuer :
            <input type="submit" name="attribuer" value="attribuer">
        </form>
</div>



<?php require_once "../include/footer.php"; ?>
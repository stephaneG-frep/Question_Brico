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

if(isset($_POST['envoyer'])){
    
    $reponse = htmlspecialchars($_POST['reponse']);

    if(empty($_POST['reponse'])){
        $message = "ecrire une reponse";

        $new_reponse = new Reponse();
        $reponse = $new_reponse->reponseByIdQuestion($id_user,$id_question);
        
        if($resultat){
            header("location:../public/index.php");
            exit();
        }
    }else {
        $message = "Erreur de dépot de la reponse";
    }
    
}

?>
  

<h1>Bienvenue, <?php echo $user['prenom']." ". $user['nom']; ?>!</h1>    
<p>Email: <?php echo $user['email']; ?></p>

<div class="inscrip">
<?php if(isset($message)) echo "<div class='erreurs'>".$message."</div>"; ?>

    <h2 class="h2">Votre reponse</h2>

    <form method="POST" action="" enctype="multipart/form-data">
       <br>
     
        Votre réponse : <br>
        <textarea type="text" name="reponse" id="reponse" placeholder="ma reponse"></textarea>
        <br><br>
        Repondre a la question : 
        <input type="submit" name="envoyer"
            value="Envoyer la reponse" >
        <br>
    </form>
</div>
<div class="connect">
     <a href="../views/connexion.php">Déja un compte?Connectez-vous</a>       
</div>

<?php
require_once "../include/footer.php";

?>
<?php
error_reporting(-1);
ini_set("display_errors", 1);


require_once "../models/Users.php";
require_once "../db/config.php";
require_once "../include/head.php";
require_once "../include/navigation.php";
require_once "../include/header.php";





?>

<div class="inscrip">
<?php if(isset($message)) echo "<div class='erreurs'>".$message."</div>"; ?>

    <h2 class="h2">Votre question</h2>

    <form method="POST" action="" enctype="multipart/form-data">
        Votre Nom : 
        <input type="text" name="nom" id="nom" placeholder="votre nom">
        <br>
        Votre Prénom : 
        <input type="text" name="prenom" id="prenom" placeholder="votre prénom">
        <br>
        Votre E-mail : 
        <input type="email" name="email" id="email" placeholder="email: exemple@exemple.com">
        <br>
        Votre question : 
        <textarea type="" name="question" id="question" placeholder="ma question"></textarea>
        <br>
        Photo 1 :
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
        <input type="file" name="image_1" id="image_1">
        <br>
        Photo 2 :
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
        <input type="file" name="image_2" id="image_2">
        <br> 
        Photo 3 :
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
        <input type="file" name="image_3" id="image_3">
        <br> 
        Photo 4 :
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
        <input type="file" name="image_4" id="image_4">
        <br> 
        Photo 5 :
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
        <input type="file" name="image_5" id="image_5">
        <br> 
        Inscription : 
        <input type="submit" name="inscription"
                value="Créer un compte" >
        <br>

    </form>
</div>
<div class="connect">
     <a href="../views/connexion.php">Déja un compte?Connectez-vous</a>       
</div>

<?php
require_once "../include/footer.php";

?>

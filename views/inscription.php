<?php

require_once "../models/Users.php";
require_once "../core/config.php";
require_once "../include/head.php";
require_once "../include/navigation.php";
require_once "../include/header.php";


?>

<div class="inscrip">
<?php if(isset($message)) echo "<div class='erreurs'>".$message."</div>"; ?>

    <h2 class="h2">Inscription</h2>

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
        Votre mot de passe :
        <input type="password" name="password" id="password" placeholder="mot de passe">
        <br>
        
        Photo de profil :
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
        <input type="file" name="photo_profil" id="photo_profil">
        <br>      
        Inscription : 
        <input type="submit" name="inscription"
                value="Créer un compte" >
        <br>

    </form>
</div>
<div class="connect">
     <a href="views/user/connexion.php">Déja un compte?Connectez-vous</a>       
</div>

<?php
require_once "../include/footer.php";

?>
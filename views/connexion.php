<?php

require_once "../models/Users.php";
require_once "../core/config.php";
require_once "../include/head.php";
require_once "../include/navigation.php";
require_once "../include/header.php";

?>

<div class="inscrip">
    <h2 class="h2">Connexion</h2>
    
    <?php if(isset($message)) echo "<div class='erreurs'>".$message."</div>"; ?>

        <form method="POST" action="">
            Email :
            <input type="email" name="email" required >
            <br>
            Mot de passe :
            <input type="password" name="password" required>
            <br>
            Connexion :
            <input type="submit" name="connexion" value="connexion">
        </form>
</div>

<?php
require_once "../include/footer.php";

?>
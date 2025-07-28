<?php

$pageTitle = "Page de connexion";

ob_start();

?>

<div class="inscrip">
    <h2 class="h2">Connexion</h2>
    
    <?php if(isset($message)) echo "<div class='erreurs'>".$message."</div>"; ?>

        <form method="POST">
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
$content = ob_get_clean();
include('views/include/template.php');

?>
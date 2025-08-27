<?php

//require_once "../core/config.php";

?>

<nav class="nav">
    <ul class="nav-link">
        <li><a href="../public/index.php">Accueil</a></li>
        <?php 
            if(!isset($_SESSION['id_user'])){   
        ?>    
        <li><a href="../views/inscription.php">Inscription</a></li>
        <li><a href="../views/connexion.php">Connexion</a></li>
        <?php             
            }else{
        ?>
        <li><a href="../views/question.php">Questions</a></li>
        <li><a href="../views/tableau_de_bord.php">Votre tableau de bord</a></li>
        <li><button class="deconnect"><a href="../views/deconnexion.php">OFF</a></button></li>

        <?php
            }
        ?>
    </ul>
</nav>
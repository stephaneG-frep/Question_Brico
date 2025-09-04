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
//require_once "../include/token.php";
// Détermine si l'utilisateur est connecté
if (isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];
    $new_user = new Users();
    $user = $new_user->getUserById($id_user);
    $is_logged_in = isset($_SESSION['id_user']);

    //$questions = $new_question->questionByIdUser($id_user);
    $nom = $user['nom'];
    $prenom = $user['prenom'];
    $email = $user['email'];
    $image = $user['photo_profil'];
}
// Vérifier si l'utilisateur est connecté

?>


<?php $is_logged_in = isset($_SESSION['id_user']); ?>
<!-- Barre de navigation -->
<nav class="navbar">
        <!-- Logo/marque -->
        <a href="../public/index.php" class="navbar-brand">
            <i class="fas fa-tools"></i> Question_Brico
        </a>

        <!-- Menu burger (mobile) -->
        <button class="navbar-toggle" id="navbarToggle">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Menu principal (desktop) -->
        <ul class="navbar-menu" id="navbarMenu">
            <li><a href="../public/index.php"><i class="fas fa-home"></i> Accueil</a></li>
            <li><a href="../views/a_propos.php"><i class="fas fa-info-circle"></i> À propos</a></li>
            <li><a href="../views/contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
            <?php if ($is_logged_in): ?>
                <li><a href="../views/tableau_de_bord.php"><i class="fas fa-tachometer-alt"></i> Tableau de bord</a></li>
            <?php endif; ?>
        </ul>

        <!-- Section authentification -->
        <div class="navbar-auth">
            <?php if ($is_logged_in): ?>
                <div class="user-profile">
                    <?php if (!empty($image)): ?>
                        <img src="../uploads/photo_profil/<?= $image ?>" alt="Photo de profil" class="user-photo">
                    <?php endif; ?>
                    <a href="../views/tableau_de_bord.php"><?= $prenom ?></a>
                </div>
                <a href="../views/deconnexion.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
            <?php else: ?>
                <a href="../views/connexion.php"><i class="fas fa-sign-in-alt"></i> Connexion</a>
                <a href="../views/inscription.php" class="button"><i class="fas fa-user-plus"></i> Inscription</a>
            <?php endif; ?>
        </div>

        <!-- Menu mobile -->
        <ul class="mobile-menu" id="mobileMenu">
            <li><a href="../public/index.php"><i class="fas fa-home"></i> Accueil</a></li>
            <li><a href="../views/a_propos.php"><i class="fas fa-info-circle"></i> À propos</a></li>
            <li><a href="../views/contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
            <?php if ($is_logged_in): ?>
                <li><a href="../views/tableau_de_bord.php"><i class="fas fa-tachometer-alt"></i> Tableau de bord</a></li>
                <li><a href="../views/deconnexion.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>
            <?php else: ?>
                <li><a href="../views/connexion.php"><i class="fas fa-sign-in-alt"></i> Connexion</a></li>
                <li><a href="../views/inscription.php"><i class="fas fa-user-plus"></i> Inscription</a></li>
            <?php endif; ?>
        </ul>
    </nav>



 <!-- Script pour le menu mobile -->
 <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.getElementById('navbarToggle');
            const menu = document.getElementById('mobileMenu');

            toggle.addEventListener('click', function() {
                menu.classList.toggle('active');
            });
        });
    </script>

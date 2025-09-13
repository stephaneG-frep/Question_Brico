<?php
error_reporting(-1);
ini_set("display_errors", 1);


require_once "../models/Users.php";
require_once "../models/Image.php";
require_once "../models/Question.php";
require_once "../models/Reponse.php";
require_once "../models/Astuce.php";
require_once "../db/config.php";
require_once "../include/head.php";
//require_once "../include/navigation.php";
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

?>

    <div class="logo">
        <a href="../public/index.php" class="navbar-brand">
            <i class="fas fa-tools"></i> Question_Brico
        </a>
   

    <button class="burger-btn" id="burgerBtn">
        <div class="burger-line"></div>
        <div class="burger-line"></div>
        <div class="burger-line"></div>
    </button>

    <nav class="menu" id="menu">

    <?php if ($is_logged_in): ?>
            <div class="user-profile">
            <a href="#" class="name-burger"><?= $prenom ?></a>
                <?php if (!empty($image)): ?>
                    <img src="../uploads/photo_profil/<?= $image ?>"                     
                    alt="Photo de profil" class="user-photo">                    
                <?php endif; ?>
                <a href="#" class="name-burger"><?= $prenom ?></a>
            </div>
    <?php endif; ?>


        <a href="../public/index.php"><i class="fas fa-home"></i> Accueil</a>
        <a href="../views/inscription.php"><i class="fas fa-user-plus"></i> Inscription</a>
        <a href="../views/connexion.php"><i class="fas fa-sign-in-alt"></i> Connexion</a>

        <?php if ($is_logged_in): ?>       
        <a href="../views/tableau_de_bord.php"><i class="fas fa-tachometer-alt"></i> Tableau de bord</a>
        <a href="../views/recherche.php"><i class="fa-brands fa-sistrix"></i> Recherche</a>
        <a href="../views/astuce.php "><i class="fa-solid fa-lightbulb"></i> Les astuces</a>
        <a href="../views/commentaire.php"><i class="fa-solid fa-thumbs-up"></i> Commentaires <i class="fa-solid fa-thumbs-down"></i></a>
        <?php endif; ?>
    </nav>
    </div>
    <script>
        const burgerBtn = document.getElementById('burgerBtn');
        const menu = document.getElementById('menu');

        burgerBtn.addEventListener('click', () => {
            burgerBtn.classList.toggle('active');
            menu.classList.toggle('active');
        });
    </script>

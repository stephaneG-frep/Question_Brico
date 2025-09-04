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
$is_logged_in = isset($_SESSION['id_user']);
?>


    <style>
        /* Reset et base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Barre de navigation */
        .navbar {
            background-color: #2c3e50;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }

        .navbar-brand {
            font-size: 1.5em;
            font-weight: bold;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .navbar-brand i {
            margin-right: 10px;
        }

        /* Bouton burger */
        .navbar-toggle {
            background: none;
            border: none;
            color: white;
            font-size: 1.5em;
            cursor: pointer;
            padding: 5px;
        }

        /* Menu (masqué par défaut) */
        .navbar-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background-color: #34495e;
            flex-direction: column;
            padding: 15px 20px;
            z-index: 1000;
            border-radius: 0 0 8px 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-menu.active {
            display: flex;
        }

        .navbar-menu li {
            margin: 10px 0;
            list-style: none;
        }

        .navbar-menu a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .navbar-menu a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .navbar-menu a:hover {
            color: #3498db;
        }

        /* Style pour les éléments du menu */
        .menu-item {
            display: flex;
            align-items: center;
        }

        .user-info {
            display: flex;
            align-items: center;
            padding: 10px 0;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 10px;
        }

        .user-photo {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
        }

        /* Overlay pour fermer le menu en cliquant à côté */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .overlay.active {
            display: block;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Overlay pour fermer le menu -->
    <div class="overlay" id="menuOverlay"></div>

    <!-- Barre de navigation -->
    <nav class="navbar">
        <!-- Logo/marque -->
        <a href="index.php" class="navbar-brand">
            <i class="fas fa-tools"></i> Question_Brico
        </a>

        <!-- Bouton burger -->
        <button class="navbar-toggle" id="navbarToggle">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Menu -->
        <ul class="navbar-menu" id="navbarMenu">
            <li><a href="index.php"><i class="fas fa-home"></i> Accueil</a></li>
            <li><a href="apropos.php"><i class="fas fa-info-circle"></i> À propos</a></li>
            <li><a href="contact.php"><i class="fas fa-envelope"></i> Contact</a></li>

            <?php if ($is_logged_in): ?>
                <li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Tableau de bord</a></li>
                <li><a href="formulaire_question.php"><i class="fas fa-question-circle"></i> Poser une question</a></li>
                <div class="user-info">
                    <?php if (!empty($_SESSION['photo_profil'])): ?>
                        <img src="<?= htmlspecialchars($_SESSION['photo_profil']) ?>" alt="Photo de profil" class="user-photo">
                    <?php endif; ?>
                    <a href="dashboard.php" class="menu-item">
                        <span><?= htmlspecialchars($_SESSION['prenom']) ?></span>
                    </a>
                </div>
                <li><a href="deconnexion.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>
            <?php else: ?>
                <li><a href="connexion.php"><i class="fas fa-sign-in-alt"></i> Connexion</a></li>
                <li><a href="inscription.php"><i class="fas fa-user-plus"></i> Inscription</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <!-- Script pour le menu burger -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.getElementById('navbarToggle');
            const menu = document.getElementById('navbarMenu');
            const overlay = document.getElementById('menuOverlay');

            // Ouvre/ferme le menu
            toggle.addEventListener('click', function() {
                menu.classList.toggle('active');
                overlay.classList.toggle('active');
            });

            // Ferme le menu si on clique sur l'overlay
            overlay.addEventListener('click', function() {
                menu.classList.remove('active');
                overlay.classList.remove('active');
            });
        });
    </script>


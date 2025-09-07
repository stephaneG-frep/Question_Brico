<?php         
error_reporting(-1);
ini_set("display_errors", 1);


require_once "../models/Users.php";
require_once "../models/Image.php";
require_once "../models/Question.php";
require_once "../models/Astuce.php";
require_once "../db/config.php";
require_once "../include/head.php";
require_once "../include/nav_burger.php";
//require_once "../include/navigation.php";
require_once "../include/header.php";
require_once "../include/token.php";

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

$astuce = new Astuce();
$astuces = $astuce->getAllAstuces();

?>
<div class="container">

        <div class="annonces-list">
            <?php foreach ($astuces as $astuce): ?>
                <div class="question">
                    <div class="annonce-header">
                        <img src="../uploads/photo_profil/<?=$astuce['photo_profil'] ?>" alt="Photo de profil" class="user-photo">
                        <div class="user-info">
                            <h3><?= htmlspecialchars($astuce['prenom'] . ' ' . $astuce['nom']) ?></h3>
                            <h3><?=$astuce['email']?></h3>
                        </div>
                        
                    </div>
                    <div class="question-text"><H5>
                            <?=nl2br(htmlspecialchars($astuce['astuce'])) ?>
                        </h5>
                    </div>                   
                    <!-- Afficher les images si elles existent -->                            
                         <?php if (!empty($astuce['image_1']) || !empty($astuce['image_2']) || 
                                !empty($astuce['image_3'])): ?>
                                <div class="question-images">
                            <?php for ($i = 1; $i <= 3; $i++):
                                    $image = $astuce["image_$i"] ?>
                                    <?php if (!empty($image)): ?>                                 
                                        <img src="../uploads/img/<?= htmlspecialchars($image) ?>" alt="Image de l'astuce">
                                    <?php endif ?>
                            <?php endfor; ?>
                                </div>
                        <?php endif; ?>
                        
                </div>
            <?php endforeach; ?>
        </div>
</div>

<?php require_once "../include/footer.php"; ?>

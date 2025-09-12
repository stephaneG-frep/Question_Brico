<?php
error_reporting(-1);
ini_set("display_errors", 1);


require_once "../models/Users.php";
require_once "../models/Astuce.php";
require_once "../models/Question.php";
require_once "../models/Reponse.php";
require_once "../models/Commentaire.php";
require_once "../db/config.php";
require_once "../include/head.php";
require_once "../include/nav_burger.php";
//require_once "../include/navigation.php";
require_once "../include/header.php";
//require_once "../include/token.php";


// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];
    $new_user = new Users();
    $user = $new_user->getUserById($id_user);

    //$questions = $new_question->questionByIdUser($id_user);
    $nom = $user['nom'];
    $prenom = $user['prenom'];
    $email = $user['email'];
    $image = $user['photo_profil'];
    $role = $user['role'];


        echo '

        <br><br>
        <div class="dashboard-container">        
            <section class="item-1">
                <div class="item-1a">
                    <img class="photo_profil" src="../uploads/photo_profil/'.$image.'" alt="photo de profil">  
                </div>
                <p class="dash">Nom : '.$nom.'</p>
                <p class="dash">Prénom : '.$prenom.'</p>
                <p class="dash">Email : '.$email.'</p> 
                <p class="dash">Role : '.$user['role'].'</p>
                <br>
                <p class="dash">Vous pouvez maintenant accéder à toutes les fonctionnalités réservées à nos utilisateurs inscrits.</p>
                    <a class="dashboard" href="question.php"><i class="fa-solid fa-question"></i> Poser une question</a>
                    <a class="dashboard" href="deconnexion.php"><i class="fas fa-sign-out-alt"></i> Se déconnecter</a>
                    <a class="dashboard" href="change_profil.php"><i class="fa-solid fa-id-card-clip"></i> Changer le profil</a>
                    <a class="dashboard" href="se_desinscrire.php"><i class="fa-solid fa-user-slash"></i> Se désinscrire</a>
                    <a class="dashboard" href="post_astuce.php"><i class="fa-solid fa-lightbulb"></i> Poster une astuces</a>
                    <a class="dashboard" href="post_commentaire.php"><i class="fa-solid fa-comments"></i> Poster un commentaire</a>
            </section>
    
        </div>';
 ?>
 
 <?php
    if($user['role'] === "admin"){
?>
    <p class="admin"><a href="../admin/index.php">Administration</a></p>   
<?php
}
?>

<h2 class="dashboard-title">Mes questions</h2>
<p>Merci de supprimer vos questions au bout de 3 semaines...</p>

<div class="container">
<?php

    $new_question = new Question();
    $questions = $new_question->questionByIdUser($id_user);

    if (empty($questions)) {
        echo "<p class='no_question'>Aucune question trouvée.</p>";   
    }else{
        foreach ($questions as $question) {
            echo '<div class="question"><p>Posté le : '
            . htmlspecialchars($question['date']) .'</p>' ;
                echo '<div class="question-theme">' 
                        . htmlspecialchars($question['theme']) .
                     '</div>';
                echo '<div class="question-text">
                            <h5>' . nl2br(htmlspecialchars($question['question'])) . '</h5>
                      </div>';

            // Afficher les images si elles existent
            if (!empty($question['image_1']) || !empty($question['image_2']) || 
                !empty($question['image_3']) || !empty($question['image_4']) || 
                !empty($question['image_5'])) {
                echo '<div class="question-images">';
                for ($i = 1; $i <= 5; $i++) {
                    $image = $question["image_$i"];
                    if (!empty($image)) {
                        echo '<img src="../uploads/img/' . htmlspecialchars($image) . '" alt="Image question">';
                    }
                }
                echo'</div>';
                
            }
            echo '<div class="question-author">
                        Posée par : ' . htmlspecialchars($question['prenom'] . ' ' 
                        . $question['nom']) . 
                 '</div><br>';
            echo'<a href="delete_question.php?id_question=' . $question['id_question'] . '"
                           class="reply-button">Supprimer</a>
            </div>';
         // Afficher les réponses existantes
            $reponse = new Reponse();
            $reponses = $reponse->getReponsesForQuestion($question['id_question']);

            if (!empty($reponses)) {  
                echo '<div class="reponses">';
                foreach ($reponses as $reponse) {
                    echo '<div class="reponse"><p>Posté le : '
                                . htmlspecialchars($reponse['date']) .'</p>';
                        echo '<h5><strong>Une reponse de : ' . htmlspecialchars($reponse['prenom']
                         . ' ' . $reponse['nom']) . ' :</strong> ' . nl2br(htmlspecialchars($reponse['reponse'])) . '</h5>';
                        echo '</div><hr>';
                    
                }
                echo'</div>';
          }
        }
        echo '</div>';
    } ?>

        <h2 class="dashboard-title">Mes Réponses</h2>
        <p>Merci de supprimer vos réponses au bout de 3 semaines...</p>
        
        <?php

            $new_reponse = new Reponse();
            $reponses = $new_reponse->reponseByIdUser($id_user);

            if (empty($reponses)) {
                echo "<p class='no_question'>Aucune reponse trouvée.</p>";   
            }else{ 
                echo '<div class="reponses">';
                foreach ($reponses as $reponse) {
                    echo '<div class="reponse">';
                        echo '<h5><strong>une reponse de : <br>' . 
                        htmlspecialchars($reponse['prenom'] . ' ' 
                        . $reponse['nom']) . ' :</strong> ' .
                         nl2br(htmlspecialchars($reponse['reponse'])) . 
                         '</h5>';
                    echo '</div><hr>';
                    
                    echo'<a href="delete_reponse.php?id_reponse=' . $reponse['id_reponse'] . '"
                    class="reply-button">Supprimer</a>';
                }
                echo '</div>';
            }
         ?>
            <h2 class="dashboard-title">Mes Astuces</h2>
            <p>Merci de supprimer vos astuces au bout de 3 semaines...</p>
        <?php    
            $new_astuce = new Astuce();
            $astuces = $new_astuce->astuceByIdUser($id_user);
        ?>
        
        <?php if (empty($astuces)): ?>
                <p class='no_question'>Aucune astuce trouvée.</p> 
        <?php endif; ?>
        <?php if(!empty($astuces)): ?> 
            <div class="annonces-list">
            <?php foreach ($astuces as $astuce): ?>
                <div class="question-astuce">
                    <div class="annonce-header">
                        <img src="../uploads/photo_profil/<?=$astuce['photo_profil'] ?>" alt="Photo de profil" class="user-photo">
                        <div class="user-info">
                            <h3><?= htmlspecialchars($astuce['prenom'] . ' ' . $astuce['nom']) ?></h3>
                            <h3><?=$astuce['email']?></h3>
                        </div>
                        
                    </div>
                    <div class="question-text">
                        <p>Posté le : <?= htmlspecialchars($astuce['date'])?></p>
                        <h5>
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
                        <a href="delete_astuce.php?id_astuce= <?=$astuce['id_astuce']; ?>"
                                 class="reply-button">Supprimer</a>
                        
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        </div>

        <h2 class="dashboard-title">Mes Commentaires</h2>
        <p>Merci de supprimer vos commentaires au bout de 3 semaines...</p> 
        <?php
        $new_commentaire = new Commentaire();
        $commentaires = $new_commentaire->commentaireByIdUser($id_user);
        ?>
 
        <?php if (empty($commentaires)): ?>
            <p class='no_question'>Aucun commentaire trouvée.</p> 
        <?php endif; ?>
        <?php if(!empty($commentaires)): ?> 

    <div class="content">
        <div class="annonces-list">
        <?php foreach ($commentaires as $commentaire): ?>
            <div class="annonce-card">
                <div class="annonce-header">              
                        <img src="../uploads/photo_profil/<?=$commentaire['photo_profil'] ?>" alt="Photo de profil" class="user-photo"> 
                    <div class="user-info">                     
                        <h3><?= htmlspecialchars($commentaire['prenom'] . ' ' . $commentaire['nom']) ?></h3>
                        <h3><?=$commentaire['email']?></h3>
                        
                    </div>
                </div>
                    <div class="annonce-details">
                        <p>Posté le : <?= htmlspecialchars($commentaire['date']) ?></p>          
                        <h5 class="etoile"><?= htmlspecialchars($commentaire['etoile']) ?> Etoiles</5>                    
                        <h6 class="description"><?= $commentaire['commentaire'];?></h6>
                    </div>
                    <br><br>
                <a href="delete_commentaire.php?id_commentaire= <?=$commentaire['id_commentaire']; ?>"
                class="reply-button">Supprimer</a>
            </div>               
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
<?php
echo
'</div>';
} else { 
    header('Location: ../views/connexion.php');
    exit();
}  

require_once "../include/footer.php";
?>
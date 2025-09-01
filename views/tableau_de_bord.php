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
                <br>
                <p class="dash">Vous pouvez maintenant accéder à toutes les fonctionnalités réservées à nos utilisateurs inscrits.</p>
                <a class="dashboard" href="deconnexion.php">Se déconnecter</a>
                <a class="dashboard" href="change_profil.php">Changer le profil</a>
                <a href="se_desinscrire.php" class="dashboard">Se désinscrire</a>
                </section>
    
        </div>';
 ?>

<h2 class="dashboard-title">Mes questions</h2>
<br><br>


<div class="container">
<?php

    $new_question = new Question();
    $questions = $new_question->questionByIdUser($id_user);

    if (empty($questions)) {
        echo "<p class='no_question'>Aucune question trouvée.</p>";   
    }else{
        foreach ($questions as $question) {
            echo '<div class="question">';
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
                    echo '<div class="reponse">';
                        echo '<h5><strong>Une reponse de : ' . htmlspecialchars($reponse['prenom']
                         . ' ' . $reponse['nom']) . ' :</strong> ' . nl2br(htmlspecialchars($reponse['reponse'])) . '</h5>';
                        echo '</div><hr>';
                    
                }
                echo'</div>';
          }
        }
        echo '</div>';
    } ?>
</div>
          
<?php
} else { 
    header('Location: ../views/connexion.php');
    exit();
}  

require_once "../include/footer.php";
?>
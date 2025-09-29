<?php
//gerer les erreurs
error_reporting(-1);
ini_set("display_errors", 1);

//requerir aux fichiers nécéssaire
require_once "../models/Users.php";
require_once "../models/Question.php";
require_once "../models/Reponse.php";
require_once "../db/config.php";
require_once "../include/head.php";
require_once "../include/nav_burger.php";
//require_once "../include/navnav.php";
//require_once "../include/navigation.php";
require_once "../include/header.php";
/*
instancier la question (creer l'objet) et appeler la fonction 
getAllQuestion une instance de classe (requete SQL qui ramene 
toutes les question (class Question))
*/
$question = new Question();
$questions = $question->getAllQuestion();

?>
 <h2>Questions récentes</h2>
 <br><hr>
 <?php
 //si pas de question
 if (empty($questions)) {
    echo "<p class='no_question'>Aucune question trouvée.</p>";
?>
<div class="container">
        <?php
         //si il y a des question foreach pour faire la boucle et afficher tous
        } else {
            foreach ($questions as $question) {
                echo '<div class="question"><p>Posté le : '
            . htmlspecialchars($question['date']) .'</p>';
                        
                            echo '<div class="question-theme">' 
                                    . htmlspecialchars($question['theme']) . 
                                  '</div>';
                            echo '<div class="question-text"><H5>'
                                     . nl2br(htmlspecialchars($question['question'])) . 
                                 '</h5></div>';
                       
                            // Afficher les images si elles existent
                            if (!empty($question['image_1']) || !empty($question['image_2']) || 
                                !empty($question['image_3']) || !empty($question['image_4']) || 
                                !empty($question['image_5'])) {
                                echo '<div class="question-images">';
                                for ($i = 1; $i <= 5; $i++) {
                                    $image = $question["image_$i"];
                                    if (!empty($image)) {
                                        echo '<img src="../uploads/img/' . htmlspecialchars($image) . '" alt="Image de la question">';
                                    }
                                }  
                                echo'</div>';              
                    }

                    echo '<div class="question-author">Posée par : ' 
                            . htmlspecialchars($question['prenom'] . ' ' . $question['nom']) . 
                         '</div><br>';
                        // Bouton Répondre (lien vers la page de réponse)
                        echo '<a href="../views/reponse.php?id_question=' 
                        . $question['id_question'] . '" class="reply-button">Répondre</a>';
                    echo '</div>';

                    /*
                    Afficher les réponses existantes
                    instancier une reponse et faire appel a la fonction
                    getReponsesForQuestion (requete SQL qui met en relation 
                    les utilisateur la question et la reponse)
                    */
                    $reponse = new Reponse();
                    $reponses = $reponse->getReponsesForQuestion($question['id_question']);

                    if (!empty($reponses)) {
                        echo '<div class="reponses">';
                        foreach ($reponses as $reponse) {
                            echo '<div class="reponse"><p>Posté le : '
                                . htmlspecialchars($reponse['date']) .'</p>';
                                echo '<h5><strong>une reponse de : <br>' . htmlspecialchars($reponse['prenom'] . ' ' . $reponse['nom']) . ' :</strong> ' . nl2br(htmlspecialchars($reponse['reponse'])) . '</h5>';
                            echo '</div><hr>';
                        }
                        echo '</div>';
                    }

            }
            
            echo '</div>';
         } ?>
    </div>
    
        

 <?php
require_once "../include/footer.php";
?>
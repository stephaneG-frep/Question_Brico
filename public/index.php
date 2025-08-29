<?php
error_reporting(-1);
ini_set("display_errors", 1);


require_once "../models/Users.php";
require_once "../models/Question.php";
require_once "../models/Image.php";
require_once "../models/Reponse.php";
require_once "../db/config.php";
require_once "../include/head.php";
require_once "../include/navigation.php";
require_once "../include/header.php";


$question = new Question();
//$questions = $question->getQuestionAndImageAndUser();
$questions = $question->getAllQuestion();

?>
<div class="container">
        <h2>Questions récentes</h2>
        <br><hr>

        <?php

        if (empty($questions)) {
            echo "<p>Aucune question trouvée.</p>";
        } else {
            foreach ($questions as $question) {
                echo '<div class="question">';
                    echo '<div class="question-theme">' . htmlspecialchars($question['theme']) . '</div>';
                    echo '<div class="question-text"><h3>' . nl2br(htmlspecialchars($question['question'])) . '</h3></div>';

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
                    echo '</div>';
                }

                echo '<div class="question-author">Posée par : ' . htmlspecialchars($question['prenom'] . ' ' . $question['nom']) . '</div><br>';

                // Bouton Répondre (lien vers la page de réponse)
                echo '<a href="../views/reponse.php?id_question=' . $question['id_question'] . '" class="reply-button">Répondre</a>';

                // Afficher les réponses existantes
                $reponse = new Reponse();
                $reponses = $reponse->getReponsesForQuestion($question['id_question']);

                if (!empty($reponses)) {
                    echo '<div class="reponses">';
                    foreach ($reponses as $reponse) {
                        echo '<div class="reponse">';
                        echo '<p><strong>une reponse de : <br>' . htmlspecialchars($reponse['prenom'] . ' ' . $reponse['nom']) . ' :</strong> ' . nl2br(htmlspecialchars($reponse['reponse'])) . '</p>';
                        echo '</div>';
                    }
                    echo '</div>';
                }

            }
            
            echo '</div>';
  } ?>
</div>
}
</div>
 <?php
require_once "../include/footer.php";
?>
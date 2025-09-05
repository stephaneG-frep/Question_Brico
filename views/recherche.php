<?php
error_reporting(-1);
ini_set("display_errors", 1);


require_once "../models/Users.php";
require_once "../models/Image.php";
require_once "../models/Question.php";
//require_once "../db/config.php";
require_once "../include/head.php";
require_once "../include/nav_burger.php";
//require_once "../include/navigation.php";
require_once "../include/header.php";
require_once "../include/token.php";


$new_question = new Question();
$searchTerm = '';
$questions = [];


 
     // Traitement de la recherche
if (isset($_GET['theme'])) {
    $searchTerm = trim($_GET['theme']);
    if (!empty($searchTerm)) {
        $questions = $new_question->getQuestionByTheme($searchTerm);
    }
}
if(isset($_SESSION['id_user'])){
?>


 <div class="content">
        <h1>Rechercher des questions</h1>
        <form method="GET" class="search-form">
            <input 
                type="text" 
                name="theme" 
                placeholder="Entrez un theme.." 
                value="<?= htmlspecialchars($searchTerm) ?>"
            ><br>
            <button type="submit" class="reply-button">Rechercher</button>
        </form>

            <?php if (!empty($searchTerm)): ?>
                <div class="search-info">
                    <?php if (!empty($questions)): ?>
                        <p>Résultats pour le thème : "<?= htmlspecialchars($searchTerm) ?>"</p>
                    <?php else: ?>
                        <p>Aucun résultat trouvé pour le thème : "<?= htmlspecialchars($searchTerm) ?>"</p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
            <?php if (!empty($questions)): ?>
               
                    <?php foreach ($questions as $question): ?>
                        <div class="question">                       
                            <div class="question-theme">
                                    <?= htmlspecialchars($question['theme']); ?>
                            </div>
                            <div class="question-text"><h5>
                                     <?=nl2br(htmlspecialchars($question['question']));?> 
                                    </h5>
                            </div>
                       
                            <?php
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
                                ?>
                            <?php endforeach; ?>
                        </div>
                <?php elseif (empty($searchTerm)): ?>
                <div class="no-results">
                    <p>Entrer un theme pour trouver les questions associéses</p>
                </div>
            <?php endif; ?>
</div>
    <?php


}else{

}?>


<?php require_once "../include/footer.php"; ?>

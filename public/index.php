<?php
error_reporting(-1);
ini_set("display_errors", 1);


require_once "../models/Users.php";
require_once "../models/Question.php";
require_once "../models/Image.php";
require_once "../db/config.php";
require_once "../include/head.php";
require_once "../include/navigation.php";
require_once "../include/header.php";

  
$question = new Question();
$questions = $question->getAllQuestion();

$image = new Image();
$images = $image->getAllImage();


foreach($questions as $question):{ 
        echo '
<div class="dashboard-container">  
    <div class="item-1a">
            <img class="photo_profil" src="../uploads/photo_profil/'.$question['photo_profil'].'" alt="photo de profil">  
    </div>
     <p><span>Une question de '.$question['nom'].' '.$question['prenom'].' '.$question['email'].' </span></p>
       
    <div class="annonce-details">
        <p><span class="theme">Sur le theme de : '.$question['theme'].'</span></p>
       <p class="description">--_--<br> '.$question['question'].'<br> --_--</p>';

        foreach($images as $image): {  
                echo'
        <div class="dashboard-container">
        <p>Quelques photos pour illustrer la question : </p>                
            <img src="../uploads/img/'.$image['image_1'].'"  class="question_photo">
            <img src="../uploads/img/'.$image['image_2'].'"  class="question_photo">
            <img src="../uploads/img/'.$image['image_3'].'"  class="question_photo">
            <img src="../uploads/img/'.$image['image_4'].'"  class="question_photo">
            <img src="../uploads/img/'.$image['image_5'].'"  class="question_photo">
        </div> ';
        
        if(isset($_SESSION['id_user'])){
        
            echo 
            '<div class="">';?>              
               <p><a href="../views/reponse.php?id=<?=$question['id_question']?>">
                Répondre sur le thème : <?php echo $question['theme']; ?></a></p> 
            <?php
            echo '
            </div>';
           }
           echo '

    </div>
</div> ';
           } endforeach; 
    echo'
    </div>';  
} endforeach;
   //$id_quesion = isset($_GET['id_question']) ? (int)$_GET['id_question'] : 0;
   
require_once "../include/footer.php";
?>
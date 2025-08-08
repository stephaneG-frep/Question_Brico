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
        <p>Nom : '.$question['nom'].'</p>
        <hp>Prénom : '.$question['prenom'].'</p>
        <hp>Email : '.$question['email'].'</p> 
    <div class="annonce-details">
        <p><span class="theme">Le theme: '.$question['theme'].'</span></p>
       <p class="description">La question:<br> '.$question['question'].'</p>';

        foreach($images as $image): {  
                echo'
        <div class="dashboard-container">
        <p>Les photos de la question: </p>                
            <img src="../uploads/img/'.$image['image_1'].'"  class="question_photo">
            <img src="../uploads/img/'.$image['image_2'].'"  class="question_photo">
            <img src="../uploads/img/'.$image['image_3'].'"  class="question_photo">
            <img src="../uploads/img/'.$image['image_4'].'"  class="question_photo">
            <img src="../uploads/img/'.$image['image_5'].'"  class="question_photo">
        </div> 

    </div>
</div> ';
           } endforeach; 
echo'
</div>';  
} endforeach;



require_once "../include/footer.php";
?>



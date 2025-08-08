<?php
error_reporting(-1);
ini_set("display_errors", 1);


require_once "../models/Users.php";
require_once "../models/Image.php";
require_once "../models/Question.php";
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

    $new_question = new Question();
    $questions = $new_question->questionByIdUser($id_user);

    $new_image = new Image();
    $images = $new_image->imageByIdUser($id_user);

    $nom = $user['nom'];
    $prenom = $user['prenom'];
    $email = $user['email'];
    $image = $user['photo_profil'];


        echo '

        <br><br>
    <div>
        <div class="dashboard-container">        
            <section class="item-1">
                <div class="item-1a">
                    <img class="photo_profil" src="../uploads/photo_profil/'.$image.'" alt="photo de profil">  
                </div>
                <p>Nom : '.$nom.'</p>
                <hp>Prénom : '.$prenom.'</p>
                <hp>Email : '.$email.'</p> 
                <br>
                <p class="dash">Vous pouvez maintenant accéder à toutes les fonctionnalités réservées à nos utilisateurs inscrits.</p>
                <a class="dashboard" href="deconnexion.php">Se déconnecter</a>
            </section>
    
        </div> <br><br>'; 
       
        foreach($questions as $question):{ 
                echo '
        <div class="dashboard-container">  
            <P>Vos question: </p>
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
        <a href="change_profil.php" class="">Changer le profil</a>
    </div>';  
        } endforeach;

                
} else { 
    header('Location: ../views/connexion.php');
    exit();
}   

    
require_once "../include/footer.php";
?>
<?php
error_reporting(-1);
ini_set("display_errors", 1);


require_once "../models/Users.php";
require_once "../models/Image.php";
require_once "../models/Question.php";
//require_once "../db/config.php";
require_once "../include/head.php";
require_once "../include/navigation.php";
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

if(isset($_POST['envoyer'])){

    $theme = htmlspecialchars($_POST['theme']);
    $question = htmlspecialchars($_POST['question']);
    
    if(empty($_POST['theme'])){
        $message = "Choisir un theme";
    }elseif(empty($_POST['question'])){
        $message = "Ecrir une petite question";
    }else{      
        //$question = new Question();
        //$result = $question->registerQuestion($theme,$question,$id_user,$id_question);

        if(empty($_FILES['image_1']['name']) || empty($_FILES['image_2']['name']) || empty($_FILES['image_3']['name'])
            || empty($_FILES['image_4']['name']) || empty($_FILES['image_5']['name'])){   
            $message = "mettre des photo";
        }else{
            if(preg_match("#gif|jpeg|png|jpg#",$_FILES['image_1']['type'])){
                //inclure le fichier token
                               //donner un nom aléatoire
                $image_1 = $token."_".$_FILES['image_1']['name'];
                //chemin de la photo stocker
                $path = "../uploads/img/";
                move_uploaded_file($_FILES['image_1']['tmp_name'],$path.$image_1);

            }else{
                $message = "Choisir le bon format(gif,png,jpg,jpeg)";
            }

            if(preg_match("#gif|jpeg|png|jpg#",$_FILES['image_2']['type'])){
                //inclure le fichier token
                                //donner un nom aléatoire
                $image_2 = $token."_".$_FILES['image_2']['name'];
                //chemin de la photo stocker
                $path = "../uploads/img/";
                move_uploaded_file($_FILES['image_2']['tmp_name'],$path.$image_2);

            }else{
                $message = "Choisir le bon format(gif,png,jpg,jpeg)";
            }
        
            if(preg_match("#gif|jpeg|png|jpg#",$_FILES['image_3']['type'])){
                //inclure le fichier token
               
                //donner un nom aléatoire
                $image_3 = $token."_".$_FILES['image_3']['name'];
                //chemin de la photo stocker
                $path = "../uploads/img/";
                move_uploaded_file($_FILES['image_3']['tmp_name'],$path.$image_3);

            }else{
                $message = "Choisir le bon format(gif,png,jpg,jpeg)";
            }
        
            if(preg_match("#gif|jpeg|png|jpg#",$_FILES['image_4']['type'])){
                //inclure le fichier token
                
                //donner un nom aléatoire
                $image_4 = $token."_".$_FILES['image_4']['name'];
                //chemin de la photo stocker
                $path = "../uploads/img/";
                move_uploaded_file($_FILES['image_4']['tmp_name'],$path.$image_4);

            }else{
                $message = "Choisir le bon format(gif,png,jpg,jpeg)";
            }
        

            if(preg_match("#gif|jpeg|png|jpg#",$_FILES['image_5']['type'])){
                    //inclure le fichier token
                    
                    //donner un nom aléatoire
                    $image_5 = $token."_".$_FILES['image_5']['name'];
                    //chemin de la photo stocker
                    $path = "../uploads/img/";
                    move_uploaded_file($_FILES['image_5']['tmp_name'],$path.$image_5);

                }else{
                    $message = "Choisir le bon format(gif,png,jpg,jpeg)";
                }
            
            $newQuestion = new Question();
            $resultat = $newQuestion->registerQuestion($theme,$question,$create_date,$id_user);  
            $images = new Image();
            $result = $images->registerImage($image_1,$image_2,$image_3,$image_4,$image_5,
                                                $id_user);                            
            if($resultat){
                header("location:../public/index.php");
                exit();
            }else{
                $message = "Erreur lors du dépot de l'annonce";
            }
        }

    }


}

?>

<h1>Bienvenue, <?php echo $user['prenom']." ". $user['nom']; ?>!</h1>    
<p>Email: <?php echo $user['email']; ?></p>

<div class="inscrip">
<?php if(isset($message)) echo "<div class='erreurs'>".$message."</div>"; ?>

    <h2 class="h2">Votre question</h2>

    <form method="POST" action="" enctype="multipart/form-data">
       <br>
        Quelle est le theme de bricolage : <br>
    <select name="theme" id="pet-select">
        <option  value="">--Quel est le theme de la quetion--</option>
        <option name="theme" value="Electricite">01 :Electricite</option>
        <option name="theme" value="Menuiserie">02 :Menuiserie</option>
        <option name="theme" value="Maçonnerie">03 :Maçonnerie</option>
        <option name="theme" value="Peinture">04 :Peinture</option>
        <option name="theme" value="Sols">05 :Sols</option>
        <option name="theme" value="Electronique">06 :Electronique</option>
        <option name="theme" value="Mecanique">07:Mecanique</option>
    </select>
        <br><br>
        Votre question : <br>
        <textarea type="text" name="question" id="question" placeholder="ma question"></textarea>
        <br><br>
        Photo 1 :
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
        <input type="file" name="image_1" id="image_1">
        <br>
        Photo 2 :
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
        <input type="file" name="image_2" id="image_2">
        <br> 
        Photo 3 :
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
        <input type="file" name="image_3" id="image_3">
        <br> 
        Photo 4 :
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
        <input type="file" name="image_4" id="image_4">
        <br> 
        Photo 5 :
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
        <input type="file" name="image_5" id="image_5">
        <br> 
        Poser la question : 
        <input type="submit" name="envoyer"
                value="Envoyer la question" >
        <br>

    </form>
</div>
<div class="connect">
     <a href="../views/connexion.php">Déja un compte?Connectez-vous</a>       
</div>

<?php
require_once "../include/footer.php";

?>
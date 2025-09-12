<?php         
error_reporting(-1);
ini_set("display_errors", 1);


require_once "../models/Users.php";
require_once "../models/Image.php";
require_once "../models/Question.php";
require_once "../models/Astuce.php";
//require_once "../db/config.php";
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
if(isset($_POST['envoyer'])){

    $astuce = htmlspecialchars($_POST['astuce']);
    $date = htmlspecialchars($_POST['date']);
    
    if(empty($_POST['astuce'])){
        $message = "Ecrire une astuce";
    if(empty($_POST['date'])){
        $message = "N'oublier pas la date";
    }
    }else{      
        //$question = new Question();
        //$result = $question->registerQuestion($theme,$question,$id_user,$id_question);

        if(empty($_FILES['image_1']['name']) || empty($_FILES['image_2']['name']) 
          || empty($_FILES['image_3']['name'])){   
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
            $new_astuce = new Astuce();
            $astuce = $new_astuce->registerAstuce($astuce,$date, $image_1,$image_2,
                               $image_3,$id_user);
                                                   
                if($astuce){
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

    <h2 class="h2">Votre astuce</h2>

    <form method="POST" action="" enctype="multipart/form-data">
       <br>
        <br><br>
       <p> Votre astuce : </p><br>
        <textarea type="text" name="astuce" id="astuce" placeholder="ma petite astuce"></textarea>
        <br><br>
       <p> La date : </p><br>
        <input type="text" name="date" id="date" placeholder="entrer a date du jour">
        <br><br>
       <p> Photo 1 : 
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
        <input type="file" name="image_1" id="image_1">
      </p>
        <br>
        <p>Photo 2 : 
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
        <input type="file" name="image_2" id="image_2">
        </p>
        <br> 
       <p> Photo 3 : 
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
        <input type="file" name="image_3" id="image_3">
       </p>
        <br> 
        <p>Envoyer votre astuce : </p>
        <input type="submit" name="envoyer"
                value="Envoyer l'astuce" >
        <br>

    </form>
</div>
<div class="connect">
     <a href="../views/connexion.php">Déja un compte?Connectez-vous</a>       
</div>

<?php
require_once "../include/footer.php";

?>
        
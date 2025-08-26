<?php
error_reporting(-1);
ini_set("display_errors", 1);

require_once "../models/Users.php";
require_once "../db/config.php";
require_once "../include/head.php";
require_once "../include/navigation.php";
require_once "../include/header.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if(empty($_POST['nom']) || !ctype_alpha($_POST['nom'])){
        $message = "Saisir un identifient valide";
    }elseif(empty($_POST['prenom']) || !ctype_alpha($_POST['prenom'])){
        $message = "Saisir un identifient valide";
    }elseif(empty($_POST['email']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
        $message = "Saisir une adresse mail valide";
    }elseif(empty($_POST['password'])){
        $message = " Saisir un mot de passe valide";
    
    }else{
        //valeurs du formulaire a mettre dans la méthode register
        //faire toutes les vérifications dez sécuritée   
        //conndition d'appel a la fonction(check) nettoyage securitaire      
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
          
        
        //condition si photo de profil ou non
        if(empty($_FILES['photo_profil']['name'])){
            $photo_profil = "avatar_default.jpg";
        }else{
            if(preg_match("#gif|jpeg|png|jpg#",$_FILES['photo_profil']['type'])){
                //inclure le fichier token
                require_once "../include/token.php";
                //donner un nom aléatoire
                $photo_profil = $token."_".$_FILES['photo_profil']['name'];
                //chemin de la photo stocker
                $path = "../uploads/photo_profil/";
                move_uploaded_file($_FILES['photo_profil']['tmp_name'],$path.$photo_profil);

            }else{
                $message = "Choisir le bon format(gif,png,jpg,jpeg)";
            }
        }
        //inicialiser un nouvel user
        $user = new Users();
        //vérifier les doublon d'adressemail avec la methode getUserByEmail de la class users
        $existingUser = $user->getUserByEmail($email);
        //si resultat positif message erreur
        if($existingUser){ 
            $message = "L'adresse Email existe déjas";
            //sinon réussite de l'inscription
        }else{
    
            //appel a la méthode register class users
            $result = $user->register($nom,$prenom,$email
                                        ,$password,$photo_profil);
                                    
            if($result){
                
                header('Location: ../public/index.php');
                //exit();
            }else{
                $message = "Erreur lors de l'inscription";
            }
        }

    }

    }

?>

<div class="inscrip">
<?php if(isset($message)) echo "<div class='erreurs'>".$message."</div>"; ?>

    <h2 class="h2">Inscription</h2>

    <form method="POST" action="" enctype="multipart/form-data">
        <p>Votre Nom : </p>
        <input type="text" name="nom" id="nom" placeholder="votre nom">
        <br>
        <p>Votre Prénom : </p>
        <input type="text" name="prenom" id="prenom" placeholder="votre prénom">
        <br>
        <p>Votre E-mail : </p>
        <input type="email" name="email" id="email" placeholder="email: exemple@exemple.com">
        <br>
        <p>Votre mot de passe : </p>
        <input type="password" name="password" id="password" placeholder="mot de passe">
        <br>
        
        <p>Photo de profil : </p>
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
        <input type="file" name="photo_profil" id="photo_profil">
        <br>      
        <p>Inscription : </p>
        <input type="submit" name="inscription"
                value="Créer un compte" >
        <br>

    </form>
</div>
<div class="connect">
     <a href="../views/connexion.php">Déja un compte?Connectez-vous</a>       
</div>

<?php
require_once "../include/footer.php";

?>
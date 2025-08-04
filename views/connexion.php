<?php
error_reporting(-1);
ini_set("display_errors", 1);

require_once "../models/Users.php";
require_once "../db/config.php";
require_once "../include/head.php";
require_once "../include/navigation.php";
require_once "../include/header.php";


if(isset($_POST['connexion']) ){
    //récuperer les données du formulaire dans des variables
    $email = $_POST['email'];
    $password = $_POST['password'];
    //instancier la class user
    $newUser = new Users();
    //appel a la méthode login(class Users)
    $user = $newUser->login($email,$password);

    if($user){
        $_SESSION['id_user'] = $user;
        session_start();
        //$_SESSION['email'] = $userId['email'];   
        header('location: ../public/index.php');
        exit();

    }else{
        $message = "Email ou mot-de-passe invalide";
    }
}

?>

<div class="inscrip">
    <h2 class="h2">Connexion</h2>
    
    <?php if(isset($message)) echo "<div class='erreurs'>".$message."</div>"; ?>

        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            Email :
            <input type="email" name="email" required >
            <br>
            Mot de passe :
            <input type="password" name="password" required>
            <br>
            Connexion :
            <input type="submit" name="connexion" value="connexion">
        </form>
</div>

<?php
require_once "../include/footer.php";

?>
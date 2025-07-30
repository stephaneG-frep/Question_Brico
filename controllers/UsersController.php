<?php
 
require_once "./Autoload.php";

class UsersController{

    private $userModel;

    public function __construct(){
        $this->userModel = new Users();
        // Démarrer la session si pas déjà démarrée
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index(){
        //$this->getAllUsers();
        include('views/user/index.php');
    }

    //methode qui renvoie la page inscription (views/user/inscription.php)
    public function inscription(){
        include('views/user/inscription.php');
    }

    //methode qpour enregister les utilisateurs
    public function registerUser(){
        $message = [];
        //recupérer les données du formulaire
        //faire des vérifications
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            if(empty($_POST['nom']) || !ctype_alpha($_POST['nom'])){
                $message = "Saisir un identifient valide";
            }
            if(empty($_POST['prenom']) || !ctype_alpha($_POST['prenom'])){
                $message = "Saisir un identifient valide";
            }
            if(empty($_POST['email']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
                $message = "Saisir une adresse mail valide";
            }
            if(empty($_POST['password'])){
                $message = " Saisir un mot de passe valide"; 
            }          
            if(empty($message)){
                
                    $nom = htmlspecialchars($_POST['nom']);
                    $prenom = htmlspecialchars($_POST['prenom']);
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                
                          
                //condition si photo de profil ou non
                if(empty($_FILES['photo_profil']['name'])){
                    $photo_profil = "avatar_default.jpg";
                }else{
                    if(preg_match("#gif|jpeg|png|jpg#",$_FILES['photo_profil']['type'])){
                        //inclure le fichier token
                        require_once "./views/include/token.php";
                        //donner un nom aléatoire
                        $photo_profil = $token."_".$_FILES['photo_profil']['name'];
                        //chemin de la photo stocker
                        $path = "uploads/img/photo_profil/";
                        move_uploaded_file($_FILES['photo_profil']['tmp_name'],$path.$photo_profil);

                    }else{
                        $message = "Choisir le bon format(gif,png,jpg,jpeg)";
                    }
                }
                //vérifier les doublon d'adressemail avec la methode getUserByEmail de la class users
                    $existingUser = $user->getUserByEmail($email);
                    //si resultat positif message erreur
                    if($existingUser){ 
                        $message = "L'adresse Email existe déjas";
                        //sinon réussite de l'inscription
                    }else{
            
                    //appel a la méthode register class users
                    //$ModelUser = new Users();
                    $result = $this->userModel->register($nom,$prenom,$email
                                                ,$password,$photo_profil);
                      
                    if ($result){
                        $_SESSION['success'] = "Inscription réussie! Vous pouvez maintenant vous connecter.";
                        header('Location: /login');
                         exit;
                    } else {
                        $errors[] = "Une erreur est survenue lors de l'inscription";
                    }
                }
            }else{
         require_once "./views/user/inscription.php";
            }
        }
    }



    //methode qui renvoie la page connexion (views/user/connexion.php)
    public function connexion(){
        include('views/user/connexion.php');
    }

    public function logUser(){
        if(isset($_POST['connexion']) ){
            //récuperer les données du formulaire dans des variables
            $email = $_POST['email'];
            $password = $_POST['password'];
            //instancier la class user
            $user = new Users();
            //appel a la méthode login(class Users)
            $userId = $user->login($email,$password);           
            if($userId){
                $_SESSION['id'] = $userId;
                //$_SESSION['email'] = $userId['email'];                       
                header('location: /Question_Brico');
                exit();           
            }else{
                $message = "Email ou mot-de-passe invalide";
            }
        }
    }




}

?>
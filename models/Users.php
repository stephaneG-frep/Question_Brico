<?php
//inclure la class de connexion a la bdd
require_once "../db/Database.php";

class Users{

    private $db;
    //constructeur pour inicier la connexion 
    public function __construct(){
        //appel a la méthode getInstance
        $this->db = Database::getInstance();
    }
    
    // methode pour enregister en base
    public function register($nom,$prenom,$email,$password,$photo_profil){
        //securiser le password avec password_hash
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Requête préparée pour éviter les injections SQL
        $query = "INSERT INTO users(nom,prenom,email,password,photo_profil,role) 
                  VALUES(:nom,:prenom,:email,:password,:photo_profil,:role)";
        //connexion a la base
        $dbConnexion = $this->db->getConnexion();
        //requette prépaeée
        $req = $dbConnexion->prepare($query);
        //lier les paramettres entre eux(paramettre nommé avec les valeurs récupérées)
        $role = 'user';
        $req->bindParam(':nom',$nom);
        $req->bindParam(':prenom',$prenom);
        $req->bindParam(':email', $email);
        $req->bindParam(':password', $hashedPassword);
        $req->bindParam(':photo_profil',$photo_profil);
        $req->bindParam(':role',$role);
        //executer la requette
        $req->execute();
        //retourne et vérifie le nombre de ligne inséréees
        return $req->rowCount() > 0;
               
    }

     //methode de vérification d'existance d'email 
     public function getUserByEmail($email) {
        $query = 'SELECT id_user FROM users WHERE email = :email';
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->bindParam(':email', $email);
        $req->execute();
        
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    //méthode de récupération des emails pour changer le profil
    public function getUserByEmailId($id_user,$email){
        //requete 
        $query = "SELECT * FROM users WHERE email = :email AND id_user != :id_user";
        //connexion 
        $dbConnexion = $this->db->getConnexion();
        //preparer la requete
        $req = $dbConnexion->prepare($query);
        //lier les parametter
        $req->bindParam('email',$email);
        $req->bindParam('id_user',$id_user);
        //executer la requete
        $req->execute();
        //retourner un tableau associatif
        return $req->fetch(PDO::FETCH_ASSOC);
        
    }

     //méthode de récupération l'user par le role
     public function getByRole($new_role){
      
        $query = "SELECT * FROM users WHERE role = :role";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->bindParam(':role',$new_role);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function updateRole($id_user,$new_role){
        $query = "UPDATE users SET role = :role WHERE id_user = :id_user";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->bindParam(':id_user',$id_user);
        $req->bindParam(':role',$new_role);
        $req->execute();
        return $req->fetchAll();
    }

    //méthode de récupération de l'utilisateur par son id
    public function getUserById($id_user){
        $query = "SELECT * FROM users WHERE id_user = :id_user";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->bindParam(':id_user',$id_user);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }


    public function login($email, $password){
        $query = "SELECT id_user, password FROM users WHERE email = :email";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->bindParam(':email',$email);
        $req->execute();
        //recuperer le resultat dans un tableau assoc
        $user = $req->fetch(PDO::FETCH_ASSOC);
        //vérifier le password 
        if($user && password_verify($password,$user['password'])){
            return $user['id_user'];
        }
        return false;
    }

    public function getAllUser(){
        //récuperer les toutes annonces     
       // Requête pour récupérer toutes les annonces avec les infos des utilisateur
        $query = "SELECT u.nom, u.prenom, u.email, u.photo_profil as id_user,
                         q.id_question, q.theme, q.question FROM users u
                         JOIN question q ON u.id_user = q.id_user ORDER BY u.id_user DESC";
       // Obtention de la connexion à la base de données
           $dbConnexion = $this->db->getConnexion();    
       // Préparation de la requête SQL
           $req = $dbConnexion->prepare($query);   
       // Exécution de la requête SQL
           $req->execute();    
       // Initialisation d'un tableau pour stocker les résultats de la requête
           $resultats = array();    
       // Parcours des résultats de la requête et stockage dans le tableau $resultats
           while($ligne = $req->fetch(PDO::FETCH_ASSOC)){
               $resultats[] = $ligne;
           }    
       // Retour du tableau contenant tous les résultats
           return $resultats;
       }
   

    public function updateUser($id_user, $nom, $prenom, $email, $photo_profil){
        $query = "UPDATE users SET nom=:nom, prenom=:prenom, email=:email, photo_profil=:photo_profil,
                                  role=:role WHERE id_user=:id_user";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $role = 'user';
        $req->bindParam(':nom',$nom);
        $req->bindParam(':prenom',$prenom);
        $req->bindParam(':email', $email);
        $req->bindParam(':photo_profil',$photo_profil);
        $req->bindParam(':role',$role);
        $req->bindParam(':id_user',$id_user);
        $req->execute();
        return $req->rowCount() > 0;
    }

    public function seDesinscrire(){

            $query = ("DELETE FROM reponse WHERE id_user = :id_user");
                $dbConnexion = $this->db->getConnexion();
                $req_reponses = $dbConnexion->prepare($query);
                $req_reponses->bindParam(':id_user', $_SESSION['id_user'], PDO::PARAM_INT);
                $req_reponses->execute();
        
                // Supprimer la question
                $query = ("DELETE FROM question WHERE id_user = :id_user");
                $dbConnexion = $this->db->getConnexion();
                $req_questions = $dbConnexion->prepare($query);   
                $req_questions->bindParam(':id_user', $_SESSION['id_user'], PDO::PARAM_INT);
                $req_questions->execute();

                $query = ("DELETE FROM astuce WHERE id_user = :id_user");
                $dbConnexion = $this->db->getConnexion();
                $req_astuces = $dbConnexion->prepare($query);   
                $req_astuces->bindParam(':id_user', $_SESSION['id_user'], PDO::PARAM_INT);
                $req_astuces->execute();

                $query = ("DELETE FROM commentaire WHERE id_user = :id_user");
                $dbConnexion = $this->db->getConnexion();
                $req_commentaires = $dbConnexion->prepare($query);   
                $req_commentaires->bindParam(':id_user', $_SESSION['id_user'], PDO::PARAM_INT);
                $req_commentaires->execute();

                $query = ("DELETE FROM users WHERE id_user = :id_user");
                $dbConnexion = $this->db->getConnexion();
                $req_users = $dbConnexion->prepare($query);
                $req_users->bindParam(':id_user', $_SESSION['id_user'], PDO::PARAM_INT);
                $req_users->execute();
        
                session_destroy();

                return $req_users->fetchAll();
    }

        function getUser($limit=null,$page=null)
        {
        $query = 'SELECT * FROM users ORDER BY id_user DESC';
            //connexiona la BDD
            $dbConnexion = $this->db->getConnexion();
    
        if ($limit && !$page) {
            $query .= ' LIMIT :limit';
        }
        if ($page) {
            $query .= " LIMIT :offset, :limit";
        }
    
        $req = $dbConnexion->prepare($query);
    
        if ($limit) {
            $req->bindParam(':limit', $limit, PDO::PARAM_INT);
        }
        if ($page) {
            $offset = ($page - 1) * $limit;
            $req->bindValue(":offset", $offset, PDO::PARAM_INT);
        }
        
        $req->execute();
        $users = $req->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }
    
    //compter les utilisateurs pour l'admin
    public function getTotalUsers(){
        $query = "SELECT COUNT(*) as total FROM users";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->execute();
        $result = $req->fetch(PDO::FETCH_ASSOC);

        return $result['total'];
    }

    public function AllUsers(){
        // Définition de la requête SQL pour récupérer les utilisateurs
            $query = "SELECT * FROM users ORDER BY id_user DESC";   
        // Obtention de la connexion à la base de données
            $dbConnexion = $this->db->getConnexion();    
        // Préparation de la requête SQL
            $req = $dbConnexion->prepare($query);    
        // Exécution de la requête SQL
            $req->execute();    
        // Initialisation d'un tableau pour stocker les résultats de la requête
            $resultats = array();   
        // Parcours des résultats de la requête et stockage dans le tableau $resultats
            while($ligne = $req->fetch(PDO::FETCH_ASSOC)){
                $resultats[] = $ligne;
            }    
        // Retour du tableau contenant tous les résultats
            return $resultats;
        }

        public function deleteUser($id_user){
            //requete sql
            $query = "DELETE FROM users WHERE id_user = :id_user";
            //connexion 
            $dbConnexion = $this->db->getConnexion();
            //preparation
            $req = $dbConnexion->prepare($query);
            //lier les parametters
            $req->bindParam(':id_user',$id_user);
            //executer
            $req->execute();
            //retourner le nombres de lignes
            return $req->rowCount() > 0;
        }
   

    







}




?>
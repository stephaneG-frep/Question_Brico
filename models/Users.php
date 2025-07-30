<?php

require_once "../core/Database.php";


class Users{

    private $db;
    public function __construct(){
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
        $query = 'SELECT id FROM users WHERE email = :email';
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->bindParam(':email', $email);
        $req->execute();
        
        return $req->fetch(PDO::FETCH_ASSOC);
    }

      /**
     * Vérifie les credentials de connexion
     * @param string $email - Email de l'utilisateur
     * @param string $password - Mot de passe en clair
     * @return array|false - Données de l'utilisateur ou false si échec
     */
    public function checkCredentials($email, $password) {
        $user = $this->getUserByEmail($email);
        
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        
        return false;
    }


    public function login($email, $password){
        $query = "SELECT id, password FROM users WHERE email = :email";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->bindParam(':email',$email);
        $req->execute();
        //recuperer le resultat dans un tableau assoc
        $user = $req->fetch(PDO::FETCH_ASSOC);
        //vérifier le password 
        if($user && password_verify($password,$user['password'])){
            return $user['id'];
        }
        return false;
    }
    





}




?>
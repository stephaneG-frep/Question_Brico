<?php

require_once "../db/Database.php";
require_once "../models/Image.php";

class Question{

    private $db;
    //constructeur pour inicier la connexion 
    public function __construct(){
        //appel a la méthode getInstance
        $this->db = Database::getInstance();
    }


    public function registerQuestion($theme,$question,$image_1,$image_2,$image_3,
                $image_4,$image_5,$id_user){

        $query = "INSERT INTO question(theme,question,create_date,image_1,image_2,image_3,
                            image_4,image_5,id_user)
                   VALUES(:theme,:question,NOW(),:image_1,:image_2,:image_3,:image_4,:image_5,:id_user)";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->bindParam(':theme',$theme);
        $req->bindParam(':question',$question);
        $req->bindParam(':image_1',$image_1);
        $req->bindParam(':image_2',$image_2);
        $req->bindParam(':image_3',$image_3);
        $req->bindParam(':image_4',$image_4);
        $req->bindParam(':image_5',$image_5);
        $req->bindParam(':id_user',$id_user);
        //$req->bindParam(':id_question',$id_question);
        $req->execute();
        return $req->rowCount() > 0;

    }
    //question spécifique a un utilisateur
    public function questionByIdUser($id_user){
        $query = "SELECT 
            q.id_question,q.theme,q.question,
            q.create_date,q.image_1,q.image_2,
            q.image_3,q.image_4,q.image_5,
            u.id_user,u.nom,u.prenom,u.photo_profil,u.email
            FROM question q
            JOIN users u ON q.id_user = u.id_user
            WHERE u.id_user = :id_user
            ORDER BY q.id_question DESC;";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->bindParam(':id_user',$id_user, PDO::PARAM_INT);
        $req->execute();
        
        return $req->fetchAll(PDO::FETCH_ASSOC);   
    }

    //vérifier l'id de l'utilisateur et de la question 
    public function idUserAndIdQuestion($id_question){
        $query = "SELECT id_user FROM question WHERE id_question = :id_question";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $question = "";
        $req->bindParam(':id_question', $id_question, PDO::PARAM_INT);
        $req->execute();
        $question = $req->fetch();
        return $question;
    }

    public function questionById($id_question){
        // Définition de la requête SQL pour récupérer une annonce par son identifiant
        $query = "SELECT * FROM question WHERE id_question = :id_question";   
        // Obtention de la connexion à la base de données
        $dbConnexion = $this->db->getConnexion();   
        // Préparation de la requête SQL
        $req = $dbConnexion->prepare($query);   
        // Liaison du paramètre :id_annonce dans la requête SQL avec la valeur fournie en argument
        $req->bindParam(':id_question', $id_question);   
        // Exécution de la requête SQL
        $req->execute();   
        // Récupération du résultat sous forme de tableau associatif
        $req->fetch(PDO::FETCH_ASSOC);   
        // Retour du tableau associatif contenant les informations de la production
        return $id_question;
    }

    public function getAllQuestion(){
     //récuperer les toutes annonces     
    // Requête pour récupérer toutes les annonces avec les infos des utilisateurs
    $query = "SELECT 
                q.id_question,q.theme,q.question,
                q.create_date,q.image_1,q.image_2,
                q.image_3,q.image_4,q.image_5,
                u.id_user,u.nom,
                u.prenom,u.photo_profil,u.email
            FROM question q
            JOIN users u ON q.id_user = u.id_user
            ORDER BY q.id_question DESC;";

    // Obtention de la connexion à la base de données
        $dbConnexion = $this->db->getConnexion();    
    // Préparation de la requête SQL
        $req = $dbConnexion->prepare($query);   
    // Exécution de la requête SQL
        $req->execute();       
        return $req->fetchAll();
    }

    public function getQuestionAndUser(){
        $query = " SELECT question.*, users.nom, users.prenom,
            FROM question
            JOIN users ON question.id_user = users.id_user
            ORDER BY question.id_question DESC";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->execute();
        return $req->fetchAll();
    }

    

    // Supprime une question et ses réponses associées
    function deleteQuestion($id_question) {
    
            // Supprimer les réponses associées
            $query = ("DELETE FROM reponse WHERE id_question = :id_question");
            $dbConnexion = $this->db->getConnexion();
            $req_reponses = $dbConnexion->prepare($query);
            $req_reponses->bindParam(':id_question', $id_question, PDO::PARAM_INT);
            $req_reponses->execute();
    
            // Supprimer la question
            $query = ("DELETE FROM question WHERE id_question = :id_question");
            $dbConnexion = $this->db->getConnexion();
            $req_questions = $dbConnexion->prepare($query);   
            $req_questions->bindParam(':id_question', $id_question, PDO::PARAM_INT);
            $req_questions->execute();
    
    
            return $req_questions->fetchAll();
       
    }
    
    

}
?>
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


    public function registerQuestion($theme,$question,$id_user){

        $query = "INSERT INTO question(theme,question,create_date,id_user)
                   VALUES(:theme,:question,NOW(),:id_user)";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->bindParam(':theme',$theme);
        $req->bindParam(':question',$question);
        $req->bindParam(':id_user',$id_user);
        //$req->bindParam(':id_question',$id_question);
        $req->execute();
        return $req->rowCount() > 0;

    }

    public function questionByIdUser($id_user){
        $query = "SELECT * FROM question WHERE id_user = :id_user";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->bindParam(':id_user',$id_user);
        $req->execute();
        $resultats = array();    
        // Parcours des résultats de la requête et stockage dans le tableau $resultats
            while($ligne = $req->fetch(PDO::FETCH_ASSOC)){
                $resultats[] = $ligne;
            } 
        return $resultats;   
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
    $query = "SELECT q.id_question, q.theme, q.question, q.id_user as id_user, 
                    u.nom,u.prenom,u.email,u.photo_profil FROM question q
                 JOIN users u ON q.id_user = u.id_user ORDER BY q.id_question DESC";

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

    public function getQuestionAndImage(){
        $query = " SELECT question.*, users.nom, users.prenom, image.*
            FROM question
            JOIN users ON question.id_user = users.id_user
            LEFT JOIN image ON users.id_user = image.id_user
            ORDER BY question.id_question DESC";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->execute();
        return $req->fetchAll();
    }

    public function getQuestion(){
        $query = "SELECT q.*,u.nom,u.prenom,u.email, as id_user,
                  FROM question q
                  JOIN users u ON q.id_user = u.id_user
                  WHERE q.id_question IS NULL
        ORDER BY q.create_date DESC";
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


    public function deleteQuestion($pdo,$id_question){
        $query = "DELETE FROM question WHERE id_question =:id_question";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->bindParam(':id_question', $id_question);
        $req->execute();
 
        return $req->rowCount() >0;
    }

// ...
// Supprime une question et ses réponses associées
    function deleteQuestions($pdo, $id_question) {
        $dbConnexion = $this->db->getConnexion();
       
    try {
        $pdo->beginTransaction();

        // Supprimer les réponses associées
        $stmt_reponses = $pdo->prepare("DELETE FROM reponse WHERE id_question = :id_question");
        $stmt_reponses->bindParam(':id_question', $id_question, PDO::PARAM_INT);
        $stmt_reponses->execute();

        // Supprimer les images associées (si la table image est liée)
        $stmt_images = $pdo->prepare("DELETE FROM image WHERE id_image = :id_question");
        $stmt_images->bindParam(':id_question', $id_question, PDO::PARAM_INT);
        $stmt_images->execute();

        // Supprimer la question
        $stmt_question = $pdo->prepare("DELETE FROM questions WHERE id_question = :id_question");
        $stmt_question->bindParam(':id_question', $id_question, PDO::PARAM_INT);
        $stmt_question->execute();

        $pdo->commit();
        return true;
    } catch (Exception $e) {
        $pdo->rollBack();
        return false;
    }
}

        
    

}
?>
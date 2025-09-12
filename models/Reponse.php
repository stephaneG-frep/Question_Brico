<?php

require_once "../db/Database.php";

class Reponse{

    private $db;
    //constructeur pour inicier la connexion 
    public function __construct(){
        //appel a la méthode getInstance
        $this->db = Database::getInstance();
    }

    public function registerReponse($date,$reponse,$id_user,$id_question){
        $query = "INSERT INTO reponse(date,reponse,id_user,id_question)
                 VALUES(:date,:reponse, :id_user, :id_question)";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query); 
        $req->bindParam(':date',$date);
        $req->bindParam(':reponse', $reponse, PDO::PARAM_STR);
        $req->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $req->bindParam(':id_question', $id_question, PDO::PARAM_INT);      
        return $req->execute(); 
          
    }

    public function AllReponses(){
        $query = "SELECT r.id_reponse,r.date, r.reponse, 
            r.id_user as id_user, u.nom,u.prenom,u.email,u.photo_profil 
            FROM reponse r
            JOIN users u ON r.id_user = u.id_user 
            ORDER BY r.id_reponse DESC ";
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

    public function reponseById($id_reponse){
        // Définition de la requête SQL pour récupérer une reponse par son identifiant
        $query = "SELECT * FROM reponse WHERE id_reponse = :id_reponse";   
        // Obtention de la connexion à la base de données
        $dbConnexion = $this->db->getConnexion();   
        // Préparation de la requête SQL
        $req = $dbConnexion->prepare($query);   
        // Liaison du paramètre :id_annonce dans la requête SQL avec la valeur fournie en argument
        $req->bindParam(':id_reponse', $id_reponse);   
        // Exécution de la requête SQL
        $req->execute();   
        // Récupération du résultat sous forme de tableau associatif
        $req->fetch(PDO::FETCH_ASSOC);   
        // Retour du tableau associatif contenant les informations de la production
        return $id_reponse;
    }

    public function reponseByIdQuestion($id_user, $id_question){

        $query = "SELECT * FROM reponse WHERE id_user = :id_user, id_question = :id_question";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->bindParam(':id_user',$id_user);
        $req->bindParam(':id_question',$id_question);
        $req->execute();
        $resultats = array();    
        // Parcours des résultats de la requête et stockage dans le tableau $resultats
            while($ligne = $req->fetch(PDO::FETCH_ASSOC)){
                $resultats[] = $ligne;
            } 
        return $resultats;   
    }

    public function reponseByIdUser($id_user){
        $query = "SELECT 
        p.id_reponse,p.date,p.reponse,
        u.id_user,u.nom,u.prenom,u.photo_profil,u.email
        FROM reponse p
        JOIN users u ON p.id_user = u.id_user
        WHERE u.id_user = :id_user
        ORDER BY p.id_reponse DESC;";
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

    public function getReponsesForQuestion($id_question) {
       
        $query = "SELECT reponse.*, users.nom, users.prenom
                  FROM reponse
                    JOIN users ON reponse.id_user = users.id_user
                    WHERE id_question = :id_question";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->bindParam(':id_question',$id_question);
        $req->execute();
        return $req->fetchAll();
    
    }

     //vérifier l'id de l'utilisateur et de la reponse 
     public function idUserAndIdReponse($id_reponse){
        $query = "SELECT id_user FROM reponse WHERE id_reponse = :id_reponse";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $question = "";
        $req->bindParam(':id_reponse', $id_reponse, PDO::PARAM_INT);
        $req->execute();
        $question = $req->fetch();
        return $question;
    }

     //supprimer le commentaire
     public function deleteReponse($id_reponse){
        $query = "DELETE FROM reponse WHERE id_reponse =:id_reponse";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->bindParam(':id_reponse', $id_reponse);
        $req->execute();

        return $req->rowCount() >0;
    }

    function getTotalReponses(){
        $query = "SELECT COUNT(*) as total FROM reponse";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->execute();
        $result = $req->fetch(PDO::FETCH_ASSOC);

        return $result['total'];
    }


}
?>
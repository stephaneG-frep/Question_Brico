<?php

require_once "../db/Database.php";

class Reponse{

    private $db;
    //constructeur pour inicier la connexion 
    public function __construct(){
        //appel a la méthode getInstance
        $this->db = Database::getInstance();
    }

    public function registerReponse($reponse,$create_date,$id_user,$id_question){

        $query = "INSERT INTO reponse(reponse,create_date,id_user,id_question)
                 VALUES(:reponse,NOW(),:id_user,:id_question)";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);       
        $req->bindParam(':reponse',$reponse);
        $req->bind_result(':create_date',$create_date);
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
        $query = "SELECT * FROM reponse WHERE id_user = :id_user";
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

    public function getResponsesForQuestion($id_question) {
       
        $query = "SELECT r.*, u.username FROM reponse r
                  JOIN user u ON r.id_user = u.id_user
                 WHERE r.id_question = :id_question ORDER BY ASC";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->bindParam(':id_question',$id_question);
        $req->execute([':questionId' => (int)$id_question]);
        return $req->fetchAll();
    
    }
    





}
?>
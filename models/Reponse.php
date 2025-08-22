<?php

require_once "../db/Database.php";

class Reponse{

    private $db;
    //constructeur pour inicier la connexion 
    public function __construct(){
        //appel a la méthode getInstance
        $this->db = Database::getInstance();
    }

    public function registerReponse($reponse,$id_user,$id_question){
        $query = "INSERT INTO reponse(reponse,id_user,id_question)
                 VALUES(:reponse, :id_user, :id_question)";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query); 
        $req->bindParam(':reponse', $reponse, PDO::PARAM_STR);
        $req->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $req->bindParam(':id_question', $id_question, PDO::PARAM_INT);      
        return $req->execute(); 
          
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


}
?>
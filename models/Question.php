<?php

require_once "../db/Database.php";

class Question{

    private $db;
    //constructeur pour inicier la connexion 
    public function __construct(){
        //appel a la méthode getInstance
        $this->db = Database::getInstance();
    }


    public function registerQuestion($theme,$question,$id_user,$id_question){

        $query = "INSERT INTO question(theme,question,id_user,id_question)
                   VALUES(:theme,:question,:id_user,:id_question)";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->bindParam(':theme',$theme);
        $req->bindParam(':question', $question);
        $req->bindParam(':id_user',$id_user);
        $req->bindParam(':id_question',$id_question);
        $req->execute();
        return $req->rowCount() > 0;

    }

    
        
    

}
?>
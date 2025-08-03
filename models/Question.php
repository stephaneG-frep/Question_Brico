<?php

require_once "../db/Database.php";

class Question{

    private $db;
    //constructeur pour inicier la connexion 
    public function __construct(){
        //appel a la méthode getInstance
        $this->db = Database::getInstance();
    }


    public function registerQuestion($theme,$question,$id_user,$id_image,$id_question){

        $query = "INSERT INTO question(theme,question,id_user,id_image,id_question)
                   VALUES(:theme,:question,:id_user,:id_image,id_question)";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->bindParams(':theme',$theme);
        $req->bindParams(':question', $question);
        $req->bindParams(':id_user',$id_user);
        $req->bindParams(':id_image',$id_image);
        $req->bindParams(':id_question',$id_question);
        $req->execute();
        return $req->rowCount() > 0;

    }

    
        
    

}
?>
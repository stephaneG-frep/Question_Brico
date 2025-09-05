<?php

require_once "../db/Database.php";

class Commentaire{

    //gérer les connexion en base 
    private $db;
    //constructeur pour inicier la connexion
    public function __construct(){
        //appel a la méethode getInstance
        $this->db = Database::getInstance();
    }

    public function registerCommentaire($commentaire,$etoile,$id_user){
        //requete sql
        $query = "INSERT INTO commentaire(commentaire,etoile,id_user)
                  VALUES(:commentaire,:etoile, :id_user)";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->bindParam(':commentaire',$commentaire);
        $req->bindParam(':etoile',$etoile);
        $req->bindParam(':id_user',$id_user);
        $req->execute();
        return $req->rowCount() > 0;

    }

    public function getCommentaireById($id_commentaire){
        // Définition de la requête SQL pour récupérer une annonce par son identifiant
        $query = "SELECT * FROM commentaire WHERE id_commentaire = :id_commentaire";   
        // Obtention de la connexion à la base de données
        $dbConnexion = $this->db->getConnexion();   
        // Préparation de la requête SQL
        $req = $dbConnexion->prepare($query);   
        // Liaison du paramètre :id_annonce dans la requête SQL avec la valeur fournie en argument
        $req->bindParam(':id_commentaire', $id_commentaire);   
        // Exécution de la requête SQL
        $req->execute();   
        // Récupération du résultat sous forme de tableau associatif
        $result = $req->fetch(PDO::FETCH_ASSOC);   
        // Retour du tableau associatif contenant les informations de la production
        return $result;
    }

    //récuperer les tous les commentaires
    public function getAllCommentaires(){
    // Requête pour récupérer toutes les annonces avec les infos des utilisateurs
    $query = "SELECT c.id_commentaire, c.commentaire, c.etoile,
            c.id_user as id_user, u.nom,u.prenom,u.email,u.photo_profil FROM commentaire c
            JOIN users u ON c.id_user = u.id_user ORDER BY c.id_commentaire DESC";
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

    function getTotalCommentaires(){
        $query = "SELECT COUNT(*) as total FROM commentaire";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->execute();
        $result = $req->fetch(PDO::FETCH_ASSOC);

        return $result['total'];
    }

    //supprimer le commentaire
    public function deleteCommentaire($id_commentaire){
        $query = "DELETE FROM commentaire WHERE id_commentaire =:id_commentaire";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->bindParam(':id_commentaire', $id_commentaire);
        $req->execute();

        return $req->rowCount() >0;
    }


}



?>
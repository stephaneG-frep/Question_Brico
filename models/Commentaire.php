<?php
/*
ici les functions de classe (instance de classe) 
des requtes SQL pour gérer les commentaires
*/

require_once "../db/Database.php";

class Commentaire{

    //gérer les connexion en base 
    private $db;
    //constructeur pour inicier la connexion
    public function __construct(){
        //appel a la méethode getInstance
        $this->db = Database::getInstance();
    }

    //enregistrer les commentaires en BDD
    public function registerCommentaire($date,$commentaire,$etoile,$id_user){
        //requete sql
        $query = "INSERT INTO commentaire(date,commentaire,etoile,id_user)
                  VALUES(:date,:commentaire,:etoile, :id_user)";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->bindParam(':date',$date);
        $req->bindParam(':commentaire',$commentaire);
        $req->bindParam(':etoile',$etoile);
        $req->bindParam(':id_user',$id_user);
        $req->execute();
        return $req->rowCount() > 0;

    }
 
    //récuperer le commentaire par son id
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

    //récuperer tous les commentaires avec jointure sur l'utilisateur
    public function getAllCommentaires(){
    $query = "SELECT c.id_commentaire, c.date, c.commentaire, c.etoile,
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

     //commentaire par l'id de l'utilisateur
     public function commentaireByIdUser($id_user){
        $query = "SELECT 
        c.id_commentaire, c.date, c.commentaire, c.etoile,
        u.id_user,u.nom,u.prenom,u.photo_profil,u.email
        FROM commentaire c
        JOIN users u ON c.id_user = u.id_user
        WHERE u.id_user = :id_user
        ORDER BY c.id_commentaire DESC;";
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

    //vérifier l'id de l'utilisateur et du commentaire
    public function idUserAndIdCommentaire($id_commentaire){
        $query = "SELECT id_user FROM commentaire WHERE id_commentaire = :id_commentaire";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $question = "";
        $req->bindParam(':id_commentaire', $id_commentaire, PDO::PARAM_INT);
        $req->execute();
        $question = $req->fetch();
        return $question;
    }

    //compter les commentaires pour l'admin
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
<?PHP
/*
ici les functions de classe (instance de classe) 
des requtes SQL pour gérer les astuces
*/

require_once "../db/Database.php"; //fichier bde connexion

class Astuce{

    private $db;
    //constructeur pour inicier la connexion 
    public function __construct(){
        //appel a la méthode getInstance
        $this->db = Database::getInstance();
    }

    //fonction pour enregister en BDD
    public function registerAstuce($astuce,$date,$image_1,$image_2,$image_3,$id_user) {
        //requete SQL stokée dans une variable
        $query = "INSERT INTO astuce(astuce,date,image_1,image_2,image_3,id_user)
                   VALUES(:astuce,:date,:image_1,:image_2,:image_3,:id_user)";
        //obtenir la connexio a la BDD
        $dbConnexion = $this->db->getConnexion();
        //préparer la requete
        $req = $dbConnexion->prepare($query);
        // Liaison du paramètre : dans la requête SQL avec la valeur fournie en argument
        $req->bindParam(':astuce',$astuce);
        $req->bindParam(':date',$date);
        $req->bindParam(':image_1',$image_1);
        $req->bindParam(':image_2',$image_2);
        $req->bindParam(':image_3',$image_3);
        $req->bindParam(':id_user',$id_user);
        //executer la requete
        $req->execute();
        //compter le nombre de lignes
        return $req->rowCount() > 0;
    }

    //fonction pour ramener par l'id
    public function getAstuceById($id_astuce){
        // Définition de la requête SQL pour récupérer une annonce par son identifiant
        $query = "SELECT * FROM astuce WHERE id_astuce = :id_astuce";   
        // Obtention de la connexion à la base de données
        $dbConnexion = $this->db->getConnexion();   
        // Préparation de la requête SQL
        $req = $dbConnexion->prepare($query);   
        // Liaison du paramètre :id_annonce dans la requête SQL avec la valeur fournie en argument
        $req->bindParam(':id_astuce', $id_astuce);   
        // Exécution de la requête SQL
        $req->execute();   
        // Récupération du résultat sous forme de tableau associatif
        $result = $req->fetch(PDO::FETCH_ASSOC);   
        // Retour du tableau associatif contenant les informations de la production
        return $result;
    }

    //récuperer tous
    public function getAllAstuces(){
    // Requête pour récupérer toutes les annonces avec les infos des utilisateurs
    $query = "SELECT a.id_astuce, a.astuce, a.date, a.image_1, a.image_2, a.image_3,
            a.id_user as id_user, u.nom,u.prenom,u.email,u.photo_profil FROM astuce a
            JOIN users u ON a.id_user = u.id_user ORDER BY a.id_astuce DESC";
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

    //pour l'administrateur decompte 
    function getTotalAstuces(){
        $query = "SELECT COUNT(*) as total FROM astuce";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->execute();
        $result = $req->fetch(PDO::FETCH_ASSOC);

        return $result['total'];
    }

    //astuce par l'id de l'utilisateur
    public function astuceByIdUser($id_user){
        //requete pour recuperer par l'id de l'utilisateur les astuces
        $query = "SELECT 
        a.id_astuce,a.astuce,a.date,a.image_1,a.image_2,a.image_3,
        u.id_user,u.nom,u.prenom,u.photo_profil,u.email
        FROM astuce a
        JOIN users u ON a.id_user = u.id_user
        WHERE u.id_user = :id_user
        ORDER BY a.id_astuce DESC";
        //connexion a la BDD
        $dbConnexion = $this->db->getConnexion();
        //preparer la requete
        $req = $dbConnexion->prepare($query);
        //lier les paramètres
        $req->bindParam(':id_user',$id_user);
        //executer la requete
        $req->execute();
        $resultats = array();    
        // Parcours des résultats de la requête et stockage dans le tableau $resultats
            while($ligne = $req->fetch(PDO::FETCH_ASSOC)){
                $resultats[] = $ligne;
            } 
        return $resultats;   
    }

     //vérifier l'id de l'utilisateur et de l'astuce
     public function idUserAndIdAstuce($id_astuce){
        $query = "SELECT id_user FROM astuce WHERE id_astuce = :id_astuce";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $question = "";
        $req->bindParam(':id_astuce', $id_astuce, PDO::PARAM_INT);
        $req->execute();
        $question = $req->fetch();
        return $question;
    }

    //supprimer les astuces
    public function deleteAstuce($id_astuce){
        $query = "DELETE FROM astuce WHERE id_astuce =:id_astuce";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->bindParam(':id_astuce', $id_astuce);
        $req->execute();

        return $req->rowCount() >0;
    }






}
?>
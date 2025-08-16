<?PHP

require_once "../db/Database.php";

class Image{

    private $db;
    //constructeur pour inicier la connexion 
    public function __construct(){
        //appel a la méthode getInstance
        $this->db = Database::getInstance();
    }

    /*
    public function registerImage($images,$id_user){
        $query = "INSERT INTO image (image_1,image_2,image_3,image_4,image_5,id_user)
                  VALUES (:img1,:img2,:img3,:img4,:img5,:id_user)";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $images= [];
        $req->bindParam(':img1', $images[0], PDO::PARAM_STR);
        $req->bindParam(':img2', $images[1], PDO::PARAM_STR);
        $req->bindParam(':img3', $images[2], PDO::PARAM_STR);
        $req->bindParam(':img4', $images[3], PDO::PARAM_STR);
        $req->bindParam(':img5', $images[4], PDO::PARAM_STR);
        $req->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $images = array();    
        // Parcours des résultats de la requête et stockage dans le tableau $resultats
            while($ligne = $req->fetch(PDO::FETCH_ASSOC)){
                $images[] = $ligne;
            }  
        return $images; 
    }
*/

    public function registerImage($image_1,$image_2,$image_3,$image_4,$image_5,$id_user){

        $query = "INSERT INTO image(image_1,image_2,image_3,image_4,image_5,id_user)
                   VALUES(:image_1,:image_2,:image_3,:image_4,:image_5,:id_user)";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->bindParam(':image_1',$image_1);
        $req->bindParam(':image_2',$image_2);
        $req->bindParam(':image_3',$image_3);
        $req->bindParam(':image_4',$image_4);
        $req->bindParam(':image_5',$image_5);
        $req->bindParam(':id_user',$id_user);
        //$req->bindParam(':id_image',$id_image);
        $req->execute();
        $resultats = array();    
        // Parcours des résultats de la requête et stockage dans le tableau $resultats
            while($ligne = $req->fetch(PDO::FETCH_ASSOC)){
                $resultats[] = $ligne;
            }  
        return $resultats;  

    }

    public function imageById($id_image){
        // Définition de la requête SQL pour récupérer une annonce par son identifiant
        $query = "SELECT * FROM image WHERE id_image = :id_image";   
        // Obtention de la connexion à la base de données
        $dbConnexion = $this->db->getConnexion();   
        // Préparation de la requête SQL
        $req = $dbConnexion->prepare($query);   
        // Liaison du paramètre :id_annonce dans la requête SQL avec la valeur fournie en argument
        $req->bindParam(':id_image', $id_image);   
        // Exécution de la requête SQL
        $req->execute();   
        // Récupération du résultat sous forme de tableau associatif
        $result = $req->fetch(PDO::FETCH_ASSOC);   
        // Retour du tableau associatif contenant les informations de la production
        return $result;
    }

    
    public function imageByIdUser($id_user){
        $query = "SELECT * FROM image WHERE id_user = :id_user";
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

    public function getAllImage(){
        //récuperer les toutes annonces     
       // Requête pour récupérer toutes les annonces avec les infos des utilisateurs
       $query = "SELECT i.id_image, i.image_1, i.image_2, i.image_3, i.image_4, i.image_5, i.id_user as id_user, 
                       u.nom,u.prenom,u.email,u.photo_profil FROM image i
                    JOIN users u ON i.id_user = u.id_user ORDER BY i.id_image DESC";
   
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


}





?>
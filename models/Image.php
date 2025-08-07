<?PHP

require_once "../db/Database.php";

class iMAGE{

    private $db;
    //constructeur pour inicier la connexion 
    public function __construct(){
        //appel a la méthode getInstance
        $this->db = Database::getInstance();
    }


    public function registerImage($image_1,$image_2,$image_3,$image_4,$image_5,$id_user){

        $query = "INSERT INTO image(image_1,image_2,image_3,image_4,image_5,id_user)
                   VALUES(:image_1,:image_2,:image_3,:image_4,:image_5,:id_user)";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->bindParam(':image_1',$image_1);
        $req->bindParam(':image_2', $image_2);
        $req->bindParam(':image_3',$image_3);
        $req->bindParam(':image_4',$image_4);
        $req->bindParam(':image_5',$image_5);
        $req->bindParam(':id_user',$id_user);
        //$req->bindParam(':id_image',$id_image);
        $req->execute();
        return $req->rowCount() > 0;

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

}





?>
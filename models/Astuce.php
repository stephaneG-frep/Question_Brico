<?PHP

require_once "../db/Database.php";

class Astuce{

    private $db;
    //constructeur pour inicier la connexion 
    public function __construct(){
        //appel a la méthode getInstance
        $this->db = Database::getInstance();
    }

    public function registerAstuce($astuce,$image_1,$image_2,$image_3,$id_user) {

        $query = "INSERT INTO astuce(astuce,image_1,image_2,image_3,id_user)
                   VALUES(:astuce,:image_1,:image_2,:image_3,:id_user)";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->bindParam(':astuce',$astuce);
        $req->bindParam(':image_1',$image_1);
        $req->bindParam(':image_2',$image_2);
        $req->bindParam(':image_3',$image_3);
        $req->bindParam(':id_user',$id_user);
        //$req->bindParam(':id_question',$id_question);
        $req->execute();
        return $req->rowCount() > 0;
    }



}
?>
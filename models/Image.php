<?PHP

require_once "../db/Database.php";

class iMAGE{

    private $db;
    //constructeur pour inicier la connexion 
    public function __construct(){
        //appel a la méthode getInstance
        $this->db = Database::getInstance();
    }


    public function registerImage($image_1,$image_2,$image_3,$image_4,$image_5,$id_user,$id_question,$id_image){

        $query = "INSERT INTO image(image_1,image_2,image_3,image_4,image_5,id_user,id_question,id_image)
                   VALUES(:image_1,:image_2,:image_3,:image_4,:image_5,:id_user,:id_question,:id_image)";
        $dbConnexion = $this->db->getConnexion();
        $req = $dbConnexion->prepare($query);
        $req->bindParams(':image_1',$image_1);
        $req->bindParams(':image_2', $image_2);
        $req->bindParams(':image_3',$image_3);
        $req->bindParams(':image_4',$image_4);
        $req->bindParams(':image_5',$image_5);
        $req->bindParams(':id_user',$id_user);
        $req->bindParams(':id_question',$id_question);
        $req->bindParams(':id_image',$id_image);
        $req->execute();
        return $req->rowCount() > 0;

    }

}





?>
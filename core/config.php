<?php
//constante de de chemins pour reccuperer les dossier a inclure les routes de chemin 

//si le serveur est localhost la constante ROOT est sur le chemin http://localhost/Question_Brico
if($_SERVER['SERVER_NAME'] == "localhost"){
     define('ROOT', "http://localhost/Question_Brico");

     //constante de connexion a la BDD
     define('DB_HOST', 'localhost');
     define('DB_USERNAME', 'root');
     define('DB_PASSWORD', '');
     define('DB_NAME', 'questionbrico');

}else{
    //sinon le nom du domaine
    define('ROOT', 'https://');
}





?>
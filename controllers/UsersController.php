<?php

require_once "./Autoload.php";

class UsersController{

    public function index(){
        //$this->getAllUsers();
        echo "ceci est l'action pzr defaut ";
    }

    //methode qui envoie la page inscription (views/user/inscription.php)
    public function inscription(){
        include('views/user/inscription.php');
    }
    
    //methode qui renvoie la page connexion (views/user/connexion.php)
    public function connexion(){
        include('views/user/connexion.php');
    }
}



?>
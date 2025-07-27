<?php

require_once "./Autoload.php";

class UsersController{

    public function index(){
        //$this->getAllUsers();
        echo "ceci est l'action pzr defaut ";
    }

    public function inscription(){
        include('views/user/inscription.php');
    }
}



?>
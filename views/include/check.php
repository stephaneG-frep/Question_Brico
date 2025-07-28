<?php

//fonction pour sécuriser le formulaire
function check($data){
    $data = trim($data);
    $data = strip_tags($data);
    $data = stripcslashes($data);
    return $data;

}

?>
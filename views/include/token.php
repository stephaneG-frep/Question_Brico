<?php

//fonction pour faire un nom aléatoire a la photo
function token_random_string($len=20){
    //variable dans laquelle piocher
    $str = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    $token = "";
    for($i=0;$i<$len;$i++){
        $token.=$str[rand(0,strlen($str))-1];
    }
    return $token;
}
$token = token_random_string(25);

?>
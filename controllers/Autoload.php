<?php
//classe d'autochargement des autres classes et leurs fichiers
class Autoload{
    //méthode d'enregistrement de la fonction d'autoload
    public static function register(){
        spl_autoload_register([__CLASS__,'load']);
    }

    //méthode de chargement de la classe spécifiée
    public static function load($className){
        //répertoire de base ou se trouve les fichiers de classes
        $baseDir = __DIR__.'/';
        // liste des répertoires ou peuvent etres les fichiers
        $directories = [
            'controllers/',
            'models/',
            'views/',
            'core/',
            'core/db/',
            '/'
        ];

        // foreach pour parcourir tous les répertoires
        foreach($directories as $directory){
            //chemin complet du fichier de classe
            $file = $baseDir . $directory .$className.'.php';

            //vérifier si le chemin existe
            if(file_exists($file)){
                //si ou l'inclure
                include $file;
                return;
            }
        }
    }
}
//enregistrement de la fonction d'autochargement lors de l'inclusion du fichier de  class Autoload.php
Autoload::register();







?>
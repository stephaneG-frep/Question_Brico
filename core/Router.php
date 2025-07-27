<?php
//inclure les fichier néccéssaire
require 'config.php';

class Router{

    public function routeRequest(){
        //récupérer l'URL de la requete par défaut '/'
        $url = isset($_GET['url']) ? $_GET['url'] : '/';
        //diviser l'url en parties en utilisant '/' comme séparateur et trim pour supprimer les espaces
        $urlParts = explode('/', trim($url, '/'));
        //construire le nom du controlleur en fonction de la premiere partie de l'url
        $controllerName = (!empty($urlParts[0])) ? ucfirst($urlParts[0]).'Controller' : 'HomeController';
        //déterminer l'action en fonction de la deuxieme partie de l'url, par défaut 'index'
        $action = (!empty($urlParts[1])) ? $urlParts[1] : 'index';
        //construre le chemin vers le fichier du controleur
        $controllerFile = 'controllers/'.$controllerName.'.php';
        //vérifier si le fichier du controleur existe
        if(file_exists($controllerFile)){
            //inclure le fichier du controleur
            require_once($controllerFile);
            //vérifier si la classe du controleur existe
            if(class_exists($controllerName)){
                //instancier le controleur
                $controller = new $controllerName();
                //vérifier la méthode action du controleur
                if(method_exists($controller, $action)){
                    //(a partir de la troisieme partie)on récupère les paramètres de l'url
                    $params = array_slice($urlParts, 2);
                    //recupérer la réflexion(information) de la méthode
                    $reflectionMethod = new ReflectionMethod($controller, $action);
                    //récupérer les paramètres de la méthode
                    $methodParams = $reflectionMethod->getParameters();
                    //vérifier si les parametres sont nécéssaires au fonctionnement de la méthode
                    if(count($methodParams) > 0){
                        //s'assurer que le nombre de params fournis en url est suffisant pour exicuter la méthode
                        if(count($params) >= count($methodParams)){
                            //appeler la méthode du controleur et les params
                            call_user_func_array([$controller, $action], $params);

                        }else{
                            echo "Erreur 404 - Page non trouvée! Paramètres passés en URL insuffisants";
                        }
                    }else{
                        //appeler la méthode du controleur sans spécifier de params
                        $controller->$action();
                    }
                }else{
                    echo "Erreur 404 - Page non trouvée! Méthode non trouvée";
                }
            }else{
                echo "Erreur 404 - Page non trouvée! classe non trouvée";
            }
        }else{
            echo "Erreur 404 - Page non trouvée ! controleur non trouvé";
        }
    }
}



?>
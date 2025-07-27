<?php

$pageTitle = "Page d'accueil";

ob_start();

echo $this->index();

$content = ob_get_clean();

include('views/include/template.php');


?>
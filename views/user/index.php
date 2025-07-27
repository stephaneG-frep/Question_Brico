<?php

$pageTitle = "Page d'accueil";

ob_start();

echo $this->index();

$content = ob_end_clean();

include('views/include/template.php');


?>
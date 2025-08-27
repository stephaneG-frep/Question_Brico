<?php

error_reporting(-1);
ini_set("display_errors", 1);

require_once "../models/Users.php";
$date = date("d/m/Y"); 


?>
<body>
<header>
    <div class="container_nav">
        <h1>Bienvenue sur le site de Question Brico</h1> 
        <p>Si vous avez une question sur le bricolage alors <br> c'est ici que l'on feras tous pour vous répondre</p>  
        <?php echo "<p>Bonjour, nous somme le {$date} .</p>"; ?>        
    </div>
</header>

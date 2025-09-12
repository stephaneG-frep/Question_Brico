<?php
error_reporting(-1);
ini_set("display_errors", 1);
//incluer les fichier nécéssaire
//adminOnly();
require_once "template/header.php";
require_once "../db/config.php";
require_once "../models/Reponse.php";


if (isset($_GET['page'])) {
    $page = (int)$_GET['page'];
} else {
    $page = 1;
}

//instancier une reponse
$new_reponse = new Reponse();
//rammener tous les reponses 10 par pages
$reponses = $new_reponse->AllReponses(10, $page);

//compter
$totalAnnonces = $new_reponse->getTotalReponses();

$totalPages = ceil($totalAnnonces / 10);


?>

<h1 class="py-5">Listes des reponses </h1>

<table class="table">
    <thead>
        <tr>

            <th scope="col">#</th>
            <th scope="col">Date</th>
            <th scope="col">Email</th>
            <th scope="col">Reponse</th>  
        </tr>
    </thead>
    <tbody>
        <?php foreach($reponses as $reponse) {?>
        <tr>
            <th scope="row"><?=$reponse['id_reponse']?></th>
            <th><?=$reponse['date']?></th>
            <td><?=$reponse['email']?></td>
            <td><?=$reponse['reponse']?></td>
           
            <td>
                
                <a href="delete_reponse.php?id_reponse=<?= $reponse['id_reponse'] ?>"
                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette reponse ?')">Supprimer</a>
            </td>
        </tr>
        <?php }?>
    </tbody>
</table>

<?php if ($totalPages > 1) {?>
<nav aria-label="Page navigation example">
    <ul class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++) {?>
        <li class="page-item <?php if ($i === $page) { echo "active"; }?>"><a class="page-link"
                href="?page=<?=$i;?>"><?=$i;?></a></li>
        <?php }?>
    </ul>
</nav>
<?php }?>

<?php 
require_once "template/footer.php";
?>
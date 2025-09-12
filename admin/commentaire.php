<?php
error_reporting(-1);
ini_set("display_errors", 1);
//incluer les fichier nécéssaire
//adminOnly();
require_once "template/header.php";
require_once "../db/config.php";
require_once "../models/Commentaire.php";


if (isset($_GET['page'])) {
    $page = (int)$_GET['page'];
} else {
    $page = 1;
}

//instancier un user
$new_commentaire = new Commentaire();
//rammener tous les users 10 par pages
$commentaires = $new_commentaire->getAllCommentaires(10, $page);

//compter
$totalAnnonces = $new_commentaire->getTotalCommentaires();

$totalPages = ceil($totalAnnonces / 10);


?>

<h1 class="py-5">Listes des commentaires </h1>

<table class="table">
    <thead>
        <tr>

            <th scope="col">#</th>
            <th scope="col">Date</th>
            <th scope="col">Email</th>
            <th scope="col">Commentaire</th>
            <th scope="col">Etoile</th>
            
        </tr>
    </thead>
    <tbody>
        <?php foreach($commentaires as $commentaire) {?>
        <tr>
            <th scope="row"><?=$commentaire['id_commentaire']?></th>
            <td><?=$commentaire['date']?></td>
            <td><?=$commentaire['email']?></td>
            <td><?=$commentaire['commentaire']?></td>
            <td><?=$commentaire['etoile']?></td>
            
            
            <td>
                
                <a href="delete_commentaire.php?id_commentaire=<?= $commentaire['id_commentaire'] ?>"
                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?')">Supprimer</a>
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
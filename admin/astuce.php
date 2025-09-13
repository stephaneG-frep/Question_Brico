<?php
error_reporting(-1);
ini_set("display_errors", 1);
//inclure les fichier nécéssaire

require_once "template/header.php"; //fichier de l'accueil
require_once "../db/config.php"; //fichier de connexion
require_once "../models/Astuce.php"; //fichier de classe 

//vérifier qu'il y est des page et la quelle sinon page 1
if (isset($_GET['page'])) {
    $page = (int)$_GET['page'];
} else {
    $page = 1;
}

//instancier une astuce
$new_astuce = new Astuce();
//rammener toutes les astuces 10 par pages
$astuces = $new_astuce->getAllAstuces(10, $page);

//compter
$totalAnnonces = $new_astuce->getTotalAstuces();

$totalPages = ceil($totalAnnonces / 10);


?>

<h1 class="py-5">Listes des astuces </h1>

<table class="table">
    <thead>
        <tr>

            <th scope="col">#</th>
            <th scope="col">Email</th>
            <th scope="col">Astuce</th>
            <th scope="col">Date</th>
            <th scope="col">Image_1</th>
            <th scope="col">Image_2</th>
            <th scope="col">Image_3</th>
        </tr>
    </thead>
    <tbody>
<!-- on boucle avec foreach sur les astuces et on les insère dans un tableau -->
        <?php foreach($astuces as $astuce) {?>
        <tr>
            <th scope="row"><?=$astuce['id_astuce']?></th>
            <td><?=$astuce['email']?></td>
            <td><?=$astuce['astuce']?></td>
            <td><?=$astuce['date']?></td>
            <td><img src="<?='../uploads/img/'.$astuce['image_1'] ?>" alt="" class="rounded rounded-circle" width="100" height="100"></td>
            <td><img src="<?='../uploads/img/'.$astuce['image_2'] ?>" alt="" class="rounded rounded-circle" width="100" height="100"></td>
            <td><img src="<?='../uploads/img/'.$astuce['image_3'] ?>" alt="" class="rounded rounded-circle" width="100" height="100"></td>
            <td>                
                <a href="delete_astuce.php?id_astuce=<?= $astuce['id_astuce'] ?>"
                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette astuce ?')">Supprimer</a>
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
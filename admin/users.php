<?php
error_reporting(-1);
ini_set("display_errors", 1);
//incluer les fichier nécéssaire


require_once "template/header.php";
require_once "../db/config.php";
require_once "../models/Users.php";


if (isset($_GET['page'])) {
    $page = (int)$_GET['page'];
} else {
    $page = 1;
}

//instancier un user
$new_users = new Users();
//rammener tous les users 10 par pages
$users = $new_users->AllUsers();

//compter
$totalUsers = $new_users->getTotalUsers();

$totalPages = ceil($totalUsers / 10);


?>

<h1 class="py-5">Listes des Users</h1>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Email</th>
            <th scope="col">Image</th>
            <th scope="col">role</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user) {?>
        <tr>
            <th scope="row"><?=$user['id_user']?></th>
            <td><?=$user['nom']?></td>
            <td><?=$user['prenom']?></td>
            <td><?=$user['email']?></td>
            <td><img src="<?='../uploads/photo_profil/'.$user['photo_profil'] ?>" alt="" class="rounded rounded-circle" width="100" height="100"></td>
            <td><?=$user['role']?></td>
            <td>
                <a href="delete_users.php?id_user=<?= $user['id_user'] ?>"
                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</a>
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
<?php

error_reporting(-1);
ini_set("display_errors", 1);

//inclure les fichiers nécéssaire
require_once "template/header.php";
require_once "../models/Users.php";
require_once "../db/config.php";

if (isset($_GET['page'])) {
    $page = (int)$_GET['page'];
} else {
    $page = 1;
}

//instancier un user
$new_user = new Users();
//rammener tous les users 10 par pages
$users = $new_user->AllUsers(10, $page);

//compter
$totalAnnonces = $new_user->getTotalUsers();

$totalPages = ceil($totalAnnonces / 10);

// Traitement du changement de rôle
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = $_POST['id_user'] ?? 0;
    $new_role = $_POST['role'] ?? '';

    if ($id_user > 0 && in_array($new_role, ['user', 'moderateur', 'admin'])) {
        $user_role = new Users();
        $role = $user_role->updateRole($id_user,$new_role);
    }
   }
?>

<h1 class="py-5">Listes des administrateurs </h1>

<table class="table">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Email</th>
            <th>Rôle actuel</th>
            <th>Nouveau rôle</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php 
     $new_users = new Users();
     $users = $new_users->AllUsers();
    foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['prenom'] . ' ' . $user['nom']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td class="role-<?= htmlspecialchars($user['role']) ?>">
                            <?= ucfirst(htmlspecialchars($user['role'])) ?>
                        </td>
                        <td>
                            <form method="post" style="display: flex; align-items: center;">
                                <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                                <select name="role" class="role-select" required>
                                    <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>Utilisateur</option>
                                    <option value="moderateur" <?= $user['role'] === 'moderateur' ? 'selected' : '' ?>>Modérateur</option>
                                    <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Administrateur</option>
                                </select>
                        </td>
                        <td>
                                <button type="submit" class="update-button">
                                    <i class="fas fa-sync-alt"></i> Mettre à jour
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
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
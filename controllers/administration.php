<?php
error_reporting(-1);
ini_set("display_errors", 1);
require '../db/config.php';
require '../models/Users.php';
require 'template/header.php';

//require_once "../include/head.php";
//require_once "../include/nav_burger.php";
//require_once "../include/navigation.php";
//require_once "../include/header.php";
if (isset($_GET['page'])) {
    $page = (int)$_GET['page'];
} else {
    $page = 1;
}


// Vérifier que l'utilisateur est administrateur
if (isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];
    if($user['role'] === "admin"){
    $new_user = new Users();
    $user = $new_user->getUserById($id_user);

    //$questions = $new_question->questionByIdUser($id_user);
    $nom = $user['nom'];
    $prenom = $user['prenom'];
    $email = $user['email'];
    $image = $user['photo_profil'];
    $role = $user['role'];
    }



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

    <div class="admin-container">
        <h1><i class="fas fa-user-shield"></i> GESTION DES RÔLES</h1>

        <?php if (isset($success)): ?>
            <div class="success-message">
                <i class="fas fa-check-circle"></i> <?= htmlspecialchars($success) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="error-message">
                <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <p>
            En tant qu'administrateur, vous pouvez modifier les rôles des utilisateurs.
            Attention, cette action peut avoir un impact sur les permissions d'accès au site.
        </p>

        <table>
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
                foreach ($users as $user): 
                ?>
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
    </div>
    <?php } ?>
</body>
<?php require_once "template/footer.php" ?>
</html>

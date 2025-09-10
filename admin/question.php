<?php
error_reporting(-1);
ini_set("display_errors", 1);
//incluer les fichier nécéssaire
//adminOnly();
require_once "template/header.php";
require_once "../db/config.php";
require_once "../models/Question.php";


if (isset($_GET['page'])) {
    $page = (int)$_GET['page'];
} else {
    $page = 1;
}

//instancier un user
$new_question = new Question();
//rammener tous les users 10 par pages
$questions = $new_question->getAllQuestion(10, $page);

//compter
$totalAnnonces = $new_question->getTotalQuestions();

$totalPages = ceil($totalAnnonces / 10);


?>

<h1 class="py-5">Listes des astuces </h1>

<table class="table">
    <thead>
        <tr>

            <th scope="col">#</th>
            <th scope="col">Email</th>
            <th scope="col">Theme</th>
            <th scope="col">Question</th>
            <th scope="col">Image_1</th>
            <th scope="col">Image_2</th>
            <th scope="col">Image_3</th>
            <th scope="col">Image_4</th>
            <th scope="col">Image_5</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($questions as $question) {?>
        <tr>
            <th scope="row"><?=$question['id_question']?></th>
            <td><?=$question['email']?></td>
            <td><?=$question['theme']?></td>
            <td><?=$question['question']?></td>
            <td><img src="<?='../uploads/img/'.$question['image_1'] ?>" alt="" class="rounded rounded-circle" width="100" height="100"></td>
            <td><img src="<?='../uploads/img/'.$question['image_2'] ?>" alt="" class="rounded rounded-circle" width="100" height="100"></td>
            <td><img src="<?='../uploads/img/'.$question['image_3'] ?>" alt="" class="rounded rounded-circle" width="100" height="100"></td>
            <td><img src="<?='../uploads/img/'.$question['image_4'] ?>" alt="" class="rounded rounded-circle" width="100" height="100"></td>
            <td><img src="<?='../uploads/img/'.$question['image_5'] ?>" alt="" class="rounded rounded-circle" width="100" height="100"></td>           
            <td>
                
                <a href="delete_question.php?id_question=<?= $question['id_question'] ?>"
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
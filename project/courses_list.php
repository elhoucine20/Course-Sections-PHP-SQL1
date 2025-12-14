<?php
include "header.php";
include "config.php";

$mysql = 'SELECT * FROM courses';
$produis = mysqli_query($connect, $mysql);

$dataa = mysqli_fetch_all($produis, MYSQLI_ASSOC);
?>

<div class="table-container">
    <h2>Liste des Cours</h2>

    <table class="course-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Level</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($produis as $elemnt){ ?>
            <tr>
                <td><?= $elemnt['id'] ?></td>
                <td><?= $elemnt['title'] ?></td>
                <td><?= $elemnt['description'] ?></td>
                <td><?= $elemnt['level'] ?></td>
                <td><?= $elemnt['created_at']?></td>
                <td class="actions">
                    <a href="courses_edit.php?id=<?= $elemnt['id'] ?>" class="btn-edit">
                     Modifier
                    </a>
                    <a href="courses_delete.php?id=<?= $elemnt['id'] ?>" 
                       class="btn-delete"
                       onclick="return confirm('est ce que vous avais supprimer cette cours ?')">
                         Supprimer
                    </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="table-actions">
        <a href="courses_create.php" class="btn btn-primary">
             Ajouter un Cours
        </a>
    </div>
</div>

<?php include "footer.php"; ?>
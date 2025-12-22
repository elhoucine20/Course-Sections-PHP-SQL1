<?php
include "sessions.php";
include "header.php";
include "config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT courses.id, courses.title, courses.description, courses.level,enrollments.enrolled_at  FROM courses
         JOIN enrollments   ON courses.id = enrollments.course_id
         WHERE enrollments.user_id = $user_id ";

$result = mysqli_query($connect, $sql);
?>

<div class="table-container">
    <h2>Mes Cours</h2>

    <?php if (mysqli_num_rows($result) == 0) { ?>
        <p>aucun cours</p>
    <?php } else { ?>

    <table class="course-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Level</th>
                <th>Inscrit le</th>
            </tr>
        </thead>
        <tbody>
            <?php while($course = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $course['title']?></td>
                    <td><?= $course['description']?></td>
                    <td><?= $course['level']?></td>
                    <td><?= $course['enrolled_at'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <?php } ?>
</div>

<?php include "footer.php"; ?>

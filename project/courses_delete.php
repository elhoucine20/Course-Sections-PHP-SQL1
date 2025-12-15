<?php
include "config.php";

// Verifier if ID f URL 
if (!isset($_GET['id'])) {
    header("Location: courses_list.php");
    exit();
}
$id = intval($_GET['id']); // transform id to int (security)

// 1.  course_id to NULL pour les sections liee
$sqlUpdate = "UPDATE sections SET course_id = NULL WHERE course_id = '$id'";
$resultUpdate = mysqli_query($connect, $sqlUpdate);

// 2. Supprimer cours
$sqlDelete = "DELETE FROM courses WHERE id = '$id'";
$resultDelete = mysqli_query($connect, $sqlDelete);

// Verification if suppression est succes
if ($resultDelete) {
    header("Location: courses_list.php?message=deleted");
    exit();
} else {
    header("Location: courses_list.php?error=delete invalid");
    exit();
}
?>
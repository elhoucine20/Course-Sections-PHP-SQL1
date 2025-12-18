<?php
include "config.php";

// Verifier if ID en URL 
if (!isset($_GET['id'])) {
    header("Location: courses_list.php");
    exit();
}

$id = $_GET['id']; 

// course_id to null pour les sections liee
$sqlUpdate = "UPDATE sections SET course_id = NULL WHERE course_id = '$id'";
$resultUpdate = mysqli_query($connect, $sqlUpdate);

// Supprimer cours
$sqlDelete = "DELETE FROM courses WHERE id = '$id'";
$resultDelete = mysqli_query($connect, $sqlDelete);

// Verification if suppression est succes
if ($resultDelete) {
    header("Location: courses_list.php");
    exit();
} else {
    header("Location: courses_list.php");
    exit();
}
?>
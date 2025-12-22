<?php
session_start();
include "config.php";
include "sessions.php";

//   if user connect
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

// if si course_id existe
if(!isset($_GET['course_id'])){
    header("Location: courses_list.php");
    exit();
}

$course_id = $_GET['course_id'];
$user_id = $_SESSION['user_id'];

// if le course existe
$CheckCourse = "SELECT * FROM courses WHERE id = '$course_id'";
$resultCheckCourse = mysqli_query($connect, $CheckCourse);

if(mysqli_num_rows($resultCheckCourse) == 0){
    header("Location: courses_list.php");
    exit();
}

// if deja inscrit
$sqlCheckEnroll = "SELECT * FROM enrollments WHERE user_id = '$user_id' AND course_id = '$course_id'";
$resultCheckEnroll = mysqli_query($connect, $sqlCheckEnroll);

if(mysqli_num_rows($resultCheckEnroll) > 0){
    // deja inscrit
    $_SESSION['message'] = "deja inscrit en cette cours";
    header("Location: courses_list.php");
    exit();
} else {
    // inscrire de utilisateur
    $Enroll = "INSERT INTO enrollments (user_id, course_id) 
                  VALUES ('$user_id', '$course_id')";
    
    if(mysqli_query($connect, $Enroll)){
        $_SESSION['message'] = "inscription succes";
        header("Location: my_courses.php");
        exit();
    } else {
        $_SESSION['message'] = "Erreur lors de l'inscription";
        header("Location: courses_list.php");
        exit();
    }
}
?>








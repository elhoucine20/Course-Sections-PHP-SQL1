<?php
include "sessions.php";
include "config.php";

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: courses_list.php");
    exit;
}

$user_id  = $_SESSION['user_id'];
$course_id = intval($_GET['id']);

// evite la repetetion de course 
$check = "SELECT id FROM enrollments 
          WHERE user_id = $user_id AND course_id = $course_id";
          
$res = mysqli_query($connect, $check);

if (mysqli_num_rows($res) == 0) {
    $sql = "INSERT INTO enrollments (user_id, course_id)
            VALUES ($user_id, $course_id)";
    mysqli_query($connect, $sql);
}

header("Location: my_courses.php");
exit;

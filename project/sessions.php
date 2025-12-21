

 <?php
session_start();

if(!isset($_SESSION['emai_l'])){
    header("location: login.php");
}
?>

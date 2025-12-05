<?php
$connect = mysqli_connect('localhost' , 'root' ,'' , 'brief');

if(!$connect){
  die('connexion error:' . mysqli_connect_error());
}
// echo 'connexion valide';
?>

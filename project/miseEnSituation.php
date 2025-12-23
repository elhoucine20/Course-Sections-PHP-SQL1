<?php
include "config.php";
include "login.php";

session_start();
$count=0;
if($_POST['login']){
    $count++;
   $_SESSION[$count];
}

// sans inscrire
$sansInscrire="SELECT users.name,users.email,users.id FROM users 
    JOIN enrollments ON user_id!=course_id
   
  ";
$sqlSansInscrire=mysqli_query($connect,$sansInscrire);
$resultSansInscrire=mysqli_fetch_assoc($sqlSansInscrire);


echo $nombreInscrire= $_SESSION[$count];
?>

<table>
    <?php if(mysqli_num_rows($resultSansInscrire)>0){
 ?>
    <thead>

    <tr>
        <td>name</td>
        <td>email</td>
        <td>id</td>
    </tr>
    </thead>
       <tbody>
      <?php while($user=mysqli_num_rows($resultSansInscrire)){ ?>
        <tr>
            <td><?php $user['name'] ?></td>
            <td><?php $user['email'] ?></td>
            <td><?php $user['id'] ?></td>
           
        </tr>
        <?php} ?>
       </tbody>
       <?php }  ?>
</table>



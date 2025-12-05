

  <div class="table-container">
  <?php
  include "header.php" ;
  include "config.php" ;

  $mysql='SELECT * FROM courses ';
  $produis = mysqli_query( $connect, $mysql);

//   print_r($produis)
  $dataa = mysqli_fetch_all ( $produis , MYSQLI_ASSOC);
//  print_r($dataa);

  ?>
  <div class="table-container">
    <h2>Courses List</h2>
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
        <?php
        foreach($dataa as $elemnt){
        ?>
        <tr>
          <td><?= $elemnt['id'] ?></td>
          <td><?= $elemnt['title'] ?></td>
          <td><?= $elemnt['description'] ?></td>
          <td><?= $elemnt['level'] ?></td>
          <td><?= $elemnt['created_at'] ?></td>
          </td>
          <td class = "buttons">
<button class="edit-btn ">Modifier</button>
<button class="delete-btn ">Supprimer</button>
</td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

<?php
include "footer.php" ;
?>
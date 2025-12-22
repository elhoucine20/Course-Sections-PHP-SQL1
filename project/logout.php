
<?php
session_start();
// delete toutes en session
session_unset();
// delete all 
session_destroy();


// vers login
header("Location: login.php");
exit();

?>

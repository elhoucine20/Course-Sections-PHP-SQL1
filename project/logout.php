
<?php
session_start();
// 
session_destroy();
// delete toutes en session
session_unset();

// vers login
header("Location: login.php");
exit();
?>
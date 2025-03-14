<?php
// Inicialize a sessÃ£o
session_start();
 
// Remova todas as variÃ¡veis de sessÃ£o
$_SESSION = array();
 
// Destrua a sessÃ£o.
session_destroy();
 
// Redirecionar para a pÃ¡gina de login
header("location: login.php");
exit;
?>
<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'mysql48-farm1.kinghost.net');
define('DB_USERNAME', 'valeoescrito');
define('DB_PASSWORD', 'Kmvd96uJ');
define('DB_NAME', 'valeoescrito');

/* Attempt to connect to MySQL database */
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
?>

<?php
$mysqli = new mysqli("", "", "", "");

if($mysqli->connect_errno) {
    echo "Falha na conexão: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}




?>

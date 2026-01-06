<?php
// conecta.inc.php
require_once __DIR__ . '/config.inc.php';

$mysqli = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$mysqli) {
    die("Error de conexión MySQL: " . mysqli_connect_error());
}

if (!empty($dbcharset)) {
    mysqli_set_charset($mysqli, $dbcharset);
}
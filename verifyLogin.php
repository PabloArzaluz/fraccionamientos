<?php 
session_start();
include('configPHP/config.inc.php');

// 1. Recibimos los datos
$user = $_POST['email_country_login'];
$password = $_POST['password_country_login'];

// 2. Preparamos la consulta con "?" en lugar de las variables directo
// Esto evita que un atacante inyecte código malicioso
$stmt = $mysqliConn->prepare("SELECT * FROM user WHERE user_login = ? AND password = ?");

// 3. "Enlazamos" las variables. Las "ss" significan que enviamos 2 Strings.
$stmt->bind_param("ss", $user, $password);

// 4. Ejecutamos la consulta
$stmt->execute();
$resultado = $stmt->get_result();

// 5. Verificamos si hubo coincidencia
if($resultado->num_rows > 0){
    $row = $resultado->fetch_array();
    
    $_SESSION['id_user'] = $row[0];
    $_SESSION['name_user'] = htmlspecialchars_decode($row[2]);
    $_SESSION['level_user'] = $row[5];
    $_SESSION['redirect'] = "avisos";
    
    header("Location: notificaciones.php");
    exit(); // Importante detener la ejecución después de redirigir
} else {
    header("Location: index.php?alert=1");
    exit();
}
?>
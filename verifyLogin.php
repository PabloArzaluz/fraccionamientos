<?php 
session_start();
include('configPHP/config.inc.php');

// 1. Verificamos que los datos realmente existan antes de usarlos
// El operador ?? "" asigna un string vacío si la llave no existe, evitando el Warning
$user = $_POST['email_country_login'] ?? "";
$password = $_POST['password_country_login'] ?? "";

// Si el usuario intentó entrar a este archivo sin enviar el formulario
if (empty($user) || empty($password)) {
    header("Location: index.php?alert=datos_vacios");
    exit();
}

// 2. Preparamos la consulta
$stmt = $mysqliConn->prepare("SELECT * FROM user WHERE user_login = ? AND password = ?");

// 3. Enlazamos las variables
$stmt->bind_param("ss", $user, $password);

// 4. Ejecutamos
$stmt->execute();
$resultado = $stmt->get_result();

// 5. Verificamos si hubo coincidencia
if($resultado->num_rows > 0){
    $row = $resultado->fetch_array();
    
    // Es vital regenerar el ID al iniciar sesión para evitar Session Fixation
    session_regenerate_id(true);
    
    $_SESSION['id_user'] = $row[0];
    $_SESSION['name_user'] = htmlspecialchars_decode($row[2]);
    $_SESSION['level_user'] = $row[5];
    $_SESSION['redirect'] = "avisos";
    
    // Marca de tiempo opcional para control interno (aunque uses el default)
    $_SESSION['ultimo_acceso'] = time();
    
    header("Location: notificaciones.php");
    exit(); 
} else {
    header("Location: index.php?alert=1");
    exit();
}
?>
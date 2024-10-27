<?php
$servidor = "localhost";
$usuario = "root"; // Cambia esto por tu usuario
$password = ""; // Asegúrate de que la contraseña esté vacía para el usuario root
$base_de_datos = "portal"; // Nombre de tu base de datos

// Crear la conexión
$conexion = mysqli_connect($servidor, $usuario, $password, $base_de_datos);

// Verificar la conexión
if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
} else {
    echo "";
}
?>

<?php
include '../controller/conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Preparamos la consulta en la tabla correcta
    $consulta = "SELECT * FROM peliculas WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $consulta);

    if ($stmt) {
        // Bind del parámetro
        mysqli_stmt_bind_param($stmt, "i", $id);

        // Ejecutar la consulta
        mysqli_stmt_execute($stmt);

        // Obtener el resultado
        $resultado = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($resultado) > 0) {
            $row = mysqli_fetch_assoc($resultado);
            $titulo = $row['titulo'];
            $genero = $row['genero'];
            $descripcion = $row['descripcion'];
            $trailer = $row['trailer'];
        } else {
            echo "No se encontró la película.";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error en la preparación de la consulta: " . mysqli_error($conexion);
    }
} else {
    echo "ID no proporcionado.";
}

mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo; ?></title>
    <link rel="stylesheet" href="../css/estilos.css"> <!-- Enlace a tu archivo CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <header>
        <nav class="nav">
            <a class="logo" href="../index.html"><img src="../views/img/Arf.png" alt=""></a>
            <ul class="nav_ul">
                <li><a href="../index.html">Inicio</a></li>
                <li><a href="#">Sobre Nosotros</a></li>
                <li><a href="#peliculas">Peliculas</a></li>
                <li><a href="#series">Series</a></li>
                <li><a href="#contacto">Contacto</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h1><?php echo $titulo; ?></h1>
        <div class="trailer-container">
            <?php if (!empty($trailer)) { ?>
                <iframe src="https://www.youtube.com/embed/<?php echo $trailer; ?>" allowfullscreen></iframe>
            <?php } else { ?>
                <p>Tráiler no disponible.</p>
            <?php } ?>
        </div>
        <p class="genre"><strong>Género:</strong> <?php echo $genero; ?></p>
        <p class="description"><strong>Descripción:</strong> <?php echo $descripcion; ?></p>
        <a href="../index.html" class="back-button"><i class="fas fa-arrow-left"></i> Volver</a>
    </div>

    <footer>
        <div class="footer-container" id="contacto">
            <div class="footer-logo">
                <img src="../views/img/Arf.png" alt="Logo de Arflix">
            </div>
            <div class="footer-lists">
                <ul class="footer-list">
                    <h2>Contacto</h2>
                    <li class="footer-item">
                        <p>Email: arflix@gmail.com</p>
                    </li>
                    <li class="footer-item">
                        <p>Teléfono: +54 11 5500-4321</p>
                    </li>
                </ul>
                <ul class="footer-list">
                    <h2>Navegacion</h2>
                    <li class="footer-item"><a href="#home">Inicio</a></li>
                    <li class="footer-item"><a href="#">Sobre nosotros</a></li>
                    <li class="footer-item"><a href="#peliculas">Peliculas</a></li>
                    <li class="footer-item"><a href="#series">Series</a></li>
                    
                </ul>
                <div class="footer-list social">
                    <h2>Redes Sociales</h2>
                    <div class="footer-items">
                        <a href="https://facebook.com" target="_blank">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="https://twitter.com" target="_blank">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://instagram.com" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <h2>©2024 Arflix. Todos los derechos reservados</h2>
    </footer>
</body>
</html>

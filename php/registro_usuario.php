<?php
include("conexion.php");

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$usuario = $_POST['usuario'];
$password = $_POST['password'];

$query = "SELECT * FROM usuarios WHERE usuario = ? OR correo = ?";
$stmt = mysqli_prepare($conexion, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ss", $usuario, $correo);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        echo '<script>
                alert("El usuario o el correo ya están registrados");
                window.history.go(-1);
            </script>';
        exit;
    }

    $query = "INSERT INTO usuarios(nombre, correo, usuario, password) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssss", $nombre, $correo, $usuario, $password);
        $ejecutar = mysqli_stmt_execute($stmt);
        
        if ($ejecutar) {
            echo '<script>
                    alert("Registro exitoso");
                    window.location.href = "../login.php"
                </script>';
        } else {
            echo '<script>
                    alert("Error al registrar usuario");
                    window.history.go(-1);
                </script>';
        }
    } else {
        echo '<script>
                alert("Error en la consulta de inserción");
                window.history.go(-1);
            </script>';
    }

    mysqli_stmt_close($stmt);
} else {
    echo '<script>
            alert("Error en la consulta de verificación");
            window.history.go(-1);
        </script>';
}

mysqli_close($conexion);
?>

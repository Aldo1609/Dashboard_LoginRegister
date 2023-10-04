<?php
include("conexion.php");

$usuario = $_POST['usuario'];
$password = $_POST['password'];

$query = "SELECT * FROM usuarios WHERE usuario = ? AND password = ?";
$stmt = mysqli_prepare($conexion, $query);

mysqli_stmt_bind_param($stmt, "ss", $usuario, $password);

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    echo '<script>
        window.location.href = "../index.html";
    </script>';
} else {
    echo "Usuario o contraseña incorrectos";
}

mysqli_stmt_close($stmt);
mysqli_close($conexion);
?>

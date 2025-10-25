<?php
require 'config.php';

$sql = 'SELECT * FROM departamentos';
$resultado = $conexion->query($sql);

$departamentos = [];
if ($resultado && $resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $departamentos[] = $fila;
    }
}
?>

<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Formulario Dinámico</title>
        <link rel="stylesheet" href="estilos.css">

</head>
<body>
    <h2>Registrar Empleado</h2>

    <form action='resultForm.php' method='POST'>
        <label>Nombre:</label>
        <input type='text' name='nombres' required><br><br>

        <label>Correo:</label>
        <input type='email' name='correo' required><br><br>

        <h3>Selecciona los departamentos:</h3>
        
        <?php
        if (!empty($departamentos)) {
            foreach ($departamentos as $valor) {
                $id_dep = $valor['idDep'];
                $nombre_dep = $valor['nombre'];
               echo '<label><input type="checkbox" name="departamentos[]" value="' . $id_dep . '"> ' . $nombre_dep . '</label><br>';

            }
        } else {
            echo '<p>No hay departamentos disponibles.</p>';
        }
        ?>
        <br>
        <input type='submit' value='Guardar'>
    </form>
</body>
</html>

<?php
$conexion->close();
?>



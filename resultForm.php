<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = $_POST['nombres'];
    $correo = $_POST['correo'];
    if (isset($_POST['departamentos'])) {
    $departamentos = $_POST['departamentos'];
    } else {
    $departamentos = [];
    }

    // Inserto empleado
    $sqlEmpleado = "INSERT INTO empleados (nombreEmp, correoEmp) VALUES ('$nombre', '$correo')";
    if ($conexion->query($sqlEmpleado) === TRUE) {
        $idEmp = $conexion->insert_id;

        // Inserto relación con departamentos seleccionados
        if (!empty($departamentos)) {
            foreach ($departamentos as $valor) {
                $idDep = $valor;
                $sqlRelacion = "INSERT INTO emp_dep (idEmp, idDep) VALUES ($idEmp, $idDep)";
                $conexion->query($sqlRelacion);
            }
        }

        // Muestro los resultados del registro
        echo '<h3>Empleado registrado correctamente</h3>';
        echo "<p><b>Nombre:</b> $nombre<br><b>Correo:</b> $correo</p>";

        if (!empty($departamentos)) {
            echo '<p><b>Departamentos seleccionados:</b><br></p>';
            foreach ($departamentos as $valor) {
                $idDep = $valor;
                $sqlNombre = "SELECT nombre FROM departamentos WHERE idDep = $idDep";
                $resNombre = $conexion->query($sqlNombre);
                if ($resNombre && $fila = $resNombre->fetch_assoc()) {
                    echo '- ' . $fila['nombre'] . '<br>';
                }
            }
        } else {
            echo '<p>No se seleccionaron departamentos.</p>';
        }
                     
    } else {
        echo '<p>Error al insertar empleado: ' . $conexion->error . '</p>';
    }
} else {
    echo '<p>Accede a este archivo mediante el formulario.</p>';
}

$conexion->close();
?>





<?php
require 'config.php'; // Conexión a la base de datos

// Borro los datos de la tabla si ya existen 
$conexion->query('TRUNCATE TABLE IF EXISTS emp_dep');
$conexion->query('TRUNCATE TABLE IF EXISTS empleados');

// Creo tabla empleados
$sqlTabla1 = 'CREATE TABLE empleados (
    idEmp INT AUTO_INCREMENT PRIMARY KEY,
    nombreEmp VARCHAR(100) NOT NULL,
    correoEmp VARCHAR(100) NOT NULL
);';
echo $sqlTabla1 . '</br>';
$conexion->query($sqlTabla1);

// Creo tabla emp_dep (relación entre empleados y departamentos)
$sqlTabla2 = 'CREATE TABLE emp_dep (
    idEmp INT,
    idDep INT,
    FOREIGN KEY (idEmp) REFERENCES empleados(idEmp),
    FOREIGN KEY (idDep) REFERENCES departamentos(idDep)
);';
echo $sqlTabla2 . '<br>';
$conexion->query($sqlTabla2);

echo '<h3>Tablas creadas correctamente</h3>';

$conexion->close();
?>




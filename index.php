<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Escuela";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Query para obtener los alumnos con su calificación del profesor Gaby Lua
$query_gaby_lua = "SELECT Alumno.nombre, Materia.calificacion FROM Alumno JOIN Materia
ON Alumno.ID = Materia.alumno_id JOIN Docente ON 
Materia.docente_id = Docente.ID WHERE Docente.nombre = 'Gaby Lua';";

// Query para obtener los alumnos con su calificación del profesor Felipe Morales
$query_felipe_morales = "SELECT Alumno.nombre, Materia.calificacion FROM Alumno JOIN Materia
ON Alumno.ID = Materia.alumno_id JOIN Docente ON 
Materia.docente_id = Docente.ID WHERE Docente.nombre = 'Felipe Morales';";


// Ejecutar el query de Gabby Lua
$result_gaby_lua = $conn->query($query_gaby_lua);
// Ejecutar el query para Felipe Morales
$result_felipe_morales = $conn->query($query_felipe_morales);


$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Lista de calificaciones</title>
  <style>
    table {
      border-collapse: collapse;
      width: 50%;
      margin-bottom: 20px;
    }
    th, td {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }
    th {
      background-color: #f2f2f2;
    }
  </style>
</head>
<body>

<h2>Alumnos de Gaby Lua de la materia de WEB</h2>
<table>
  <tr>
    <th>Nombre del Alumno</th>
    <th>Calificación</th>
  </tr>
  <?php
  // Mostrar resultados del query para Gaby Lua
  if ($result_gaby_lua->num_rows > 0) {
    while($row = $result_gaby_lua->fetch_assoc()) {
      echo "<tr><td>" . $row["nombre"] . "</td><td>" . $row["calificacion"] . "</td></tr>";
    }
  } else {
    echo "<tr><td colspan='2'>No se encontraron resultados.</td></tr>";
  }
  ?>
</table>

<h2>Alumnos de Felipe Morales de la materia de Graficacion</h2>
<table>
  <tr>
    <th>Nombre del Alumno</th>
    <th>Calificación</th>
  </tr>
  <?php
  // Mostrar resultados del query para Felipe Morales
  if ($result_felipe_morales->num_rows > 0) {
    while($row = $result_felipe_morales->fetch_assoc()) {
      echo "<tr><td>" . $row["nombre"] . "</td><td>" . $row["calificacion"] . "</td></tr>";
    }
  } else {
    echo "<tr><td colspan='2'>No se encontraron resultados para Felipe Morales.</td></tr>";
  }
  ?>
</table>

</body>
</html>

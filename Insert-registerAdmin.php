<?php
//ESTO SON LOS DATOS QUE VIENEN DE EL FORMULARIO REGISTER.PHP 

$Email = $_POST["Email"];
$Contraseña = $_POST["Contraseña"];

//DATOS DE LA BASE DE DATOS

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "adminproyect";

//CREATE CONNECTION

$conn = new mysqli($servername, $username, $password, $dbname);

//VERIFICAR LA CONEXION

if($conn -> connect_error){
    die("conecion fallida:" .$conn -> connect_error);
}

$sql = "INSERT INTO admin (nombre, contraseña)
VALUES ('$Email','$Contraseña')";

if ($conn->query($sql) === TRUE) {
  echo "<script>alert('Formulario enviado con éxito'); window.location.href = 'http://localhost/BackendSign-in/index.html?';</script>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
<?php
session_start();
error_reporting(0);

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

$consulta = mysqli_query($conn,"SELECT * FROM admin WHERE nombre = '$Email' AND contraseña = '$Contraseña'");

if(!$consulta){
 echo mysqli_error($mysqli);
 exit;
}

if($user = mysqli_fetch_assoc($consulta)){
    ?>
    <?php 
       include("index.html");
    ?>
    <script>
    const popup = document.querySelector('.windowModal')
    const popupContent1 = document.querySelector(".popup").innerHTML = ` <div class="error">
                    <img src="images/comprobado.png" alt="">
                    <h2 style="color:green;margin-top:50px">INICIO DE SECCION EXITOSO</h2>
                  </div>`       
    popup.style.display = 'block'
    function time (){
        window.location.href ='http://localhost/BackendSign-in/Home.html'
    }
    setTimeout(time, 3000)
    </script>
    <?php
}else{
    ?>
    <?php
     include("index.html");
     ?>
    <script>
    const popup = document.querySelector('.windowModal')
    const popupContent = document.querySelector(".popup").innerHTML = ` <div class="error">
                    <img src="images/negacion.png" alt="">
                    <h2>ACCESO DENEGADO</h2>
                    <div>
                    <p>El usuario con el que intenta ingresar no existe en nuestra base de dato puede crearse una cuenta(ADMIN) en el siguiente link: <a href="http://localhost/BackendSign-in/index.html">registrarse</a></p>
                    <ul class="lista">
                        <li>Revise que el correo electronico este bien escrito</li>
                        <li>Revise que la contraseña este bien escrito</li>
                    </ul>  
                    </div>
                   
                    <button id="closePopup">
                        Cerrar
                      </button>
                  </div>`       
    popup.style.display = 'block'
    document.getElementById("closePopup").onclick = function(){
        popup.style.display = 'none'
       window.location.href = 'http://localhost/BackendSign-in/index.html?'  
    }
    </script>

    <?php
}
$conn->close();




?>
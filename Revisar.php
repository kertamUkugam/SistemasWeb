<html>


<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <script language = "javascript">
        XMLHttpRequestObject = new XMLHttpRequest();
        XMLHttpRequestObject.onreadystatechange = function() {
            if (XMLHttpRequestObject.readyState == 4) {
                if (XMLHttpRequestObject.status == 200) {
                    document.getElementById("txtHint").innerHTML = XMLHttpRequestObject.response;

                }
            }
        }

        function pedirDatos() {
            XMLHttpRequestObject.open("POST", "VerTodoProfesor.php", true);
            XMLHttpRequestObject.send();

        }


        function añadirDatos(){

            XMLHttpRequestObject.open("POST","EditarPreguntas.php",true);
            XMLHttpRequestObject.send();

        }

        function verUsuarios(){
            XMLHttpRequestObject.open("POST","VerUsuarios.php",true);
            XMLHttpRequestObject.send();
        }

        function eliminarUsuarios(){
            XMLHttpRequestObject.open("POST","EliminarUsuario.php",true);
            XMLHttpRequestObject.send();
        }

        function DesbloquearUsuario(){
            XMLHttpRequestObject.open("POST","DesbloquearUsuario.php",true);
            XMLHttpRequestObject.send();
        }

    </script>

</head>

<body>
<h1>SELECCIONE LA OPCION DESEADA</h1>



<input type = "button" value = "Mostrar preguntas" onclick="pedirDatos()"/>

<input type = "button" value = "Editar preguntas " onclick="añadirDatos()"/>

<input type = "button" value = "Ver usuarios " onclick="verUsuarios()"/> <br><br>

<input type = "button" value = "Desbloquear usuarios " onclick="DesbloquearUsuario()"/>

<input type = "button" value = "Eliminar usuarios " onclick="eliminarUsuarios()"/>



<span class="right" ><a href="logout.php">Logout</a></span>

<br><br>
<div id="txtHint" >
    <p>Elija una de las  opciones. </p>
</div>

<br><br>

<a href="Revisar.php"><button type="button" name="inicio" id="inicio" class="form-btn" rigth="20%">Inicio</button></a>

<!--<span><a href='layout.php'>Inicio</a></span>



<?php
session_start();
if(!isset($_SESSION['email']) || $_SESSION['email'] != "web000@ehu.es") {

    header('Location: Mensajes/SoloProfesor.html');

}

echo "<br><br><br>";
echo "Bienvendio ";
echo $_SESSION['email'];
echo ".";

?>

</body>


</html>
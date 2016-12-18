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
        XMLHttpRequestObject.open("POST", "verPreguntas.php", true);
        XMLHttpRequestObject.send();

    }


    function añadirDatos(){
        XMLHttpRequestObject.open("POST","InsertarPregunta.php",true);
        XMLHttpRequestObject.send();
    }



</script>


</head>



<body>



    <input type = "button" value = "Mostrar preguntas" onclick="pedirDatos()"/>

    <input type = "button" value = "Insertar preguntas la BD" onclick="añadirDatos()"/>

    <span class="right" ><a href="logout.php">Logout</a></span>


    <div id="txtHint" >
    <p>En verdad te digo hijo mío, que aquí se verá la información que buscas. </p>
</div>

<br><br><br>

    <a href="GestionPreguntas.php"><button type="button" name="inicio" id="inicio" class="form-btn" rigth="20%">Inicio</button></a>

    <!--<span><a href='layout.php'>Inicio</a></span>


<?php
session_start();
if(!isset($_SESSION['email']) || $_SESSION['email'] == "web000@ehu.es") {

    header('Location: Mensajes/NoLogeado.html');

}

echo "<br><br><br>";
echo "Bienvendio ";
echo $_SESSION['email'];
echo ".";
?>

</body>


</html>
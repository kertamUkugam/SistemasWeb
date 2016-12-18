<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">


<html>
<head>

</head>

<body>

<form action="InsertarPregunta.php" method="post">
    <h2>AÑADIR PREGUNTA </h2>
    <p> Pregunta    : <input type="text" required name="pregunta"  size="50" />
    <p> Respuesta : <input type="text" required name="respuesta" size="48" />
    <p> Comprejidad: <select name="complejidad">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

    <br>

        <br>            <br>

        <button type="submit" name="submit" id="submit" >Enviar pregunta</button>

            <br>            <br>
        <br>




</form>




<?php
session_start();

if(isset($_POST["pregunta"])) {


    $link = mysqli_connect("mysql.hostinger.es","u461050408_usr","Prueba1","u461050408_quiz");
    //$link = mysqli_connect("localhost","root","","Quiz");




    if (!$link) {
        echo "error en conexion. <br/>";
    } else {

        echo "Conexion establecida. <br/>";

        $pregunta = $_POST["pregunta"];
        $respuesta = $_POST["respuesta"];
        $complejidad = $_POST["complejidad"];

        $email = $_SESSION['email'];
        $password = $_SESSION['password'];
        //$PassEnc=sha1($password);





        if ($pregunta == "") {
            echo "Pregunta incorrecta, campo vacio.<br/>";
        } else if ($respuesta == "") {
            echo "Respuesta incorrecta, campo vacio.<br/>";
        } else{

            $sql = "SELECT * FROM Usuario WHERE Email='$email' and Password='$password'";
            $query = mysqli_query($link, $sql);
            $existe = mysqli_num_rows($query);

            if ($existe == 1) {

                $cont = mysqli_num_rows(mysqli_query($link, "SELECT * FROM Preguntas"));
                $cont++;

                $sql = "INSERT INTO Preguntas (Numero,Pregunta,Respuesta, Complejidad, Usuario) VALUES ('$cont','$pregunta','$respuesta','$complejidad','$email')";



                if (!mysqli_query($link, $sql)) {
                    die('Error: ' . mysqli_error($link));
                }


                echo " Pregunta introducida correctamente. <br />";
                echo"<a href=\"GestionPreguntas.php\"><button type=\"button\" name=\"inicio\" id=\"inicio\" class=\"form-btn\" rigth=\"20%\">Inicio</button></a>";



                mysqli_close($link);

                echo "<br>";


                echo "<br>";

                echo "<a href='VerPreguntas.php'>Ver preguntas de la BD</a>";
                echo "<br>";

            } else {
                echo "DATOS INCORRECTOS.";
            }


        }

    }

}

?>








</body>

</html>

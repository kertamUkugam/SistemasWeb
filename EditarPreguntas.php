<html>


<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

</head>

<body>
<form method="POST" id="editar" action="EditarPreguntas.php">
    <h2>Modifique la pregunta deseada </h2>
    <p> Codigo  : <input type="text" required name="codigo" value="" />
    <p> Pregunta : <input type="text" required name="pregunta"  value="" />
    <p> Respuesta: <input type="text" required name="respuesta"value="" />
    <p> Comprejidad: <select name="complejidad">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <input type="submit" value="Modificar"/>
</form>

<div id="txtHint">
</div>



<?php
session_start();
if(!isset($_SESSION['email']) || $_SESSION['email'] != "web000@ehu.es") {

    header('Location: layout.php');

}
if(isset($_POST['codigo'])){
    $codigo=$_POST['codigo'];
    $pregunta=$_POST['pregunta'];

    $respuesta=$_POST['respuesta'];
    $complejidad=$_POST['complejidad'];

    $connect=mysqli_connect("mysql.hostinger.es","u461050408_usr","Prueba1","u461050408_quiz");

   // $connect=mysqli_connect("localhost","root","","Quiz");

    $sql="SELECT * FROM Preguntas WHERE Numero='$codigo'";

    $resultado=mysqli_query($connect,$sql);

    $contador=mysqli_num_rows($resultado);
    if($contador!=1){
        echo"Codigo erroneo.";
    }
    else{
        if(strlen($pregunta)<3||strlen($respuesta)==0||strlen($complejidad)==0){
            echo "Error al modificar. Revise.";
        }
        else{
            $sql="UPDATE Preguntas SET pregunta='$pregunta',respuesta='$respuesta', 
			complejidad='$complejidad' WHERE Numero='$codigo'";
            if(!mysqli_query($connect,$sql)){

                die('Error: ' .mysqli_error($connect));
            }
            else{
                echo "Pregunta actualizada correctamente.";
                echo"<a href=\"Revisar.php\"><button type=\"button\" name=\"inicio\" id=\"inicio\" class=\"form-btn\" rigth=\"20%\">Inicio</button></a>";
            }
        }
    }
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">


</head>

<body>


<form method="POST" id="editar" action="EliminarUsuario.php">
    <h2>Introduzca el email del usuario que desea eliminar </h2>
    <p> Email  : <input type="text" required name="email" value="" />
        <input type="submit" value="Eliminar"/>
</form>

<div id="txtHint">
</div>



<?php
/**
 * Created by PhpStorm.
 * User: Vahe
 * Date: 18/12/2016
 * Time: 20:08
 */
session_start();
if(!isset($_SESSION['email']) || $_SESSION['email'] != "web000@ehu.es") {

    header('Location: layout.php');

}
if(isset($_POST['email'])){
    $email=$_POST['email'];

    $connect=mysqli_connect("mysql.hostinger.es","u461050408_usr","Prueba1","u461050408_quiz");

   // $connect=mysqli_connect("localhost","root","","Quiz");

    $sql="SELECT * FROM Usuario WHERE Email='$email'";

    $resultado=mysqli_query($connect,$sql);

    $contador=mysqli_num_rows($resultado);
    if($contador!=1){
        echo"Email erroneo.";
    }
    else{

            $sql="DELETE FROM usuario WHERE Email = '$email'";
            if(!mysqli_query($connect,$sql)){

                die('Error: ' .mysqli_error($connect));
            }
            else{
                echo "Usuario eliminado correctamente.";
                echo"<a href=\"Revisar.php\"><button type=\"button\" name=\"inicio\" id=\"inicio\" class=\"form-btn\" rigth=\"20%\">Inicio</button></a>";

            }
        }

}





?>

</body>

</html>

<html>


<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <script language = "javascript">

    </script>

</head>

<body>

<form  action="RecuperarPass.php" method="post" id='registro' name='recPass'  enctype="multipart/form-data">
    <div class="column">

            <h1>Recuperar contraseña</h1>

            <li>
                <label for="email" id="mail">Direccion de correo<span>*</span>:</label><br>
                <input type="text" name="email" id="email" class="form-input">
            </li>
        <li>
            <label for="frase" id="mail">Frase con la que te identificaste al registrarte <span>*</span>:</label><br>
            <input type="text" name="frase" id="frase" class="form-input">
        </li>

            <li>
                <label for="password" id="pass">Password<span>*</span>:</label><br>
                <input type="password" name="password" id="password" class="form-input">
            </li>
            <li>
                <label for="password2" id="pass2">Repetir password<span>(*)</span>:</label><br>
                <input type="password" name="password2" id="password2" class="form-input"><br><br>
            </li>


        </ul>


        <a href= "layout.php" <button type="button" id = "inicio" class="form-btn">Inicio</a></button>


        <button type="submit" name="boton" id="enviar" class="form-btn">Enviar</button>
    </div>

</form>






<?php

require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');




if (isset($_POST['email'])) {

    $link = mysqli_connect("mysql.hostinger.es","u461050408_usr","Prueba1","u461050408_quiz");

   // $link = mysqli_connect("localhost", "root", "", "Quiz");


    if (!$link) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $soapclient2 = new nusoap_client('http://sistemaswebv.hol.es/Lab6_SW/ServicioComprobarPass.php?wsdl', true);


    echo "conexion establecida. <br />";
    $email = $_POST ['email'];
    $frase = $_POST ['frase'];
    $pas = $_POST['password'];
    $pas2 = $_POST['password2'];



    $res = $soapclient2->call('compPs', array('pass' => $pas));

    if($pas!=$pas2){
        echo "<br/>";
        echo "Las contraseñas no coinciden.";
        echo "<br/>";
    }else if (strcmp($res, "VALIDA") != 0) {
        echo "<br/>";
        echo "Password hackeable por mi abuela.";
        echo "<br/>";
        echo $res;
    }else{


        $password = sha1($pas);


        $sql = "SELECT * FROM usuario WHERE Email='$email' and Frase='$frase'";

        $query = mysqli_query($link, $sql);

        $existe = mysqli_num_rows($query);
        if ($existe == 1) {
            //$sql = "UPDATE usuario SET Password='$password' WHERE Email='$email'";

            $sql="UPDATE Usuario SET Password='$password' WHERE Email='$email' AND Frase = '$frase'";
            if (!mysqli_query($link, $sql)) {
                die('Error: ' . mysqli_error($link));
            }



            echo "Contraseña actualizada. <br />";

        }
        mysqli_close($link);


    }


}

?>

</body>


</html>
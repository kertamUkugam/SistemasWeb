<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">


<html>
<head>

    <meta http-equiv="Content-Type"  content="text/html; charset=utf-8"/>

    <title>Registro</title>



    <script type="text/javascript" src="JS/FormularioValido.js"></script>




    <style type="text/css">
        #submit {
        }
    </style>

</head>
<body>


<h1>Registro de usuario</h1>
<br>


<form action="registro.php" method="post" id='registro' name='registro'  onsubmit="return verificar()" enctype="multipart/form-data"  >

    <div class="column">

    <label>Nombre y apellidos*</label>
    <br>

    <input type="text"  id="nombre" name="nombre" />
    <br>

    <label>Email*             </label>
    <br>

    <input type="text" id="email" name="email"  />
    <br>

    <label>Password*         </label>    <br>

    <input type="password" id="password" name="password"  />
    <br>

    <label>Repetir contraseña*         </label>    <br>

    <input type="password" id="password2" name="password2"  />
    <br>

    <label>Numero de telefono*</label>
    <br>

    <input type="text" id="numero" name="numero"  />
    <br>

    <label for="especialidad">Especialidad*</label></br>

    <select name="especialidad" id="especialidad" onchange='revisaresp(this)'>
        <option>-  Software  -</option>
        <option>-  Hardware  -</option>
        <option>-  Computación  -</option>
        <option>-  Otra  -</option>
    </select>
    <br>
    <br>

    <label>Frase de seguridad*</label>
    <br>
    <input type="text"  id="frase" name="frase"> Esto servirá para restablecer tu contraseña.</input>
    <br>
    <br>        <br>


    </div>

    <div class="column">

        <li>
                Select image to upload: <br>
                <input type="file" name="fileToUpload" id="fileToUpload">

        </li>

    <br>
    <br>
        </div>

    <button type="submit" name="submit" id="submit" >Submit</button>


    <a href= "layout.php" <button type="button" id = "volver" class="return">Inicio</a></button>

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

    $soapclient = new nusoap_client('http://cursodssw.hol.es/comprobarmatricula.php?wsdl', true);
    $soapclient2 = new nusoap_client('http://sistemaswebv.hol.es/Lab6_SW/ServicioComprobarPass.php?wsdl', true);


    echo "conexion establecida. <br />";

    $nombre = $_POST ['nombre'];
    $email = $_POST ['email'];
    $password = $_POST ['password'];
    $password2 = $_POST ['password2'];
    $numero = $_POST ['numero'];
    $especialidad = $_POST ['especialidad'];
    $frase = $_POST ['frase'];



    $compEmail = $soapclient->call('comprobar', array('x' => $email));
    $res = $soapclient2->call('compPs', array('pass' => $password));

    $filtro_num = "/^[6-9]/";

    $PassEnc = sha1($password);


    if (strcmp($res, "VALIDA") != 0) {
        echo "<br/>";
        echo "Password hackeable por mi abuela.";
        echo "<br/>";
        echo $res;


    } else if (strcmp($password, $password2) != 0) {
        echo "<br/>";
        echo "Las contraseñas no coinciden";
        echo "<br/>";


    } else if (strcmp($compEmail, "SI") != 0) {
        echo "<br/>";
        echo "El usuario no pertenece a este curso.";
        echo "<br/>";

    } else if (strlen($nombre) < 3) {
        echo "Error en el nombre";

    } else if (strlen($frase) < 5) {
        echo "Error en la frase de seguridad";



    } else if (!preg_match($filtro_num, $numero) | strlen($numero) != 9) {
        echo "Numero erroneo";


    } else {

        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);


        if($_FILES["fileToUpload"]["tmp_name"]) {
            $archy = $_FILES["fileToUpload"]["tmp_name"];

            $fp = fopen($archy, 'r');
            $data = fread($fp, filesize($archy));
            $data = addslashes($data);
            fclose($fp);


        $sql = "INSERT INTO Usuario (Nombre, Email, Password, Telefono , Especialidad, Foto, Frase) VALUES ('$nombre','$email','$PassEnc','$numero','$especialidad','$data','$frase')";


        if (!mysqli_query($link, $sql)) {
            die('Error: ' . mysqli_error($link));
        }
        }else{
            $sql = "INSERT INTO Usuario (Nombre, Email, Password, Telefono , Especialidad, Frase) VALUES ('$nombre','$email','$PassEnc','$numero','$especialidad','$frase')";


            if (!mysqli_query($link, $sql)) {
                die('Error: ' . mysqli_error($link));
            }

        }

        echo "1 record added";


        mysqli_close($link);
        echo "<br>";


        echo "<br>";


    }
}
?>


</body>




</html>

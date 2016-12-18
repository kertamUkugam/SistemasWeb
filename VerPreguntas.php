<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">


</head>

<body>




<?php
$connect=mysqli_connect("mysql.hostinger.es","u461050408_usr","Prueba1","u461050408_quiz");
//$connect = mysqli_connect("localhost","root","","Quiz");



if ($connect) {
    $sql = "SELECT * FROM Preguntas";
    $link = mysqli_query($connect,$sql);
    echo '<table border=1> <tr> <th> ID  </th> <th> PREGUNTA </th>  <th> COMPLEJIDAD </th> <th> USUARIO </th> </tr>';


    while($info = mysqli_fetch_array($link)) {
        // echo"<br>";
        echo '<tr> 
    		<td><width size="150">' .$info["Numero"]. '</td> 
    		<td><width size="150">' .$info["Pregunta"]. '</td> 
    		<td><width size="150">' .$info["Complejidad"]. '</td> 
    		<td><width size="150">' .$info["Usuario"].'</td> 
    		</tr>';

    }
    echo '</table>';
}


session_start();



if (session_status() == PHP_SESSION_ACTIVE) {

    $mail = $_SESSION['email'];


    if ($mail != NULL) {

        $sql = "SELECT * FROM Preguntas WHERE Usuario='$mail'";
        $sth = $connect->query($sql);
        $cont1 = $sth->num_rows;


        $sql = "SELECT * FROM Preguntas";
        $sth = $connect->query($sql);
        $cont2 = $sth->num_rows;

        $sth->close();
        $link->close();
        echo "<br>";

        echo "Preguntas insertadas por usted: ";
        echo $cont1;
        echo "<br>";
        echo "Preguntas totales en el servidor: ";
        echo $cont2;
        echo "<br>";


    }
}
mysqli_close($connect);
?>

<br>
<br>
</body>

</html>
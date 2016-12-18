<?php
session_start();
if(!isset($_SESSION['email']) || $_SESSION['email'] != "web000@ehu.es") {

    header('Location: layout.php');

}


$connect=mysqli_connect("mysql.hostinger.es","u461050408_usr","Prueba1","u461050408_quiz");
//$connect = mysqli_connect("localhost","root","","Quiz");



if ($connect) {
    $sql = "SELECT * FROM Preguntas";
    $link = mysqli_query($connect,$sql);
    echo '<table border=1> <tr> <th> ID  </th> <th> PREGUNTA </th> <th> RESPUESTA </th> <th> COMPLEJIDAD </th> <th> USUARIO </th> </tr>';


    while($info = mysqli_fetch_array($link)) {
        // echo"<br>";
        echo '<tr> 
    		<td><width size="150">' .$info["Numero"]. '</td> 
    		<td><width size="150">' .$info["Pregunta"]. '</td> 
    	    <td><width size="150">' .$info["Respuesta"]. '</td> 
    		<td><width size="150">' .$info["Complejidad"]. '</td> 
    		<td><width size="150">' .$info["Usuario"].'</td> 
    		</tr>';

    }
    echo '</table>';
    $link->close();
}
mysqli_close($connect);
?>

<br>
<br>

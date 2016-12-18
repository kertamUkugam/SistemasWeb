<?php



$connect=mysqli_connect("mysql.hostinger.es","u461050408_usr","Prueba1","u461050408_quiz");


//$connect = mysqli_connect("localhost","root","","Quiz");



if ($connect) {
    $sql = "SELECT * FROM Usuario";
    $usuarios = mysqli_query($connect, $sql);


    $usuarios = mysqli_query($connect, "SELECT * FROM `usuario`");
    echo '
		    <table border=1>
		    <tr> 
		        <th> NOMBRE </th>
		        <th> EMAIL </th>
		        <th> TELEFONO </th>
		        <th> ESPECIALIDAD </th>

		    </tr>';
    while ($info = mysqli_fetch_array($usuarios)) {
        echo '
		        <tr>
		            <td>' . $info['Nombre'] . ' </td>
		            <td>' . $info['Email'] . '</td>
		            <td>' . $info['Telefono'] . '</td>
		            <td>' . $info['Especialidad'] . '</td>
		            
		        </tr>';

        if ($info['Foto'] == NULL) {

            echo '<td><p align="center"><img heigth="50%" width="50%" src="img/Unknown.png"/></p></td></tr>';

        } else {

            echo '<td><p align="center"><img heigth="50%" width="50%" src="data:jpeg;base64,' . base64_encode($info['Foto']) . '"/></p></td></tr>';
        }
    }
    echo '</table> </br>
';
    $usuarios->close();
    mysqli_close($connect);

}

?>

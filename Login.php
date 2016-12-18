<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8"/>
<link rel="stylesheet"
      href="estilos/loginStyle.css"/>

</head>

<body>

<h2>LA GRAN PUERTA DE ACCESO</h2>

<form action="Login.php" method="post">
    <div class="imgcontainer">
        <img src="img/img_login.jpg" alt="Avatar" class="avatar">
    </div>

    <div class="container">
        <label><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="uname" required>

        <label><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>

        <button type="submit">Login</button>
    </div>

    <div class="container" style="background-color:#f1f1f1">

         <a href= "layout.php" <button type="button" class="return">Inicio</a></button>

        <a href= "recuperarpass.php" <button type="button" class="return">¿No te acuerdas de tu contraseña?</a></button>






    </div>
</form>



<?php


if (isset($_POST["uname"])) {

    $link = mysqli_connect("mysql.hostinger.es","u461050408_usr","Prueba1","u461050408_quiz");
    //$link = mysqli_connect("localhost","root","","Quiz");



    if (!$link) {
        die("Connection failed: " . mysqli_connect_error());
    }else {
        session_start();





        $email = $_POST ['uname'];

        $password = $_POST ['psw'];

        $PassEnc=sha1($password);


        $sql="SELECT * FROM Usuario WHERE Email='$email' and Password='$PassEnc'";
        $bloq = "SELECT * FROM Usuario WHERE Email='$email' and Bloqueo >'2'";


        $blq = "SELECT Bloqueo FROM Usuario WHERE Email='$email'";
        $conn = mysqli_query($link,$blq);
        $info = mysqli_fetch_array($conn);
        $cont = $info["Bloqueo"];



        $query =mysqli_query($link,$sql);
        $query2 =mysqli_query($link,$bloq);

        $existe=mysqli_num_rows($query);
        $existe2 = mysqli_num_rows($query2);
        if($existe==1 && $existe2 <1 ){
            $_SESSION['email']=$email;
            $_SESSION['password']=$PassEnc;

            $sql = "UPDATE usuario SET Bloqueo='0' WHERE email='$email'";
            if (!mysqli_query($link, $sql)) {
                die('Error: ' . mysqli_error($link));
            }

            if(strcmp($email,"web000@ehu.es")==0){
                header('Location: Revisar.php');

            }else{
                header('Location: GestionPreguntas.php');

            }

        }
        else{
            $cont++;
            echo '<script language="javascript">alert("Error de acceso");</script>';
            $sql = "UPDATE usuario SET Bloqueo='$cont' WHERE email='$email'";
            if (!mysqli_query($link, $sql)) {
                die('Error: ' . mysqli_error($link));
            }

        }

        if($cont ==3){

            echo "Intentos máximos superados, cuenta bloqueada. <br>";
            echo "Para desbloquear su cuenta contacte con su profesor. <br>";

        }



        mysqli_close($link);
    }

}



?>




</body>
</html>

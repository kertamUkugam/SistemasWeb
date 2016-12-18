

<spam><a href='layout.php'>Inicio</a></spam>

<?php


echo '<table border=1> <tr> <th> PREGUNTA </th> <th> COMPLEJIDAD </th> <th> TEMATICA </th>';
$preguntas=simplexml_load_file("preguntas.xml");

foreach($preguntas->xpath("//assessmentItem")as $quest) {
    echo '<tr> 
    		<td><span style="color:rgba(2, 0, 2, 0.66)"size="3">' .$quest->itemBody->p. '</td> 
    		<td><span style="color:rgb(161, 9, 17)"size="3">' .$quest["complexity"]. '</td> 
    		<td><span style="color:rgba(4, 3, 160, 0.66)" size="3">' .$quest["subject"]. '</td>  
    		</tr>';

}
echo '</table>';


?>
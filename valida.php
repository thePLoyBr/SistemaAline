<h1>entrou no valida</h1>
<?php 

if(strcasecmp('formulario-ajax', $_POST['metodo']) == 0 ){
	$html = $_POST['nome'];

	echo "$html";
 ?>}


<?php 

include 'conexao.php';

$nome = $_POST['nome'];
$marca = $_POST['marca'];
$metodo = $_POST['metodo'];

if($metodo == 'salvar'){

$sql = mysqli_query($conn, "INSERT INTO tb_esmalte (nome_esmalte, marca_esmalte,dt_entrada) VALUES ('$nome','$marca',NOW())");
listarDados($conn);
}

function listarDados($conn){
	$query = mysqli_query($conn, "SELECT * FROM tb_esmalte");
	
	while ($dados = mysqli_fetch_assoc($query)) {
		echo '<table border="1"><tr><td>' .$dados['nome_esmalte'].'</td>'.'<td>'.$dados['marca_esmalte'].'</td></tr></table>';
	}
}

?>

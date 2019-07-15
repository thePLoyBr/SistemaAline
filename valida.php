<?php 

include 'conexao.php';

$nome = $_POST['nome'];
$marca = $_POST['marca'];
$metodo = $_POST['metodo'];


if($metodo == 'salvar'){
$sql = mysqli_query($conn, "INSERT INTO tb_esmalte (nome_esmalte, marca_esmalte,dt_entrada) VALUES ('$nome','$marca',NOW()");
$query = mysqli_query($conn, "SELECT * FROM tb_esmalte");


while ($dados = mysqli_fetch_assoc($query)) {
?> <table border="1" style="border-collapse: collapse">
	    <tr>
	    <td>Exluir</td>
	    
	    <?php echo "<td>".$dados["id_esmalte"]."</td>" . "<td>".$dados["nome_esmalte"]."</td>" . "<td>".$dados["dt_entrada"]."</td>".   "<td>".$dados["marca_esmalte"]."</td>" . "</tr><br>";
	        }
	        ?>
	</table>
<?php

echo "Esmalte cadastrado com sucesso!";

} else if($metodo == 'excluir') {
	echo "EXCLUIR";
} elseif ($metodo == 'alterar') {
	echo "ALTERAR";
} else {
	echo "Método Incompatível";
}

 ?>


<?php

include 'conexao.php';
if (isset($_POST['status'])){
    listarDados($conn);
} else {
    $nome = $_POST['nome'];
    $marca = $_POST['marca'];
    $metodo = $_POST['metodo'];
    
    if ($metodo == 'cadastrar') {
        $sql = mysqli_query($conn, "INSERT INTO tb_esmalte (nome_esmalte, marca_esmalte,dt_entrada) VALUES ('$nome','$marca',NOW())");
        listarDados($conn);
    } elseif ($metodo == 'excluir'){
        echo ('vc entrou no excluir');
    }
}


function listarDados($conn){
	$query = mysqli_query($conn, "SELECT * FROM tb_esmalte");

	while ($dados = mysqli_fetch_assoc($query)) {
        echo"<table border='1'><tr> <td><input type='checkbox' id='check'></td>
                                    <td id='colunaid'>{$dados['id_esmalte']}</td>
                                    <td id='colunanome'>{$dados['nome_esmalte']}</td>
                                    <td id='colunamarca'>{$dados['marca_esmalte']}</td>
                                    <td id='colunadata'>{$dados['dt_entrada']}</td>
                                </tr></table>";

	}
}
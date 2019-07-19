
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

    echo("<table border='1'> <th>Selecionar</th> <th>ID</th> <th>Nome</th> <th>Marca</th> <th>Data</th>");
	while ($dados = mysqli_fetch_assoc($query)) {
        echo"                   <tr><td><input type='checkbox' class='check'></td>
                                    <td class='colunaid'>   {$dados['id_esmalte']}      </td>
                                    <td id='colunanome'>    {$dados['nome_esmalte']}    </td>
                                    <td id='colunamarca'>   {$dados['marca_esmalte']}   </td>
                                    <td id='colunadata'>    {$dados['dt_entrada']}      </td>
                                </tr>";
    }
    echo ("</table>");
}
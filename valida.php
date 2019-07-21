
<?php

include 'conexao.php';
if (isset($_POST['status'])){
    listarDados($conn);
} else {
    $metodo = $_POST['metodo'];
    
    if ($metodo == 'cadastrar') {
        $nome   = $_POST['nome'];
        $marca  = $_POST['marca'];
        $sql = mysqli_query($conn, "INSERT INTO tb_esmalte (nome_esmalte, marca_esmalte,dt_entrada) VALUES ('$nome','$marca',NOW())");
        listarDados($conn);
    } elseif ($metodo == 'excluir'){
        $id     = $_POST['id'];
        $sql = mysqli_query($conn,"DELETE FROM tb_esmalte WHERE id_esmalte=$id");
        listarDados($conn);
    } elseif($metodo == 'alterar'){
        $id     = $_POST['id'];
        $nome   = $_POST['nome'];
        $marca  = $_POST['marca'];
        $sql = mysqli_query($conn, "UPDATE tb_esmalte SET nome_esmalte='$nome', marca_esmalte='$marca' WHERE id_esmalte=$id");
        listarDados($conn);
    }
}


function listarDados($conn){
	$query = mysqli_query($conn, "SELECT * FROM tb_esmalte");

    echo("<table border='1'> <th>Selecionar</th> <th>ID</th> <th>Nome</th> <th>Marca</th> <th>Data</th>");
	while ($dados = mysqli_fetch_assoc($query)) {
        echo"   <tr>
                    <td><input type='checkbox' value='{$dados['id_esmalte']}' class='check'></td>
                    <td>                              {$dados['id_esmalte']}      </td>
                    <td id='colunanome'>              {$dados['nome_esmalte']}    </td>
                    <td id='colunamarca'>             {$dados['marca_esmalte']}   </td>
                    <td id='colunadata'>              {$dados['dt_entrada']}      </td>
                </tr>";
    }
    echo ("</table>");
}
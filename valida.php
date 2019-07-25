
<?php

include 'conexao.php';
if (isset($_POST['status'])){
    listarDados($conn);
} else {
    $metodo = isset($_POST['metodo']) ? $_POST['metodo'] : null;
    

    if ($metodo == 'cadastrar') {
        $nome   = isset ( $_POST['nome'] ) ? $_POST['nome'] : " Nenhum Nome ";
        $marca  = isset ( $_POST['marca'] ) ? $_POST['marca'] : " Nenhuma Marca ";
        $arquivo = isset ( $_FILES['imagem'] ) ? $_FILES['imagem'] : " Nenhuma Imagem ";
        
        if ( isset( $_FILES['imagem'] ) ){
            $nomeImagem = $arquivo['name'];
            $tiposPermitidos = ['jpg' , 'jpeg' , 'png' , 'bmp'];
            $tamanho = $arquivo['size'];
            $extensao = explode('.' , $nomeImagem);
            $extensao = end($extensao);
            $novoNome = rand() . "- $nomeImagem";
            if(in_array($extensao, $tiposPermitidos) ) {
                if($tamanho > 1e+6) {
                    echo('Arquivo muito grande: Tamanho máximo: 1MB');
                } else{
                    $mover = move_uploaded_file($_FILES['imagem']['tmp_name'], '_imagens/' . $novoNome);
                }
            }else {
                echo('Tipo de arquivo não permitido');
            }
        }
        
        $sql = mysqli_query($conn, "INSERT INTO tb_esmalte (nome_esmalte, marca_esmalte,dt_entrada,foto_esmalte) VALUES ('$nome','$marca',NOW(),'$novoNome')");
        listarDados($conn);
    } elseif ($metodo == 'excluir'){
        $id     = isset ( $_POST['id'] ) ? $_POST['id'] : " Nenhum ID ";
        $sql = mysqli_query($conn,"DELETE FROM tb_esmalte WHERE id_esmalte=$id");
        listarDados($conn);
    } elseif($metodo == 'alterar'){
        $id     = isset ( $_POST['id'] ) ? $_POST['id'] : " Nenhum ID ";
        $nome   = isset ( $_POST['nome'] ) ? $_POST['nome'] : " Nenhum Nome ";
        $marca  = isset ( $_POST['marca'] ) ? $_POST['marca'] : " Nenhuma Marca ";
        $arquivo = isset ( $_FILES['imagem'] ) ? $_FILES['imagem'] : " Nenhuma Imagem ";
        
        if ( isset( $_FILES['imagem'] ) ){
            $nomeImagem = $arquivo['name'];
            $tiposPermitidos = ['jpg' , 'jpeg' , 'png' , 'bmp'];
            $tamanho = $arquivo['size'];
            $extensao = explode('.' , $nomeImagem);
            $extensao = end($extensao);
            $novoNome = rand() . "- $nomeImagem";
            if(in_array($extensao, $tiposPermitidos) ) {
                if($tamanho > 1e+6) {
                    echo('Arquivo muito grande: Tamanho máximo: 1MB');
                } else{
                    $mover = move_uploaded_file($_FILES['imagem']['tmp_name'], '_imagens/' . $novoNome);
                }
            }else {
                echo('Tipo de arquivo não permitido');
            }
        }

        $sql = mysqli_query($conn, "UPDATE tb_esmalte SET nome_esmalte='$nome', marca_esmalte='$marca', foto_esmalte='$novoNome' WHERE id_esmalte=$id");
        listarDados($conn);
    }
}


function listarDados($conn){
	$query = mysqli_query($conn, "SELECT * FROM tb_esmalte");

    echo("<table border='1'> <th>Selecionar</th> <th>ID</th> <th>Nome</th> <th>Marca</th> <th>Data</th> <th>Imagem</th>");
	while ($dados = mysqli_fetch_assoc($query)) {
        echo"   <tr>
                    <td><input type='checkbox' value='{$dados['id_esmalte']}' class='check'></td>
                    <td>                              {$dados['id_esmalte']}      </td>
                    <td>                              {$dados['nome_esmalte']}    </td>
                    <td>                              {$dados['marca_esmalte']}   </td>
                    <td>                              {$dados['dt_entrada']}      </td>
                    <td>                              <img src='_imagens/{$dados['foto_esmalte']}' width='100px'/>      </td>
                                  
                </tr>";
    }
    echo ("</table>");
    mysqli_close($conn);
}

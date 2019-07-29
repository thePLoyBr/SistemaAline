
<?php

include 'conexao.php';
if (isset($_POST['status'])){
    listarDados($conn);
} else {
    $metodoCadastrar = isset($_POST['metodoCadastrar']) ? $_POST['metodoCadastrar'] : null;
    $metodoAlterar = isset($_POST['metodoAlterar']) ? $_POST['metodoAlterar'] : null;
    $metodoExcluir = isset($_POST['metodoExcluir']) ? $_POST['metodoExcluir'] : null;
    

    if ($metodoCadastrar == 'cadastrar') {
        $nome   = isset ( $_POST['nome'] ) ? $_POST['nome'] : " Nenhum Nome ";
        $marca  = isset ( $_POST['marca'] ) ? $_POST['marca'] : " Nenhuma Marca ";
        
        
        if ( isset( $_FILES['imagem']) ){
            $arquivo = isset ( $_FILES['imagem'] ) ? $_FILES['imagem'] : null;
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
                    $sql = mysqli_query($conn, "INSERT INTO tb_esmalte (nome_esmalte, marca_esmalte,dt_entrada,foto_esmalte) VALUES ('$nome','$marca',NOW(),'$novoNome')");
                }
            }else {
                $sql = mysqli_query($conn, "INSERT INTO tb_esmalte (nome_esmalte, marca_esmalte,dt_entrada,foto_esmalte) 
                VALUES ('$nome','$marca',NOW(),'logo.png')");
            }
        }
        
        listarDados($conn);
    } elseif ($metodoExcluir == 'excluir'){
        $id     = isset ( $_POST['id'] ) ? $_POST['id'] : " Nenhum ID ";
        $sql = mysqli_query($conn,"DELETE FROM tb_esmalte WHERE id_esmalte=$id");
        listarDados($conn);
    } elseif($metodoAlterar == 'alterar'){
        $id     = isset ( $_POST['idAlterar'] ) ? $_POST['idAlterar'] : " Nenhum ID ";    
        $nome   = isset ( $_POST['nomeAlterar'] ) ? $_POST['nomeAlterar'] : " Nenhum Nome ";
        $marca  = isset ( $_POST['marcaAlterar'] ) ? $_POST['marcaAlterar'] : " Nenhuma Marca ";
        var_dump($nome);        
        var_dump($marca);        
        var_dump($id);        

        if ( isset($_FILES['imagemAlterar']) ){
            $arquivo = isset ( $_FILES['imagemAlterar'] ) ? $_FILES['imagemAlterar'] : null;
            var_dump($arquivo);
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
                $sql = mysqli_query($conn, "UPDATE tb_esmalte SET nome_esmalte='$nome', marca_esmalte='$marca', foto_esmalte='$novoNome' WHERE id_esmalte=$id");
            }
        } else{
            echo('Imagem não setada');
            $sql = mysqli_query($conn, "UPDATE tb_esmalte SET nome_esmalte='$nome', marca_esmalte='$marca', foto_esmalte='logo.png' WHERE id_esmalte=$id");
        }

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

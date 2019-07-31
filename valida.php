
<?php

include 'conexao.php';
if (isset($_POST['status'])) {
    listarDados($conn);
} else {
    $metodo = isset($_POST['metodo']) ? $_POST['metodo'] : null;
    if ($metodo == 'cadastrar') {
        $nome   = isset($_POST['nome']) ? $_POST['nome'] : " Nenhum Nome ";
        $marca  = isset($_POST['marca']) ? $_POST['marca'] : " Nenhuma Marca ";
        $estado = isset($_POST['estado']) ? $_POST['estado'] : "Nenhum estado";

        if (isset($_FILES['imagem'])) {
            $arquivo = isset($_FILES['imagem']) ? $_FILES['imagem'] : null;
            $nomeImagem = $arquivo['name'];
            $tiposPermitidos = ['jpg', 'jpeg', 'png', 'bmp'];
            $tamanho = $arquivo['size'];
            $extensao = explode('.', $nomeImagem);
            $extensao = end($extensao);
            $novoNome = rand() . "- $nomeImagem";
            if (in_array($extensao, $tiposPermitidos)) {
                if ($tamanho > 1e+6) {
                    echo ("<script>'Arquivo muito grande: Tamanho máximo: 1MB'</script>");
                } else {
                    $mover = move_uploaded_file($_FILES['imagem']['tmp_name'], '_imagens/' . $novoNome);
                    $sql = mysqli_query($conn, "INSERT INTO tb_esmalte (nome_esmalte, marca_esmalte,dt_entrada,foto_esmalte, usado)
                                                VALUES ('$nome','$marca',NOW(),'$novoNome',$estado)");
                }
            } else {
                echo ("<script>alert('Extensão de arquivo não permitida')</script>");
            }
        } else {

            $sql = mysqli_query($conn, "INSERT INTO tb_esmalte (nome_esmalte, marca_esmalte,dt_entrada,foto_esmalte) 
                                        VALUES ('$nome','$marca',NOW(),'logo.png')");
        }

        listarDados($conn);
    } elseif ($metodo == 'excluir') {
        $id     = isset($_POST['id']) ? $_POST['id'] : " Nenhum ID ";
        $sql = mysqli_query($conn, "DELETE FROM tb_esmalte WHERE id_esmalte=$id");
        listarDados($conn);
    } elseif ($metodo == 'alterar') {
        $id     = isset($_POST['idAlterar']) ? $_POST['idAlterar'] : " Nenhum ID ";
        $nome   = isset($_POST['nomeAlterar']) ? $_POST['nomeAlterar'] : " Nenhum Nome ";
        $marca  = isset($_POST['marcaAlterar']) ? $_POST['marcaAlterar'] : " Nenhuma Marca ";

        if (isset($_FILES['imagemAlterar'])) {
            $arquivo = isset($_FILES['imagemAlterar']) ? $_FILES['imagemAlterar'] : null;
            $nomeImagem = $arquivo['name'];
            $tiposPermitidos = ['jpg', 'jpeg', 'png', 'bmp'];
            $tamanho = $arquivo['size'];
            $extensao = explode('.', $nomeImagem);
            $extensao = end($extensao);
            $novoNome = rand() . "- $nomeImagem";
            if (in_array($extensao, $tiposPermitidos)) {
                if ($tamanho > 1e+6) {
                    echo ("<script>'Arquivo muito grande: Tamanho máximo: 1MB'</script>");
                } else {
                    $mover = move_uploaded_file($_FILES['imagemAlterar']['tmp_name'], '_imagens/' . $novoNome);
                    $sql = mysqli_query($conn, "UPDATE tb_esmalte SET nome_esmalte='$nome', marca_esmalte='$marca', foto_esmalte='$novoNome' WHERE id_esmalte=$id");
                }
            } else {
                echo ("<script>alert('Extensão de arquivo não permitida')</script>");
            }
        } else {
            $sql = mysqli_query($conn, "UPDATE tb_esmalte SET nome_esmalte='$nome', marca_esmalte='$marca', foto_esmalte='logo.png' WHERE id_esmalte=$id");
        }

        listarDados($conn);
    } elseif ($metodo == 'usado') {

        $id = isset($_POST['id']) ? $_POST['id'] : null;
        mysqli_query($conn, "UPDATE tb_esmalte SET usado = if(usado=0,1,0) WHERE id_esmalte=$id");
        listarDados($conn);
    }
}


function listarDados($conn)
{
    $tempo = date('Y-m-d');
    $query = mysqli_query($conn, "SELECT * FROM tb_esmalte ORDER BY nome_esmalte ASC");

    echo ("<table> <th>Excluir</th> <th>Usado</th> <th>Nome</th> <th>Marca</th> <th>Data</th> <th>Imagem</th>");
    while ($dados = mysqli_fetch_assoc($query)) {
        echo "   <tr";
        if ($dados['dt_entrada'] == $tempo && $dados['usado'] == '0') {
            echo " class = 'novo'";
        } else {
            " class= 'usado'";
        }
        echo ("> <td><button type='button' class='btn btn-outline-danger modalExcluir' value='{$dados['id_esmalte']}' data-toggle='modal' data-target='#modalExcluir' name='{$dados['nome_esmalte']}'>X</button></td>
                        <td><input type='checkbox'");
        if ($dados['usado'] == '1') {
            echo " checked";
        }
        echo " class = 'check' multiple value='{$dados['id_esmalte']}'></td>
                    
                    <td>                              {$dados['nome_esmalte']}    </td>
                    <td>                              {$dados['marca_esmalte']}   </td>
                    <td>                              {$dados['dt_entrada']}      </td>
                    <td>                              <div class='imagem'><img src='_imagens/{$dados['foto_esmalte']}' width='80px'/></div>      </td>
                                  
                </tr>";
    }
    echo ("</table>");
    mysqli_close($conn);
}

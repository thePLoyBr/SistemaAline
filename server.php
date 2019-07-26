<?php
$conn = mysqli_connect("localhost", "root", "", "banco");
$var1 = $_POST['valor1'];
$var2 = $_POST['valor2'];

$operacao = $_POST['operacao'];

if($operacao == '+'){
    echo($var1 + $var2);
} elseif ($operacao == '-') {
    echo($var1 - $var2);
} elseif ($operacao == 'x') {
    echo($var1 * $var2);
} elseif ($operacao== '/') {
    echo($var1 / $var2);
} else {
    echo("Operação Inválida");
}   
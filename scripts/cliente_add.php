<?php
include 'conexao.php';

$c_nome = $_POST['c_nome'];
$c_cpf = $_POST['c_cpf'];
$c_telefone = $_POST['c_telefone'];
$c_email = $_POST['c_email'];
$c_endereco = $_POST['c_endereco'];

$sqlbuscar = "SELECT c_cpf FROM clientes WHERE c_cpf = '$c_cpf'";
$buscar = mysqli_query($conexao, $sqlbuscar);
$total = mysqli_num_rows($buscar);

if ($total > 0) {
    $retorno = "O cliente: " . $c_nome . " já existe cadastrado.";
    header("Location: ../?pagina=cliente_add_erro&&retorno=".$retorno);
} else {
    $sql = "INSERT INTO clientes (c_nome, c_cpf, c_telefone, c_email, c_endereco) values ('$c_nome', '$c_cpf', '$c_telefone', '$c_email', '$c_endereco')";
    $inserir = mysqli_query($conexao, $sql);
    $retorno = "Cliente: " . $c_nome . " cadastrado com sucesso!";
    header("Location: ../?pagina=cliente_add_ok&&retorno=".$retorno);
}

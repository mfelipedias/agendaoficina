<?php
include 'conexao.php';

$f_nome = $_POST['f_nome'];
$f_cpf = $_POST['f_cpf'];
$f_cargo = $_POST['f_cargo'];
$f_telefone = $_POST['f_telefone'];
$f_email = $_POST['f_email'];
$f_endereco = $_POST['f_endereco'];
$f_senha = $_POST['f_senha'];

$sqlbuscar = "SELECT f_cpf FROM funcionarios WHERE f_cpf = '$f_cpf'";
$buscar = mysqli_query($conexao, $sqlbuscar);
$total = mysqli_num_rows($buscar);

if ($total > 0) {
    $retorno = "O funcionário: " . $f_nome . " já existe cadastrado.";
    header("Location: ../?pagina=funcionario_add_erro&&retorno=".$retorno);
} else {
    $sql = "INSERT INTO funcionarios (f_nome, f_cpf, f_cargo, f_telefone, f_email, f_endereco, f_senha) values ('$f_nome', '$f_cpf', '$f_cargo', '$f_telefone', '$f_email', '$f_endereco', '$f_senha')";
    $inserir = mysqli_query($conexao, $sql);
    $retorno = "Funcionário: " . $f_nome . " cadastrado com sucesso!";
    header("Location: ../?pagina=funcionario_add_ok&&retorno=".$retorno);
}

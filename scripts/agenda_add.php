<?php
include 'conexao.php';

$a_cliente = $_POST['a_cliente'];
$a_data = $_POST['a_data'];
$a_hora = $_POST['a_hora'];
$a_veiculo = $_POST['a_veiculo'];
$a_motivo = $_POST['a_motivo'];
$a_obs = $_POST['a_obs'];
$a_func = $_POST['a_func'];


$sql = "INSERT INTO agendamentos (a_cliente, a_data, a_hora, a_veiculo, a_motivo, a_obs, a_func) 
    values ('$a_cliente', '$a_data', '$a_hora', '$a_veiculo', '$a_motivo', '$a_obs', '$a_func')";
$inserir = mysqli_query($conexao, $sql);
$retorno = "Agendamento cadastrado com sucesso!";
header("Location: ../?pagina=agendar_add_ok&&retorno=".$retorno);

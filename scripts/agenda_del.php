<?php
include 'conexao.php';
$id=$_GET['id'];

$deletar = "DELETE FROM agendamentos where a_id = $id";

$retorno = "Agendamento deletado com sucesso!";

try{
$fila = mysqli_query($conexao, $deletar);
header("Location: ../?pagina=agenda_del_ok&&retorno=" . $retorno);
}catch(Exception $e){
    $retorno = "Erro";
    header("Location: ../?pagina=agenda_del_erro&&retorno=" . $retorno);
}

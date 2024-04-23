<?php
$servername = "agendaoficina.mysql.uhserver.com";
$database = "agendaoficina";
$username = "agendaoficina";
$password = "h5pxzGrDKSU@Xzh";

$conexao = mysqli_connect($servername, $username, $password, $database);

if (!mysqli_set_charset($conexao, 'utf8')) {
    printf('Error ao usar utf8: %s', mysqli_error($conexao));
    exit;
}

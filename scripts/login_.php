<?php
include 'conexao.php';
session_start();
$email = $_POST['email'];
$senha = $_POST['password'];
$erro1 = "<b>Erro:</b> E-mail não encontrado.";
$erro2 = "<b>Erro:</b> Senha incorreta.";

$sql = "SELECT * FROM funcionarios WHERE f_email = '$email'";

$buscar = mysqli_query($conexao, $sql);
$total = mysqli_num_rows($buscar);

if ($total == 0) {
    header("Location: ../login.php?retorno=" . $erro1);
} else {
    while ($array = mysqli_fetch_array($buscar)) {
        $f_id = $array['id_tutor'];
        $f_nome = $array['t_nome'];
        $f_email = $array['f_email'];
        $f_senha = $array['f_senha'];

        if ($total > 0) {
            if ($senha == $f_senha) {
                    $_SESSION['f_id'] = $f_id;
                    $_SESSION['f_nome'] = $t_nome;
                    $_SESSION['f_email'] = $f_email;
                    $_SESSION['f_senha'] = $f_senha;
                    header("Location: ../index.php?pagina=inicio");
            } else {;
                header("Location: ../login.php?retorno=" . $erro2);
            }
        } else {

            header("Location: ../login.php?retorno=" . $erro1);
        }
    }
}

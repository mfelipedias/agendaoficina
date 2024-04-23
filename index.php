<!doctype html>
<?php error_reporting(0); ?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href=".css/navbar.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="estilos.css" />
    <script src="https://kit.fontawesome.com/0a713f6bd4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style type="text/css">
        .card:hover {
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }

        a {
            text-decoration: none;
        }

        a:hover {
            text-decoration: none;
        }
    </style>

</head>

<body>
    <?php $pagina = $_GET['pagina']; ?>
    <!-- Image and text -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
        <a class="navbar-brand align-middle">
            <a class="material-symbols-outlined">
                select_check_box
            </a>
            <span class="" style="color: blue;">&nbsp;Oficina&nbsp;&nbsp;</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-start" id="navbarNav">
            <span class="material-symbols-outlined">
                process_chart
            </span>
            <ul class="navbar-nav ">
                <li class="nav-item <?php if ($pagina == 'inicio') {
                                        echo 'active';
                                    } ?>">
                    <a class="nav-link " href="?pagina=inicio&&x=0">Início<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item <?php if ($pagina == 'agendar') {
                                        echo 'active';
                                    } ?>">
                    <a class="nav-link" href="?pagina=agendar">Agendar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  <?php if ($pagina == 'clientes') {
                                            echo 'active';
                                        } ?>" href="?pagina=clientes">Clientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  <?php if ($pagina == 'funcionarios') {
                                            echo 'active';
                                        } ?>" href="?pagina=funcionarios">Funcionários</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  <?php if ($pagina == 'feedbacks') {
                                            echo 'active';
                                        } ?>" href="?pagina=feedbacks">Feedbacks</a>
                </li>
            </ul>


        </div>

        <div class="d-flex justify-content-end">
            <span class="align-middle" style="">Bem Vindo!&nbsp;&nbsp;</span>
            <a href="#"><span class="material-symbols-outlined">
                    exit_to_app
                </span></a>
        </div>
    </nav>
    <!-- Navbar -->
    <?php if (isset($_GET['pagina'])) {
        switch ($_GET['pagina']) {
            case 'inicio':
                include './includes/func_agenda.php';
                break;
            case 'agendar':
                include './includes/func_agendar.php';
                break;
            case 'clientes':
                include './includes/func_clientes.php';
                break;
            case 'funcionarios':
                include './includes/func_funcionarios.php';
                break;
            case 'feedbacks':
                include './includes/func_feedbacks.php';
                break;
            case 'agenda_del_ok':
                include './includes/sucesso.php';
                include './includes/func_agenda.php';
                break;
            case 'agenda_del_erro':
                include './includes/erro.php';
                include './includes/func_agenda.php';
                break;
            case 'cliente_add_ok':
                include './includes/sucesso.php';
                include './includes/func_clientes.php';
                break;
            case 'cliente_add_erro':
                include './includes/erro.php';
                include './includes/func_clientes.php';
                break;
            case 'funcionario_add_ok':
                include './includes/sucesso.php';
                include './includes/func_funcionarios.php';
                break;
            case 'funcionario_add_erro':
                include './includes/erro.php';
                include './includes/func_funcionarios.php';
                break;
            case 'agendar_add_ok':
                include './includes/sucesso.php';
                include './includes/func_agenda.php';
                break;
        }
    } else {
        include './includes/func_agenda.php';
    } ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>

</body>


</html>
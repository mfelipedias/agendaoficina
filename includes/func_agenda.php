<?php $x = $_GET['x']; ?>

<div class="container" id="calendario" name="calendario">

    <div class="timetable-img text-center">
        <img src="img/content/timetable.png" alt="">
    </div>
    <div class="d-flex justify-content-center m-3">
        <div class="btn-group" role="group" aria-label="Basic outlined example">
            <a type="button" class="btn <?php if ($x == 0) {
                                            echo 'btn-outline-secondary';
                                        } else {
                                            echo 'btn-outline-primary';
                                        } ?>" href="?pagina=inicio&&x=<?php if ($x > 0) {
                                                                            $y = $x;
                                                                            $y = $y - 7;
                                                                            echo $y;
                                                                        } else {
                                                                            echo 0;
                                                                        } ?>">Voltar</a>
            <a type="button" class="btn btn-outline-primary" href="?pagina=inicio&&x=<?php echo '0'; ?>">Inicio</a>
            <a type="button" class="btn btn-outline-primary" href="?pagina=inicio&&x=<?php $y = $x;
                                                                                        $y = $y + 7;
                                                                                        echo $y; ?>">Avançar</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead>
                <tr class="bg-light-gray">
                    <th class="text-uppercase">Horário
                    </th>
                    <?php

                    date_default_timezone_set('America/Sao_Paulo');

                    $hoje = date('Y-m-d');

                    $i = 0 + $x;
                    $limite = 6 + $x;
                    $dias = array();
                    while ($i <= $limite) {
                        $dia = date('Y-m-d', strtotime("+{$i} days", strtotime($hoje)));
                        $i = $i + 1;
                        array_push($dias, $dia)
                    ?>
                        <th><?php $dataHeader = DateTime::createFromFormat('Y-m-d', $dia);
                            echo $dataHeader->format('d/m/Y'); ?></th>
                    <?php }  ?>
                </tr>
            </thead>

            <tbody>
                <!-- 8:00 -->
                <tr>
                    <td class="align-middle">08:00</td>
                    <?php
                    $i = 0 + $x;
                    $a = 0;
                    while ($i <= 6 + $x) {

                    ?>
                        <td>
                            <?php
                            include './scripts/conexao.php';
                            $sql = "SELECT * FROM `agendamentos` INNER JOIN  `clientes` ON a_cliente=c_id WHERE a_data LIKE '%$dias[$a]%' AND a_hora LIKE '%8%' ORDER BY a_hora ASC";
                            $busca = mysqli_query($conexao, $sql);
                            while ($array = mysqli_fetch_array($busca)) {
                                $a_id = $array['a_id'];
                                $a_cliente = $array['a_cliente'];
                                $a_data = $array['a_data'];
                                $a_hora = $array['a_hora'];
                                $a_veiculo = $array['a_veiculo'];
                                $a_motivo = $array['a_motivo'];
                                $a_obs = $array['a_obs'];
                                $c_nome = $array['c_nome'];
                                $c_cpf = $array['c_cpf'];
                                $c_endereco = $array['c_endereco'];
                                $c_telefone = $array['c_telefone'];
                                $c_email = $array['c_email'];
                            ?> <a role="button" class="card m-1" data-toggle="modal" data-target="#detalheAgenda<?php echo $a_id; ?>">
                                    <div class="m-2">
                                        <span class="badge badge-pill <?php if ($a_motivo == 'Manutenção') {
                                                                            echo 'badge-warning';
                                                                        } else {
                                                                            echo 'badge-info';
                                                                        } ?> "><?php echo $a_motivo; ?></span>
                                        <div class="font-size13 text-light-gray"><?php echo $c_nome; ?></div>
                                    </div>
                                </a>
                                <div class="modal fade" id="detalheAgenda<?php echo $a_id; ?>" tabindex="-1" role="dialog" aria-labelledby="detalheCliente" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detalhes</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_nome" name="c_nome" placeholder="<?php echo $c_nome; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_cpf" name="c_cpf" placeholder="<?php echo $c_cpf; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_telefone" name="c_telefone" placeholder="<?php echo $c_telefone; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_email" name="c_email" placeholder="<?php echo $c_email; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_endereco" name="c_endereco" placeholder="<?php echo $c_endereco; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_data" name="a_data" placeholder="<?php $dataModal = DateTime::createFromFormat('Y-m-d', $a_data);
                                                                                                                                            echo $dataModal->format('d/m/Y'); ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_hora" name="a_hora" placeholder="<?php echo $a_hora . ":00 horas"; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_veiculo" name="a_veiculo" placeholder="<?php echo $a_veiculo; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_motivo" name="a_motivo" placeholder="<?php echo $a_motivo; ?>">
                                                </div>
                                                <textarea readonly class="form-control mt-1" id="a_obs" name="a_obs" rows="4" placeholder="<?php echo $a_obs; ?>"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalExcluir<?php echo $a_id; ?>">Excluir</a>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalExcluir<?php echo $a_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Tem certeza que deseja excluir esse agendamento?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                                                <a type="button" class="btn btn-danger" href="./scripts/agenda_del.php?id=<?php echo $a_id ?>">Sim</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </td>
                    <?php $i++;
                        $a++;
                    }  ?>

                </tr>
                <!-- 9:00 -->
                <tr>
                    <td class="align-middle">09:00</td>
                    <?php
                    $i = 0 + $x;
                    $a = 0;
                    while ($i <= 6 + $x) {

                    ?>
                        <td>
                            <?php
                            include './scripts/conexao.php';
                            $sql = "SELECT * FROM `agendamentos` INNER JOIN  `clientes` ON a_cliente=c_id WHERE a_data LIKE '%$dias[$a]%' AND a_hora LIKE '%9%' ORDER BY a_hora ASC";
                            $busca = mysqli_query($conexao, $sql);
                            while ($array = mysqli_fetch_array($busca)) {
                                $a_id = $array['a_id'];
                                $a_cliente = $array['a_cliente'];
                                $a_data = $array['a_data'];
                                $a_hora = $array['a_hora'];
                                $a_veiculo = $array['a_veiculo'];
                                $a_motivo = $array['a_motivo'];
                                $a_obs = $array['a_obs'];
                                $c_nome = $array['c_nome'];
                                $c_cpf = $array['c_cpf'];
                                $c_endereco = $array['c_endereco'];
                                $c_telefone = $array['c_telefone'];
                                $c_email = $array['c_email'];
                            ?> <a role="button" class="card m-1" data-toggle="modal" data-target="#detalheAgenda<?php echo $a_id; ?>">
                                    <div class="m-2">
                                        <span class="badge badge-pill <?php if ($a_motivo == 'Manutenção') {
                                                                            echo 'badge-warning';
                                                                        } else {
                                                                            echo 'badge-info';
                                                                        } ?> "><?php echo $a_motivo; ?></span>
                                        <div class="font-size13 text-light-gray"><?php echo $c_nome; ?></div>
                                    </div>
                                </a>
                                <div class="modal fade" id="detalheAgenda<?php echo $a_id; ?>" tabindex="-1" role="dialog" aria-labelledby="detalheCliente" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detalhes</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_nome" name="c_nome" placeholder="<?php echo $c_nome; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_cpf" name="c_cpf" placeholder="<?php echo $c_cpf; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_telefone" name="c_telefone" placeholder="<?php echo $c_telefone; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_email" name="c_email" placeholder="<?php echo $c_email; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_endereco" name="c_endereco" placeholder="<?php echo $c_endereco; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_data" name="a_data" placeholder="<?php $dataModal = DateTime::createFromFormat('Y-m-d', $a_data);
                                                                                                                                            echo $dataModal->format('d/m/Y'); ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_hora" name="a_hora" placeholder="<?php echo $a_hora . ":00 horas"; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_veiculo" name="a_veiculo" placeholder="<?php echo $a_veiculo; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_motivo" name="a_motivo" placeholder="<?php echo $a_motivo; ?>">
                                                </div>
                                                <textarea readonly class="form-control mt-1" id="a_obs" name="a_obs" rows="4" placeholder="<?php echo $a_obs; ?>"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalExcluir<?php echo $a_id; ?>">Excluir</a>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalExcluir<?php echo $a_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Tem certeza que deseja excluir esse agendamento?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                                                <a type="button" class="btn btn-danger" href="./scripts/agenda_del.php?id=<?php echo $a_id ?>">Sim</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </td>
                    <?php $i++;
                        $a++;
                    }  ?>

                </tr>
                <!-- 10:00 -->
                <tr>
                    <td class="align-middle">10:00</td>
                    <?php
                    $i = 0 + $x;
                    $a = 0;
                    while ($i <= 6 + $x) {

                    ?>
                        <td>
                            <?php
                            include './scripts/conexao.php';
                            $sql = "SELECT * FROM `agendamentos` INNER JOIN  `clientes` ON a_cliente=c_id WHERE a_data LIKE '%$dias[$a]%' AND a_hora LIKE '%10%' ORDER BY a_hora ASC";
                            $busca = mysqli_query($conexao, $sql);
                            while ($array = mysqli_fetch_array($busca)) {
                                $a_id = $array['a_id'];
                                $a_cliente = $array['a_cliente'];
                                $a_data = $array['a_data'];
                                $a_hora = $array['a_hora'];
                                $a_veiculo = $array['a_veiculo'];
                                $a_motivo = $array['a_motivo'];
                                $a_obs = $array['a_obs'];
                                $c_nome = $array['c_nome'];
                                $c_cpf = $array['c_cpf'];
                                $c_endereco = $array['c_endereco'];
                                $c_telefone = $array['c_telefone'];
                                $c_email = $array['c_email'];
                            ?> <a role="button" class="card m-1" data-toggle="modal" data-target="#detalheAgenda<?php echo $a_id; ?>">
                                    <div class="m-2">
                                        <span class="badge badge-pill <?php if ($a_motivo == 'Manutenção') {
                                                                            echo 'badge-warning';
                                                                        } else {
                                                                            echo 'badge-info';
                                                                        } ?> "><?php echo $a_motivo; ?></span>
                                        <div class="font-size13 text-light-gray"><?php echo $c_nome; ?></div>
                                    </div>
                                </a>
                                <div class="modal fade" id="detalheAgenda<?php echo $a_id; ?>" tabindex="-1" role="dialog" aria-labelledby="detalheCliente" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detalhes</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_nome" name="c_nome" placeholder="<?php echo $c_nome; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_cpf" name="c_cpf" placeholder="<?php echo $c_cpf; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_telefone" name="c_telefone" placeholder="<?php echo $c_telefone; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_email" name="c_email" placeholder="<?php echo $c_email; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_endereco" name="c_endereco" placeholder="<?php echo $c_endereco; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_data" name="a_data" placeholder="<?php $dataModal = DateTime::createFromFormat('Y-m-d', $a_data);
                                                                                                                                            echo $dataModal->format('d/m/Y'); ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_hora" name="a_hora" placeholder="<?php echo $a_hora . ":00 horas"; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_veiculo" name="a_veiculo" placeholder="<?php echo $a_veiculo; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_motivo" name="a_motivo" placeholder="<?php echo $a_motivo; ?>">
                                                </div>
                                                <textarea readonly class="form-control mt-1" id="a_obs" name="a_obs" rows="4" placeholder="<?php echo $a_obs; ?>"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalExcluir<?php echo $a_id; ?>">Excluir</a>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalExcluir<?php echo $a_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Tem certeza que deseja excluir esse agendamento?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                                                <a type="button" class="btn btn-danger" href="./scripts/agenda_del.php?id=<?php echo $a_id ?>">Sim</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </td>
                    <?php $i++;
                        $a++;
                    }  ?>

                </tr>
                <!-- 11:00 -->
                <tr>
                    <td class="align-middle">11:00</td>
                    <?php
                    $i = 0 + $x;
                    $a = 0;
                    while ($i <= 6 + $x) {

                    ?>
                        <td>
                            <?php
                            include './scripts/conexao.php';
                            $sql = "SELECT * FROM `agendamentos` INNER JOIN  `clientes` ON a_cliente=c_id WHERE a_data LIKE '%$dias[$a]%' AND a_hora LIKE '%11%' ORDER BY a_hora ASC";
                            $busca = mysqli_query($conexao, $sql);
                            while ($array = mysqli_fetch_array($busca)) {
                                $a_id = $array['a_id'];
                                $a_cliente = $array['a_cliente'];
                                $a_data = $array['a_data'];
                                $a_hora = $array['a_hora'];
                                $a_veiculo = $array['a_veiculo'];
                                $a_motivo = $array['a_motivo'];
                                $a_obs = $array['a_obs'];
                                $c_nome = $array['c_nome'];
                                $c_cpf = $array['c_cpf'];
                                $c_endereco = $array['c_endereco'];
                                $c_telefone = $array['c_telefone'];
                                $c_email = $array['c_email'];
                            ?> <a role="button" class="card m-1" data-toggle="modal" data-target="#detalheAgenda<?php echo $a_id; ?>">
                                    <div class="m-2">
                                        <span class="badge badge-pill <?php if ($a_motivo == 'Manutenção') {
                                                                            echo 'badge-warning';
                                                                        } else {
                                                                            echo 'badge-info';
                                                                        } ?> "><?php echo $a_motivo; ?></span>
                                        <div class="font-size13 text-light-gray"><?php echo $c_nome; ?></div>
                                    </div>
                                </a>
                                <div class="modal fade" id="detalheAgenda<?php echo $a_id; ?>" tabindex="-1" role="dialog" aria-labelledby="detalheCliente" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detalhes</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_nome" name="c_nome" placeholder="<?php echo $c_nome; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_cpf" name="c_cpf" placeholder="<?php echo $c_cpf; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_telefone" name="c_telefone" placeholder="<?php echo $c_telefone; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_email" name="c_email" placeholder="<?php echo $c_email; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_endereco" name="c_endereco" placeholder="<?php echo $c_endereco; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_data" name="a_data" placeholder="<?php $dataModal = DateTime::createFromFormat('Y-m-d', $a_data);
                                                                                                                                            echo $dataModal->format('d/m/Y'); ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_hora" name="a_hora" placeholder="<?php echo $a_hora . ":00 horas"; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_veiculo" name="a_veiculo" placeholder="<?php echo $a_veiculo; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_motivo" name="a_motivo" placeholder="<?php echo $a_motivo; ?>">
                                                </div>
                                                <textarea readonly class="form-control mt-1" id="a_obs" name="a_obs" rows="4" placeholder="<?php echo $a_obs; ?>"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalExcluir<?php echo $a_id; ?>">Excluir</a>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalExcluir<?php echo $a_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Tem certeza que deseja excluir esse agendamento?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                                                <a type="button" class="btn btn-danger" href="./scripts/agenda_del.php?id=<?php echo $a_id ?>">Sim</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </td>
                    <?php $i++;
                        $a++;
                    }  ?>

                </tr>
                <!-- 12:00 -->
                <tr>
                    <td class="align-middle">12:00</td>
                    <?php
                    $i = 0 + $x;
                    $a = 0;
                    while ($i <= 6 + $x) {

                    ?>
                        <td>
                            <?php
                            include './scripts/conexao.php';
                            $sql = "SELECT * FROM `agendamentos` INNER JOIN  `clientes` ON a_cliente=c_id WHERE a_data LIKE '%$dias[$a]%' AND a_hora LIKE '%12%' ORDER BY a_hora ASC";
                            $busca = mysqli_query($conexao, $sql);
                            while ($array = mysqli_fetch_array($busca)) {
                                $a_id = $array['a_id'];
                                $a_cliente = $array['a_cliente'];
                                $a_data = $array['a_data'];
                                $a_hora = $array['a_hora'];
                                $a_veiculo = $array['a_veiculo'];
                                $a_motivo = $array['a_motivo'];
                                $a_obs = $array['a_obs'];
                                $c_nome = $array['c_nome'];
                                $c_cpf = $array['c_cpf'];
                                $c_endereco = $array['c_endereco'];
                                $c_telefone = $array['c_telefone'];
                                $c_email = $array['c_email'];
                            ?> <a role="button" class="card m-1" data-toggle="modal" data-target="#detalheAgenda<?php echo $a_id; ?>">
                                    <div class="m-2">
                                        <span class="badge badge-pill <?php if ($a_motivo == 'Manutenção') {
                                                                            echo 'badge-warning';
                                                                        } else {
                                                                            echo 'badge-info';
                                                                        } ?> "><?php echo $a_motivo; ?></span>
                                        <div class="font-size13 text-light-gray"><?php echo $c_nome; ?></div>
                                    </div>
                                </a>
                                <div class="modal fade" id="detalheAgenda<?php echo $a_id; ?>" tabindex="-1" role="dialog" aria-labelledby="detalheCliente" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detalhes</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_nome" name="c_nome" placeholder="<?php echo $c_nome; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_cpf" name="c_cpf" placeholder="<?php echo $c_cpf; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_telefone" name="c_telefone" placeholder="<?php echo $c_telefone; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_email" name="c_email" placeholder="<?php echo $c_email; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_endereco" name="c_endereco" placeholder="<?php echo $c_endereco; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_data" name="a_data" placeholder="<?php $dataModal = DateTime::createFromFormat('Y-m-d', $a_data);
                                                                                                                                            echo $dataModal->format('d/m/Y'); ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_hora" name="a_hora" placeholder="<?php echo $a_hora . ":00 horas"; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_veiculo" name="a_veiculo" placeholder="<?php echo $a_veiculo; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_motivo" name="a_motivo" placeholder="<?php echo $a_motivo; ?>">
                                                </div>
                                                <textarea readonly class="form-control mt-1" id="a_obs" name="a_obs" rows="4" placeholder="<?php echo $a_obs; ?>"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalExcluir<?php echo $a_id; ?>">Excluir</a>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalExcluir<?php echo $a_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Tem certeza que deseja excluir esse agendamento?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                                                <a type="button" class="btn btn-danger" href="./scripts/agenda_del.php?id=<?php echo $a_id ?>">Sim</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </td>
                    <?php $i++;
                        $a++;
                    }  ?>

                </tr>
                <!-- 13:00 -->
                <tr>
                    <td class="align-middle">13:00</td>
                    <?php
                    $i = 0 + $x;
                    $a = 0;
                    while ($i <= 6 + $x) {

                    ?>
                        <td>
                            <?php
                            include './scripts/conexao.php';
                            $sql = "SELECT * FROM `agendamentos` INNER JOIN  `clientes` ON a_cliente=c_id WHERE a_data LIKE '%$dias[$a]%' AND a_hora LIKE '%13%' ORDER BY a_hora ASC";
                            $busca = mysqli_query($conexao, $sql);
                            while ($array = mysqli_fetch_array($busca)) {
                                $a_id = $array['a_id'];
                                $a_cliente = $array['a_cliente'];
                                $a_data = $array['a_data'];
                                $a_hora = $array['a_hora'];
                                $a_veiculo = $array['a_veiculo'];
                                $a_motivo = $array['a_motivo'];
                                $a_obs = $array['a_obs'];
                                $c_nome = $array['c_nome'];
                                $c_cpf = $array['c_cpf'];
                                $c_endereco = $array['c_endereco'];
                                $c_telefone = $array['c_telefone'];
                                $c_email = $array['c_email'];
                            ?> <a role="button" class="card m-1" data-toggle="modal" data-target="#detalheAgenda<?php echo $a_id; ?>">
                                    <div class="m-2">
                                        <span class="badge badge-pill <?php if ($a_motivo == 'Manutenção') {
                                                                            echo 'badge-warning';
                                                                        } else {
                                                                            echo 'badge-info';
                                                                        } ?> "><?php echo $a_motivo; ?></span>
                                        <div class="font-size13 text-light-gray"><?php echo $c_nome; ?></div>
                                    </div>
                                </a>
                                <div class="modal fade" id="detalheAgenda<?php echo $a_id; ?>" tabindex="-1" role="dialog" aria-labelledby="detalheCliente" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detalhes</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_nome" name="c_nome" placeholder="<?php echo $c_nome; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_cpf" name="c_cpf" placeholder="<?php echo $c_cpf; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_telefone" name="c_telefone" placeholder="<?php echo $c_telefone; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_email" name="c_email" placeholder="<?php echo $c_email; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_endereco" name="c_endereco" placeholder="<?php echo $c_endereco; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_data" name="a_data" placeholder="<?php $dataModal = DateTime::createFromFormat('Y-m-d', $a_data);
                                                                                                                                            echo $dataModal->format('d/m/Y'); ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_hora" name="a_hora" placeholder="<?php echo $a_hora . ":00 horas"; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_veiculo" name="a_veiculo" placeholder="<?php echo $a_veiculo; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_motivo" name="a_motivo" placeholder="<?php echo $a_motivo; ?>">
                                                </div>
                                                <textarea readonly class="form-control mt-1" id="a_obs" name="a_obs" rows="4" placeholder="<?php echo $a_obs; ?>"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalExcluir<?php echo $a_id; ?>">Excluir</a>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalExcluir<?php echo $a_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Tem certeza que deseja excluir esse agendamento?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                                                <a type="button" class="btn btn-danger" href="./scripts/agenda_del.php?id=<?php echo $a_id ?>">Sim</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </td>
                    <?php $i++;
                        $a++;
                    }  ?>

                </tr>
                <!-- 14:00 -->
                <tr>
                    <td class="align-middle">14:00</td>
                    <?php
                    $i = 0 + $x;
                    $a = 0;
                    while ($i <= 6 + $x) {

                    ?>
                        <td>
                            <?php
                            include './scripts/conexao.php';
                            $sql = "SELECT * FROM `agendamentos` INNER JOIN  `clientes` ON a_cliente=c_id WHERE a_data LIKE '%$dias[$a]%' AND a_hora LIKE '%14%' ORDER BY a_hora ASC";
                            $busca = mysqli_query($conexao, $sql);
                            while ($array = mysqli_fetch_array($busca)) {
                                $a_id = $array['a_id'];
                                $a_cliente = $array['a_cliente'];
                                $a_data = $array['a_data'];
                                $a_hora = $array['a_hora'];
                                $a_veiculo = $array['a_veiculo'];
                                $a_motivo = $array['a_motivo'];
                                $a_obs = $array['a_obs'];
                                $c_nome = $array['c_nome'];
                                $c_cpf = $array['c_cpf'];
                                $c_endereco = $array['c_endereco'];
                                $c_telefone = $array['c_telefone'];
                                $c_email = $array['c_email'];
                            ?> <a role="button" class="card m-1" data-toggle="modal" data-target="#detalheAgenda<?php echo $a_id; ?>">
                                    <div class="m-2">
                                        <span class="badge badge-pill <?php if ($a_motivo == 'Manutenção') {
                                                                            echo 'badge-warning';
                                                                        } else {
                                                                            echo 'badge-info';
                                                                        } ?> "><?php echo $a_motivo; ?></span>
                                        <div class="font-size13 text-light-gray"><?php echo $c_nome; ?></div>
                                    </div>
                                </a>
                                <div class="modal fade" id="detalheAgenda<?php echo $a_id; ?>" tabindex="-1" role="dialog" aria-labelledby="detalheCliente" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detalhes</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_nome" name="c_nome" placeholder="<?php echo $c_nome; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_cpf" name="c_cpf" placeholder="<?php echo $c_cpf; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_telefone" name="c_telefone" placeholder="<?php echo $c_telefone; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_email" name="c_email" placeholder="<?php echo $c_email; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_endereco" name="c_endereco" placeholder="<?php echo $c_endereco; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_data" name="a_data" placeholder="<?php $dataModal = DateTime::createFromFormat('Y-m-d', $a_data);
                                                                                                                                            echo $dataModal->format('d/m/Y'); ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_hora" name="a_hora" placeholder="<?php echo $a_hora . ":00 horas"; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_veiculo" name="a_veiculo" placeholder="<?php echo $a_veiculo; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_motivo" name="a_motivo" placeholder="<?php echo $a_motivo; ?>">
                                                </div>
                                                <textarea readonly class="form-control mt-1" id="a_obs" name="a_obs" rows="4" placeholder="<?php echo $a_obs; ?>"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalExcluir<?php echo $a_id; ?>">Excluir</a>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalExcluir<?php echo $a_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Tem certeza que deseja excluir esse agendamento?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                                                <a type="button" class="btn btn-danger" href="./scripts/agenda_del.php?id=<?php echo $a_id ?>">Sim</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </td>
                    <?php $i++;
                        $a++;
                    }  ?>

                </tr>
                <!-- 15:00 -->
                <tr>
                    <td class="align-middle">15:00</td>
                    <?php
                    $i = 0 + $x;
                    $a = 0;
                    while ($i <= 6 + $x) {

                    ?>
                        <td>
                            <?php
                            include './scripts/conexao.php';
                            $sql = "SELECT * FROM `agendamentos` INNER JOIN  `clientes` ON a_cliente=c_id WHERE a_data LIKE '%$dias[$a]%' AND a_hora LIKE '%15%' ORDER BY a_hora ASC";
                            $busca = mysqli_query($conexao, $sql);
                            while ($array = mysqli_fetch_array($busca)) {
                                $a_id = $array['a_id'];
                                $a_cliente = $array['a_cliente'];
                                $a_data = $array['a_data'];
                                $a_hora = $array['a_hora'];
                                $a_veiculo = $array['a_veiculo'];
                                $a_motivo = $array['a_motivo'];
                                $a_obs = $array['a_obs'];
                                $c_nome = $array['c_nome'];
                                $c_cpf = $array['c_cpf'];
                                $c_endereco = $array['c_endereco'];
                                $c_telefone = $array['c_telefone'];
                                $c_email = $array['c_email'];
                            ?> <a role="button" class="card m-1" data-toggle="modal" data-target="#detalheAgenda<?php echo $a_id; ?>">
                                    <div class="m-2">
                                        <span class="badge badge-pill <?php if ($a_motivo == 'Manutenção') {
                                                                            echo 'badge-warning';
                                                                        } else {
                                                                            echo 'badge-info';
                                                                        } ?> "><?php echo $a_motivo; ?></span>
                                        <div class="font-size13 text-light-gray"><?php echo $c_nome; ?></div>
                                    </div>
                                </a>
                                <div class="modal fade" id="detalheAgenda<?php echo $a_id; ?>" tabindex="-1" role="dialog" aria-labelledby="detalheCliente" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detalhes</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_nome" name="c_nome" placeholder="<?php echo $c_nome; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_cpf" name="c_cpf" placeholder="<?php echo $c_cpf; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_telefone" name="c_telefone" placeholder="<?php echo $c_telefone; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_email" name="c_email" placeholder="<?php echo $c_email; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_endereco" name="c_endereco" placeholder="<?php echo $c_endereco; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_data" name="a_data" placeholder="<?php $dataModal = DateTime::createFromFormat('Y-m-d', $a_data);
                                                                                                                                            echo $dataModal->format('d/m/Y'); ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_hora" name="a_hora" placeholder="<?php echo $a_hora . ":00 horas"; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_veiculo" name="a_veiculo" placeholder="<?php echo $a_veiculo; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_motivo" name="a_motivo" placeholder="<?php echo $a_motivo; ?>">
                                                </div>
                                                <textarea readonly class="form-control mt-1" id="a_obs" name="a_obs" rows="4" placeholder="<?php echo $a_obs; ?>"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalExcluir<?php echo $a_id; ?>">Excluir</a>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalExcluir<?php echo $a_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Tem certeza que deseja excluir esse agendamento?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                                                <a type="button" class="btn btn-danger" href="./scripts/agenda_del.php?id=<?php echo $a_id ?>">Sim</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </td>
                    <?php $i++;
                        $a++;
                    }  ?>

                </tr>
                <!-- 16:00 -->
                <tr>
                    <td class="align-middle">16:00</td>
                    <?php
                    $i = 0 + $x;
                    $a = 0;
                    while ($i <= 6 + $x) {

                    ?>
                        <td>
                            <?php
                            include './scripts/conexao.php';
                            $sql = "SELECT * FROM `agendamentos` INNER JOIN  `clientes` ON a_cliente=c_id WHERE a_data LIKE '%$dias[$a]%' AND a_hora LIKE '%16%' ORDER BY a_hora ASC";
                            $busca = mysqli_query($conexao, $sql);
                            while ($array = mysqli_fetch_array($busca)) {
                                $a_id = $array['a_id'];
                                $a_cliente = $array['a_cliente'];
                                $a_data = $array['a_data'];
                                $a_hora = $array['a_hora'];
                                $a_veiculo = $array['a_veiculo'];
                                $a_motivo = $array['a_motivo'];
                                $a_obs = $array['a_obs'];
                                $c_nome = $array['c_nome'];
                                $c_cpf = $array['c_cpf'];
                                $c_endereco = $array['c_endereco'];
                                $c_telefone = $array['c_telefone'];
                                $c_email = $array['c_email'];
                            ?> <a role="button" class="card m-1" data-toggle="modal" data-target="#detalheAgenda<?php echo $a_id; ?>">
                                    <div class="m-2">
                                        <span class="badge badge-pill <?php if ($a_motivo == 'Manutenção') {
                                                                            echo 'badge-warning';
                                                                        } else {
                                                                            echo 'badge-info';
                                                                        } ?> "><?php echo $a_motivo; ?></span>
                                        <div class="font-size13 text-light-gray"><?php echo $c_nome; ?></div>
                                    </div>
                                </a>
                                <div class="modal fade" id="detalheAgenda<?php echo $a_id; ?>" tabindex="-1" role="dialog" aria-labelledby="detalheCliente" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detalhes</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_nome" name="c_nome" placeholder="<?php echo $c_nome; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_cpf" name="c_cpf" placeholder="<?php echo $c_cpf; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_telefone" name="c_telefone" placeholder="<?php echo $c_telefone; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_email" name="c_email" placeholder="<?php echo $c_email; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_endereco" name="c_endereco" placeholder="<?php echo $c_endereco; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_data" name="a_data" placeholder="<?php $dataModal = DateTime::createFromFormat('Y-m-d', $a_data);
                                                                                                                                            echo $dataModal->format('d/m/Y'); ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_hora" name="a_hora" placeholder="<?php echo $a_hora . ":00 horas"; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_veiculo" name="a_veiculo" placeholder="<?php echo $a_veiculo; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_motivo" name="a_motivo" placeholder="<?php echo $a_motivo; ?>">
                                                </div>
                                                <textarea readonly class="form-control mt-1" id="a_obs" name="a_obs" rows="4" placeholder="<?php echo $a_obs; ?>"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalExcluir<?php echo $a_id; ?>">Excluir</a>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalExcluir<?php echo $a_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Tem certeza que deseja excluir esse agendamento?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                                                <a type="button" class="btn btn-danger" href="./scripts/agenda_del.php?id=<?php echo $a_id ?>">Sim</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </td>
                    <?php $i++;
                        $a++;
                    }  ?>

                </tr>
                <!-- 17:00 -->
                <tr>
                    <td class="align-middle">17:00</td>
                    <?php
                    $i = 0 + $x;
                    $a = 0;
                    while ($i <= 6 + $x) {

                    ?>
                        <td>
                            <?php
                            include './scripts/conexao.php';
                            $sql = "SELECT * FROM `agendamentos` INNER JOIN  `clientes` ON a_cliente=c_id WHERE a_data LIKE '%$dias[$a]%' AND a_hora LIKE '%17%' ORDER BY a_hora ASC";
                            $busca = mysqli_query($conexao, $sql);
                            while ($array = mysqli_fetch_array($busca)) {
                                $a_id = $array['a_id'];
                                $a_cliente = $array['a_cliente'];
                                $a_data = $array['a_data'];
                                $a_hora = $array['a_hora'];
                                $a_veiculo = $array['a_veiculo'];
                                $a_motivo = $array['a_motivo'];
                                $a_obs = $array['a_obs'];
                                $c_nome = $array['c_nome'];
                                $c_cpf = $array['c_cpf'];
                                $c_endereco = $array['c_endereco'];
                                $c_telefone = $array['c_telefone'];
                                $c_email = $array['c_email'];
                            ?> <a role="button" class="card m-1" data-toggle="modal" data-target="#detalheAgenda<?php echo $a_id; ?>">
                                    <div class="m-2">
                                        <span class="badge badge-pill <?php if ($a_motivo == 'Manutenção') {
                                                                            echo 'badge-warning';
                                                                        } else {
                                                                            echo 'badge-info';
                                                                        } ?> "><?php echo $a_motivo; ?></span>
                                        <div class="font-size13 text-light-gray"><?php echo $c_nome; ?></div>
                                    </div>
                                </a>
                                <div class="modal fade" id="detalheAgenda<?php echo $a_id; ?>" tabindex="-1" role="dialog" aria-labelledby="detalheCliente" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detalhes</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_nome" name="c_nome" placeholder="<?php echo $c_nome; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_cpf" name="c_cpf" placeholder="<?php echo $c_cpf; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_telefone" name="c_telefone" placeholder="<?php echo $c_telefone; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_email" name="c_email" placeholder="<?php echo $c_email; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="c_endereco" name="c_endereco" placeholder="<?php echo $c_endereco; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_data" name="a_data" placeholder="<?php $dataModal = DateTime::createFromFormat('Y-m-d', $a_data);
                                                                                                                                            echo $dataModal->format('d/m/Y'); ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_hora" name="a_hora" placeholder="<?php echo $a_hora . ":00 horas"; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_veiculo" name="a_veiculo" placeholder="<?php echo $a_veiculo; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input readonly type="text" class="form-control" id="a_motivo" name="a_motivo" placeholder="<?php echo $a_motivo; ?>">
                                                </div>
                                                <textarea readonly class="form-control mt-1" id="a_obs" name="a_obs" rows="4" placeholder="<?php echo $a_obs; ?>"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalExcluir<?php echo $a_id; ?>">Excluir</a>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalExcluir<?php echo $a_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Tem certeza que deseja excluir esse agendamento?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                                                <a type="button" class="btn btn-danger" href="./scripts/agenda_del.php?id=<?php echo $a_id ?>">Sim</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </td>
                    <?php $i++;
                        $a++;
                    }  ?>

                </tr>

            </tbody>
        </table>
    </div>
</div>
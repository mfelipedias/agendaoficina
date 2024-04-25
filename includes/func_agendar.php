<form class="container mt-3" action="./scripts/agenda_add.php" method="post">
    <div class="form-group">
        <input type="hidden" class="form-control" id="a_func" name="a_func" value="<?php echo $logado?>">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Cliente:</label>
        <small id="emailHelp" class="form-text text-muted m-1">Selecione o cliente na lista</small>
        <select class="custom-select my-1 mr-sm-2" id="a_cliente" name="a_cliente">
            <option selected>Selecione...</option>
            <?php
            include './scripts/conexao.php';
            $sql = "SELECT * FROM `clientes` ORDER BY c_nome ASC";
            $busca = mysqli_query($conexao, $sql);
            while ($array = mysqli_fetch_array($busca)) {
                $c_id = $array['c_id'];
                $c_nome = $array['c_nome'];
                $c_cpf = $array['c_cpf'];
            ?>
                <option value="<?php echo $c_id; ?>"><?php echo $c_nome; ?> CPF: <?php echo $c_cpf; ?></option>
            <?php } ?>
        </select>
        <a type="button" class="btn btn-primary" style="color:white" data-toggle="modal" data-target="#cadastroCliente">Cadastrar</a>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Veículo:</label>
        <input type="text" class="form-control" id="a_veiculo" name="a_veiculo" placeholder="Marca e Modelo">
        <select class="custom-select my-1 mr-sm-2" id="a_motivo" name="a_motivo">
            <option selected>Selecione o serviço...</option>
            <option value="Manutenção">Manutenção</option>
            <option value="Revisão">Revisão</option>
        </select>
        <input type="date" class="form-control" id="a_data" name="a_data" placeholder="Data">
        <select class="custom-select my-1 mr-sm-2" id="a_hora" name="a_hora">
            <option selected>Selecione o horario...</option>
            <option value="8">08:00</option>
            <option value="9">09:00</option>
            <option value="10">10:00</option>
            <option value="11">11:00</option>
            <option value="12">12:00</option>
            <option value="13">13:00</option>
            <option value="14">14:00</option>
            <option value="15">15:00</option>
            <option value="16">16:00</option>
            <option value="17">17:00</option>
        </select>
        <textarea class="form-control mt-1" id="a_obs" name="a_obs" rows="4" placeholder="Informações Adicionais..."></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Agendar</button>
</form>

<div class="modal fade" id="cadastroCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Novo cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="./scripts/cliente_add.php" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nome</label>
                        <input type="text" class="form-control" id="c_nome" name="c_nome" placeholder="Nome completo" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">CPF</label>
                        <input type="text" class="form-control" id="c_cpf" name="c_cpf" placeholder="000.000.000-00" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Telefone</label>
                        <input type="text" class="form-control" id="c_telefone" name="c_telefone" placeholder="(00) 00000-0000">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="text" class="form-control" id="c_email" name="c_email" placeholder="exemplo@exemplo.com.br" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Endereço</label>
                        <input type="text" class="form-control" id="c_endereco" name="c_endereco" placeholder="Endereço completo...">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
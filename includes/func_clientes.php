<div class="container mt-3">
    <a type="button" class="btn btn-primary" style="color:white" data-toggle="modal" data-target="#cadastroCliente">Cadastrar</a>

    <table class="table table-hover mt-3">
        <thead>
            <tr>
                <th scope="col">Cód.</th>
                <th scope="col">Nome</th>
                <th scope="col">CPF</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include './scripts/conexao.php';
            $sql = "SELECT * FROM `clientes` ORDER BY c_nome ASC";
            $busca = mysqli_query($conexao, $sql);
            while ($array = mysqli_fetch_array($busca)) {
                $c_id = $array['c_id'];
                $c_nome = $array['c_nome'];
                $c_cpf = $array['c_cpf'];
                $c_telefone = $array['c_telefone'];
                $c_email = $array['c_email'];
                $c_endereco = $array['c_endereco'];
            ?>
                <tr>
                    <th scope="row"><?php echo $c_id; ?></th>
                    <td><?php echo $c_nome; ?></td>
                    <td><?php echo $c_cpf; ?></td>
                    <td><a role="button" class="material-symbols-outlined btn-sm btn-primary" data-toggle="modal" data-target="#detalheCliente<?php echo $c_id; ?>" style="color:white">
                            visibility</a>
                    </td>
                </tr>
                <div class="modal fade" id="detalheCliente<?php echo $c_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <label for="exampleInputEmail1">Nome</label>
                                    <input readonly type="text" class="form-control" id="c_nome" name="c_nome" placeholder="<?php echo $c_nome; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">CPF</label>
                                    <input readonly type="text" class="form-control" id="c_cpf" name="c_cpf" placeholder="<?php echo $c_cpf; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Telefone</label>
                                    <input readonly type="text" class="form-control" id="c_telefone" name="c_telefone" placeholder="<?php echo $c_telefone; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input readonly type="text" class="form-control" id="c_email" name="c_email" placeholder="<?php echo $c_email; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Endereço</label>
                                    <input readonly type="text" class="form-control" id="c_endereco" name="c_endereco" placeholder="<?php echo $c_endereco; ?>">
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Modal detalhes cliente-->

<!-- Modal Cadastro Cliente-->
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
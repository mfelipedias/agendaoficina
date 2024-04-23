<div class="container mt-3">
    <a type="button" class="btn btn-primary" style="color:white" data-toggle="modal" data-target="#cadastroFuncionario">Cadastrar</a>
    <table class="table table-hover mt-3">
        <thead>
            <tr>
                <th scope="col">Cód.</th>
                <th scope="col">Nome</th>
                <th scope="col">CPF</th>
                <th scope="col">Cargo</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include './scripts/conexao.php';
            $sql = "SELECT * FROM `funcionarios` ORDER BY f_nome ASC";
            $busca = mysqli_query($conexao, $sql);
            while ($array = mysqli_fetch_array($busca)) {
                $f_id = $array['f_id'];
                $f_nome = $array['f_nome'];
                $f_cargo = $array['f_cargo'];
                $f_cpf = $array['f_cpf'];
                $f_telefone = $array['f_telefone'];
                $f_email = $array['f_email'];
                $f_endereco = $array['f_endereco'];
            ?>
                <tr>
                    <th scope="row"><?php echo $f_id; ?></th>
                    <td><?php echo $f_nome; ?></td>
                    <td><?php echo $f_cpf; ?></td>
                    <td><?php echo $f_cargo; ?></td>
                    <td><a role="button" class="material-symbols-outlined btn-sm btn-primary" data-toggle="modal" data-target="#detalheFuncionario<?php echo $f_id; ?>" style="color:white">
                            visibility</a>
                    </td>
                </tr>
                <div class="modal fade" id="detalheFuncionario<?php echo $f_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <input readonly type="text" class="form-control" id="f_nome" name="c_nome" placeholder="<?php echo $f_nome; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Cargo</label>
                                    <input readonly type="text" class="form-control" id="f_cargo" name="f_cargo" placeholder="<?php echo $f_cargo; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">CPF</label>
                                    <input readonly type="text" class="form-control" id="f_cpf" name="c_cpf" placeholder="<?php echo $f_cpf; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Telefone</label>
                                    <input readonly type="text" class="form-control" id="f_telefone" name="c_telefone" placeholder="<?php echo $f_telefone; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input readonly type="text" class="form-control" id="f_email" name="c_email" placeholder="<?php echo $f_email; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Endereço</label>
                                    <input readonly type="text" class="form-control" id="f_endereco" name="c_endereco" placeholder="<?php echo $f_endereco; ?>">
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
    <div class="modal fade" id="cadastroFuncionario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Novo Funcionario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="./scripts/func_add.php" method="post">
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Nome</label>
                            <input type="text" class="form-control" id="f_nome" name="f_nome" placeholder="Nome completo..." required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">CPF</label>
                            <input type="text" class="form-control" id="f_cpf" maxlength="14" name="f_cpf" placeholder="000.000.000-00" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Cargo</label>
                            <input type="text" class="form-control" id="f_cargo" name="f_cargo" placeholder="Digite o cargo..." required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Telefone</label>
                            <input type="text" class="form-control" id="f_telefone" name="f_telefone" placeholder="(00) 00000-0000">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" class="form-control" id="f_email" name="f_email" placeholder="exemplo@exemplo.com.br" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Endereço</label>
                            <input type="text" class="form-control" id="f_endereco" name="f_endereco" placeholder="Endereço completo...">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label class="form-label">Senha: </label>
                                    <input class="form-control" type="password" id="f_senha" name="f_senha" placeholder="Digite uma senha..." required maxlength="50">
                                </div>
                                <div class="col">
                                    <label class="form-label">Repita a senha: </label>
                                    <input class="form-control" type="password" id="f_rsenha" name="f_rsenha" placeholder="Repita a senha..." oninput='validaSenha(this)' required maxlength="50">
                                </div>
                            </div>
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
</div>
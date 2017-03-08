<?php
/**
 * Ativar a segurança do sistema
 */
new Secure();

/**
 * Ativar o controle de funcionarios
 */
include_once 'control/controllerFuncionario.php';
?>

<html lang="pt-br">
    <head>
        <!-- define a codificação do HTML -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- define a o titulo do HMTL -->
        <title>Sistema Controle - SC</title>
        <!-- Link para o CSS do bootstrap -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    </head>
    <body>
        <!-- Link para o JQuery do bootstrap -->
        <script src="bootstrap/js/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>

        <div class="container">
            <!-- inserir o menu -->
            <?php
            /**
             * Mostrar o menu principal
             */
            $objcf->menu();

            echo $objcf->alerta($_SESSION['msg']);
            ?> 
            <!-- Filtros para consulta -->
            <div class="jumbotron">
                <fieldset>
                    <legend>Dados da Consulta</legend>
                    <form method="post" name="frm_consultar">
                        <div class="form-group">
                            <label for="codigo" class="control-label">Código</label>
                            <input type="text" class="form-control" placeholder="código" name="dados[id_funcionario][]">
                            <label for="nome" class="control-label">Nome</label>
                            <input type="text" class="form-control" placeholder="nome" name="dados[nome][]">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="consultar"><span class="glyphicon glyphicon-search"></span> Consultar</button>
                    </form>
                </fieldset> 
            </div>

            <!-- Resultado da consulta -->
            <div class="jumbotron">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="mytable" class="table table-bordred table-striped">
                                    <thead>
                                    <th>Código</th>
                                    <th>Nome</th>
                                    <th>CPF</th>
                                    <th>Nascimento</th>
                                    <th>Endereço</th>
                                    <th>Telefone</th>
                                    <th>Função</th>
                                    <th>Alterar</th>
                                    <th>Excluir</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        /**
                                         * Foreach para listar os dados do funcionario
                                         */
                                        foreach ($funcionarios as $item) {
                                            echo "<tr>";
                                            echo "<td> {$item[id]} </td>";
                                            echo "<td> {$item[nome]} </td>";
                                            echo "<td> {$item[cpf]} </td>";
                                            echo "<td> {$objcf->dataBrasileiro($item[dtNascimento])} </td>";
                                            echo "<td> {$item[endereco]} </td>";
                                            echo "<td> {$item[telefone]} </td>";
                                            echo "<td> {$item[funcao]} </td>";
                                            echo "<td><p data-placement='top' data-toggle='tooltip' title='Alterar'><button class='btn btn-primary btn-xs' data-title='Alterar' data-toggle='modal' data-target='#alterar{$item[id]}'><span class='glyphicon glyphicon-pencil'></span></button></p></td>";
                                            echo "<td><p data-placement='top' data-toggle='tooltip' title='Excluir'><button class='btn btn-danger btn-xs' data-title='Delete' data-toggle='modal' data-target='#excluir{$item[id]}'><span class='glyphicon glyphicon-trash'></span></button></p></td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>                         
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            /**
             * Foreach para listar os dados do funcionario e definir a modal alterar
             */
            foreach ($funcionarios as $item_alterar) {
                ?>
                <!-- Modal alterar -->
                <div class="modal fade" id="alterar<?php echo $item_alterar[id] ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                                <h4 class="modal-title custom_align" id="Heading">Alterar Funcionario</h4>
                            </div>
                            <div class="modal-body">

                                <form method="post" action="">
                                    <!-- dados do funcionario -->
                                    <label for="id">Código</label>
                                    <input class="form-control" name="dados[id_funcionario][]" type="text" readonly="true" id="id_funcionario" value="<?php echo $item_alterar[id]; ?>" />
                                    <label for="nome">Nome</label>
                                    <input class="form-control" required type="text" name="dados[nome][]" id="nome" value="<?php echo $item_alterar[nome]; ?>" title="Nome Completo"/>
                                    <label for="cpf">CPF</label>
                                    <input class="form-control" required id="cpf" name="dados[cpf][]" type="text" value="<?php echo $item_alterar[cpf]; ?>" title="Digite seu CPF" maxlength="11" title="Digite o CPF somente numeros">
                                    <label for="dtNascimento">Data Nascimento</label>
                                    <input class="form-control" required id="dtNascimento" name="dados[dtNascimento][]" value="<?php echo $item_alterar[dtNascimento]; ?>" type="date" title="Digite sua Data de Nascimento" maxlength="11">
                                    <label for="endereco">Endereço</label>
                                    <input class="form-control" required id="endereco" name="dados[endereco][]" type="text" value="<?php echo $item_alterar[endereco]; ?>" title="Digite seu Endereço">
                                    <label for="telefone">Telefone</label>
                                    <input class="form-control" id="telefone" name="dados[telefone][]" type="text" value="<?php echo $item_alterar[telefone]; ?>" title="Digite seu telefone" maxlength="11">
                                    <label for="funcao">Função</label>
                                    <input class="form-control" required id="funcao" name="dados[funcao][]" type="text" value="<?php echo $item_alterar[funcao]; ?>" title="Digite sua Função">
                                    </br>
                                    <!-- input oculto para informar o id do funcionario-->
                                    <input type="hidden" name="dados[id_funcionario][]" value="<?php echo $item_alterar[id]; ?>" >
                                    <!-- botao para submeter o formulário --> 
                                    <button type="submit" name="alterar" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Alterar</button>
                                </form>   
                            </div>
                        </div>
                    </div>
                </div> 
                <?php
            }
            ?>


            <?php
            /**
             * Foreach para listar os dados do funcionario e definir o modal exluir
             */
            foreach ($funcionarios as $item_excluir) {
                ?>
                <!-- Modal exluir -->
                <div class="modal fade" id="excluir<?php echo $item_excluir[id] ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                                <h4 class="modal-title custom_align" id="Heading">Excluir Funcionario</h4>
                            </div>
                            <div class="modal-body">
                                <form id="funcionario" name="funcionario" method="post" action="">
                                    <!-- dados do funcionario -->
                                    <label for="id">Código</label>
                                    <input class="form-control"name="id" type="text" readonly="true" id="id" value="<?php echo $item_excluir[id]; ?>" />
                                    <label for="nome">Nome</label>
                                    <input class="form-control"required type="text" readonly="true" name="nome" id="nome" value="<?php echo $item_excluir[nome]; ?>"/>
                                    <label for="cpf">CPF</label>
                                    <input class="form-control"required id="cpf" readonly="true" name="cpf" type="text" value="<?php echo $item_excluir[cpf]; ?>" title="Digite seu CPF" maxlength="11" title="Digite o CPF somente numeros">
                                    <label for="dtNascimento">Data Nascimento</label>
                                    <input class="form-control"required id="dtNascimento" readonly="true" name="dtNascimento" value="<?php echo $item_excluir[dtNascimento]; ?>" type="date" title="Digite sua Data de Nascimento?" maxlength="11">
                                    <label for="endereco">Endereço</label>
                                    <input class="form-control"required id="endereco" readonly="true" name="endereco" value="<?php echo $item_excluir[endereco]; ?>" title="Digite seu Endereço">
                                    <label for="telefone">Telefone</label>
                                    <input class="form-control" id="telefone" name="telefone" readonly="true" type="text" value="<?php echo $item_excluir[telefone]; ?>" title="Digite seu telefone?" maxlength="11">
                                    <label for="funcao">Função</label>
                                    <input class="form-control" required id="funcao" readonly="true" name="funcao" value="<?php echo $item_excluir[funcao]; ?>" title="Digite sua Função">                                    
                                    <!-- input oculto para informar o id do funcionario-->
                                    <input type="hidden" name="dados[id_funcionario][]" value="<?php echo $item_excluir[id]; ?>" >
                                    </br>
                                    <!-- botao para submeter o formulário -->
                                    <button id="enviar" type="submit" name="excluir"  class="btn btn-danger btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Excluir</button>
                                </form>    
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?> 
    </body>
</html>

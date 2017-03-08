<?php
/**
 * Ativar a segurança do sistema
 */
new Secure();

include_once 'control/controllerFuncionario.php';
?>
<html lang="pt-br">
    <head>
        <!-- define a codificação do HTML -->
        <meta charset="utf-8">
        <!-- define a o titulo do HMTL -->
        <title>Sistema SGN</title>
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
            ?> 
            <!-- Dados de cadastro do funcionario -->
            <div class="jumbotron">
                <fieldset>
                    <legend>Dados do Funcionario</legend>
                    <form method="post">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input class="form-control" required type="text" name="dados[nome][]" id="nome" />
                            <label for="cpf">CPF</label>
                            <input class="form-control" required id="cpf" name="dados[cpf][]" type="text" title="Digite seu CPF" maxlength="11" title="Digite o CPF somente numeros">
                            <label for="dtNascimento">Data Nascimento</label>
                            <input class="form-control" required id="dtNascimento" name="dados[dtNascimento][]" type="date" title="Qual sua Data de Nascimento?" maxlength="14">
                            <label for="endereco">Endereco</label>
                            <input class="form-control" id="endereco" name="dados[endereco][]" type="text" title="Digite seu endereço">
                            <label for="telefone">Telefone</label>
                            <input class="form-control" id="telefone" name="dados[telefone][]" type="text" title="Digite seu telefone" maxlength="11">
                            <label for="funcao">Função</label>
                            <input class="form-control" id="funcao" name="dados[funcao][]" type="text" title="Digite sua Funcao">
                            </br>
                            <button type="submit" name="inserir" class="btn btn-primary" style="width: 100%;"><span class="glyphicon glyphicon glyphicon-plus"></span> Inserir</button>
                        </div>
                    </form>
                </fieldset> 
            </div>
    </body>
</html>

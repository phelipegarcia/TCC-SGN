<?php
/**
 * Ativar a segurança do sistema
 */
new Secure();

/**
 * Criar o objeto de controle geral
 */
$objcg = new ControlGeral();
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
            $objcg->menu();
            ?> 
        </div>
    </body>
</html>
